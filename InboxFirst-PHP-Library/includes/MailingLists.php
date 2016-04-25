<?php
/*
Methods:
	get_lists
*/

namespace InboxFirst\MailingLists;

function get_lists()
{
	# set up service url
	$url = URL_ROOT . "mailing_lists";

	# Send the request
	$lists = \InboxFirst\InboxFirstRequest::get_request($url);
	return $lists;
}
?>