<?php
/*
Methods:
	create_custom_field
	delete_custom_field
	get_custom_fields
	update_custom_field
*/

namespace InboxFirst\CustomFields;

function get_custom_fields($mailing_list_id)
{
	# set up service url
	$url = URL_ROOT .  "mailing_lists/" . $mailing_list_id . "/custom_fields";
	
	# Send the request
	return \InboxFirst\InboxFirstRequest::get_request($url);
}

function create_custom_field($mailing_list_id, $field_name, $field_type, $default_value)
{
	# set up service url
	$url = URL_ROOT . "mailing_lists/" . $mailing_list_id . "/custom_fields";

	# Format default field type
	$default_type = "default_string";
	switch($field_type)
	{
		case "number":
			$default_type = "default_integer";
			break;
		
		case "boolean":
			$default_type = "default_boolean";
			break;
	}
	
	# Create custom field
	$custom_field = array();
	$custom_field[$default_type] = $default_value;
	$custom_field["required"] = false;
	$custom_field["name"] = $field_name;
	$custom_field["field_type"] = $field_type;

	# Set up post fields
	$fields = array(
		'custom_field' => $custom_field
	);
	
	# Send the request
	return \InboxFirst\InboxFirstRequest::post_request($url, $custom_field);
}

function update_custom_field($mailing_list_id, $field_id, $field_name, $field_type, $default_value)
{
	# set up service url
	$url = URL_ROOT . "mailing_lists/" . $mailing_list_id . "/custom_fields/" . $field_id;

	# Format default field type
	$default_type = "default_string";
	switch($field_type)
	{
		case "number":
			$default_type = "default_integer";
			break;
		
		case "boolean":
			$default_type = "default_boolean";
			break;
	}
	
	# Create custom field
	$custom_field = array();
	$custom_field[$default_type] = $default_value;
	$custom_field["required"] = false;
	$custom_field["name"] = $field_name;
	$custom_field["field_type"] = $field_type;

	# Set up post fields
	$fields = array(
		'custom_field' => $custom_field
	);
	
	# Send the request
	return \InboxFirst\InboxFirstRequest::put_request($url, $custom_field);
}

function delete_custom_field($mailing_list_id, $field_id)
{
	# set up service url
	$url = URL_ROOT . "mailing_lists/" . $mailing_list_id . "/custom_fields/" . $field_id;
	
	$custom_field = array();
	
	# Send the request
	return \InboxFirst\InboxFirstRequest::delete_request($url);
}
?>