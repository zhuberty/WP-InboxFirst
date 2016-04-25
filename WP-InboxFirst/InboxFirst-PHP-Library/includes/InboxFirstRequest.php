<?php
/*
Methods:
	delete_request
	get_request
	post_request
	put_request
*/

namespace InboxFirst;

class InboxFirstRequest {
	
	public static function get_header_fields($content_length)
	{
		# These fields will be used in every cURL request
		$header_fields = array(
			"Accept" => "*/*",
			"User-Agent" => $_SERVER['HTTP_USER_AGENT'],
			"Content-Type" => "application/json",
			"Content-Length" => $content_length
		);
		
		return $header_fields;
	}
	
	public static function post_request($url, $fields=array())
	{
		$curl = curl_init($url);
		
		# Stringify arrays for transport
		$fields_string = json_encode($fields);
		
		# Get header fields
		$fields_strlen = strlen($fields_string);
		$header_fields = InboxFirstRequest::get_header_fields($fields_strlen);
		
		# Set the number of POST vars, POST data, options		
		curl_setopt($curl, CURLOPT_POST, count($fields));
		curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header_fields);
		curl_setopt($curl, CURLOPT_USERPWD, ORG_ID . ":" . API_KEY);
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		
		// get response
		$curl_response = curl_exec($curl);
		
		// Check if any error occurred
		if (DEBUGGING)
		{
			if(!curl_errno($curl))
			{
				$info = curl_getinfo($curl);

				echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url'];
				echo "<br />HTTP CODE: " . $info['http_code'];
			}else {
				echo curl_errno($curl) . ": " . curl_error($curl);
			}
		}

		// close connection
		curl_close($curl);

		// display result
		return json_decode($curl_response);
	
	}
	
	public static function put_request($url, $fields)
	{
		$curl = curl_init($url);
		
		# Stringify arrays for transport
		$fields_string = json_encode($fields);
		
		# Get header fields
		$fields_strlen = strlen($fields_string);
		$header_fields = InboxFirstRequest::get_header_fields($fields_strlen);
		
		# Set the number of POST vars, POST data, options		
		curl_setopt($curl, CURLOPT_POST, count($fields));
		curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header_fields);
		curl_setopt($curl, CURLOPT_USERPWD, ORG_ID . ":" . API_KEY);
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		
		// get response
		$curl_response = curl_exec($curl);
		
		// Check if any error occurred
		if (DEBUGGING)
		{
			if(!curl_errno($curl))
			{
				$info = curl_getinfo($curl);

				echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url'];
				echo "<br />HTTP CODE: " . $info['http_code'];
			}else {
				echo curl_errno($curl) . ": " . curl_error($curl);
			}
		}

		// close connection
		curl_close($curl);

		// display result
		return json_decode($curl_response);
	
	}
	
	public static function get_request($url, $args=array())
	{
		$curl = curl_init($url);
		
		# Stringify arrays for transport
		$fields_string = http_build_query($args);
		
		# Get header fields
		$fields_strlen = strlen($fields_string);
		$header_fields = InboxFirstRequest::get_header_fields($fields_strlen);
		
		# Set cURL options	
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header_fields);
		curl_setopt($curl, CURLOPT_USERPWD, ORG_ID . ":" . API_KEY);
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		
		// get response
		$curl_response = curl_exec($curl);
		
		// Check if any error occurred
		if (DEBUGGING)
		{
			if(!curl_errno($curl))
			{
				$info = curl_getinfo($curl);

				echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url'];
				echo "<br />HTTP CODE: " . $info['http_code'];
			}else {
				echo curl_errno($curl) . ": " . curl_error($curl);
			}
		}
		

		// close connection
		curl_close($curl);

		// display result
		return json_decode($curl_response);
	}
	
	public static function delete_request($url)
	{
		$curl = curl_init($url);
		
		# Get header fields
		$header_fields = InboxFirstRequest::get_header_fields(0);
		
		# Set the options
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header_fields);
		curl_setopt($curl, CURLOPT_USERPWD, ORG_ID . ":" . API_KEY);
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		
		// get response
		$curl_response = curl_exec($curl);
		
		// Check if any error occurred
		if (DEBUGGING)
		{
			if(!curl_errno($curl))
			{
				$info = curl_getinfo($curl);

				echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url'];
				echo "<br />HTTP CODE: " . $info['http_code'];
			}else {
				echo curl_errno($curl) . ": " . curl_error($curl);
			}
		}

		// close connection
		curl_close($curl);

		// display result
		return json_decode($curl_response);
	
	}
}
?>