<?php
if ( class_exists( 'GFForms' ) ) {
    GFForms::include_addon_framework();
    class InboxFirstGForms extends GFAddOn
	{
        protected $_version = '1.0'; 
        protected $_min_gravityforms_version = '1.9';
        protected $_slug = 'InboxFirst-GForms-Addon';
        protected $_path = 'WP-InboxFirst/InboxFirst-GForms-Addon/index.php';
        protected $_full_path = __FILE__;
        protected $_title = 'InboxFirst GForms';
        protected $_short_title = 'InboxFirst';
		protected $mailing_list_id = MAILING_ID;
		protected $field_map = array( array("name" => "email", "label" => "email") );
		protected $custom_fields = array();
	
		public function init()
		{
			parent::init();
			
			# Get Custom Fields
			$this->custom_fields = InboxFirst\CustomFields\get_custom_fields($this->mailing_list_id);
			
			# After GForm entry, process it
			add_action( 'gform_after_submission', array($this, 'process_entry'), 10, 2 );
		}
		
		public function get_settings($form)
		{
			return $this->get_form_settings($form);
		}
		
		public function form_settings_fields($form)
		{
			# Get custom fields
			$custom_fields = $this->custom_fields;
			
			# Check for errors
			if ( ! empty($custom_fields->error_message) )
			{
				# if there is an error, display the message, and exit.
				echo $custom_fields->error_message;
				echo "<br>Please ensure that your Mailing List ID is correct in InboxFirst->Settings";
				return;
			}

			# Create map for custom fields in FormSettings->InboxFirst
			foreach($custom_fields->data as $cf)
			{
				# Make sure we aren't adding duplicate fields
				$duplicate = false;
				foreach ($this->field_map as $fm)
				{
					# If duplicate found
					if ( $fm['name'] == $cf->name )
					{
						$duplicate = true;
					}
				}
				
				# Not a duplicate, add the field
				if ( ! $duplicate)
				{
					$this->field_map[] = array("name" => $cf->name, "label" => $cf->name);
				}
				
			}
			
			# return map of custom fields in relation to gform fields
            return array(
                array(
                    "title"  => "InboxFirst",
                    "fields" => array(
                        array(
                            "label"   => "Map Fields",
                            "type"    => "field_map",
                            "name"    => "map_fields",
                            "field_map" => $this->field_map
                        )
                    )
                )
            );
        }
		
		public function process_entry($entry, $form)
		{
			$settings = $this->get_form_settings($form);
			$email = "";
			
			# Get email, or exit if there is no email
			if ( isset($settings['map_fields_email']) ) $email = $entry[$settings['map_fields_email']];
			if ( empty($email) ) return;
			
			# Get User
			$user = InboxFirst\Subscribers\get_subscriber($this->mailing_list_id, $email);
			if ($user->error_code == 'not_found')
			{
				# Get User Demographics
				$user_demographics = $this->process_demographics($entry, $settings);
				
				# Create User
				$user_response = InboxFirst\Subscribers\create_subscriber($this->mailing_list_id, $email, $user_demographics);
				
			}else {
				
				# Get user demographics
				$temp_user_demographics = (array) $user->data[0]->custom_fields;
				$user_demographics = array();
				# Format user demographics for the update process
				foreach($temp_user_demographics as $ud)
				{
					# name of field => old value of field
					$user_demographics[$ud->name] = $ud->value;
				}
				# Update demographics
				$user_demographics = $this->process_demographics($entry, $settings, $user_demographics);
				
				# Update user in InboxFirst
				$user_response = InboxFirst\Subscribers\update_subscriber($this->mailing_list_id, $email, $user_demographics);
			}
		}
		
		protected function process_demographics($entry, $settings, $user_demographics=array())
		{
			# For each custom field name, and gform field id
			foreach ($settings as $custom_field_name => $gf_field_id)
			{
				# Remove "map_fields" from beginning of field name
				$custom_field_name = substr($custom_field_name, 11);
				
				# Get InboxFirst custom field settings
				$cf = null;
				foreach($this->custom_fields->data as $temp_cf)
				{
					# If the name matches
					if ( $temp_cf->name == $custom_field_name )
					{
						# Set custom field settings
						$cf = $temp_cf;
					}
				}
				# If custom field can't be matched for some reason, skip to the next iteration
				if ( ! $cf)
				{
					continue;
				}

				# get the user's value
				$entry_value = $entry[$gf_field_id];
				
				# if custom field is of type "number", ensure that it is a number
				if ($cf->field_type == "number")
				{
					# if entry value is not a number of some sort
					if ( ! is_numeric($entry_value))
					{
						$entry_value = null;
						
					# if not integer
					}else if ( ! is_int( intval($entry_value) ) )
					{
						$entry_value = null;
					}
				}
				# Create demographic row based on field_name and value
				$user_demographics[$custom_field_name] = $entry_value;
			}
			return $user_demographics;
		}
	}
	new InboxFirstGForms();
}
?>