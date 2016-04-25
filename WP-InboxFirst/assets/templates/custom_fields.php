<?php
	# Select mailing list
	$mailing_lists = InboxFirst\MailingLists\get_lists()->data;
?>
	<h1>Custom Fields</h1>
	<hr>
	
	<!-- Start mailing list selection form -->
	<?php if ( ! isset($_POST['mailing_list']) ) { ?>
	<form method="post">
	
		<h3>Select Mailing List</h3>
		
		<!-- Select mailing list-->
		<select name="mailing_list" id="">
			
		<?php
			# For each mailing list, add an option
			foreach($mailing_lists as $mailing_list)
			{
				echo "<option value='" . $mailing_list->id . "'>" . $mailing_list->name . "</option>";			
			}
		?>
		</select>
		<?php submit_button("Submit"); ?>
		
	</form>
	<!-- End mailing list selection form -->
	
	<?php }else { # Mailing list is selected, display Custom Fields for list

	$mailing_list_id = (int)$_POST['mailing_list'];
	
	# Get Custom Fields
	$custom_fields = InboxFirst\CustomFields\get_custom_fields($mailing_list_id)->data;
	prettyDump($custom_fields);
	
	# Put custom fields in a table
	?>
	<table class='widefat'>
		<thead>
			<tr valign='top'>
				<th class='row-title'>Field Name</th>
				<th class='row-title'>Field Type</th>
			</tr>
		</thead>
		
		<?php
		# for each custom field, display its data
		foreach($custom_fields as $cf)
		{
			?>
				<tr valign='top'>
				<td class='row-title'><?php echo $cf->name; ?></td>
				<td class='row-title'><?php echo $cf->field_type; ?></td>
				</tr>
			<?php
		}
		?>
	</table>
	<?php
	}
?>