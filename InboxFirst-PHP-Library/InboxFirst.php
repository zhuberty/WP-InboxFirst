<?php
/*
	Author: Zachary J. Huberty
	Date: April 12, 2016
	
	Introduction:
		This package takes the most essential API calls from InboxFirst
		and packages them neatly so that the developer can integrate the
		API into his/her applications more easily. 
*/

namespace InboxFirst;

# Load Configuration file, if it exists
include("config.php");

# Root URL for API calls
define("URL_ROOT", "http://if.inboxfirst.com/ga/api/v2/");

# Check if the API Key and Organization ID are defined
if ( ! (defined(API_KEY) && defined(ORG_ID)) )
{
	# If they are not defined, set a generic default value,
	# this should make error handling more elegant.
	@define("API_KEY", "");
	@define("ORG_ID", 0);
}

# Load the rest of the modules
require("includes/Utilities.php");
require("includes/Subscribers.php");
require("includes/MailingLists.php");
require("includes/CustomFields.php");
require("includes/Campaigns.php");
require("includes/Users.php");
require("includes/InboxFirstRequest.php");

# TESTING GROUNDS

/*
echo "<html>";
echo "<body>";

//Subscribers\create_subscriber(2677, "test1@test.com", array('first_name' => 'Zach', 'last_name' => 'Huberty'));
//prettyDump(Subscribers\get_subscribers(2677));
//prettyDump(CustomFields\get_custom_fields(2677));
//prettyDump(MailingLists\get_lists());
//prettyDump(Subscribers\get_subscriber(2677, 'test1@test.com'));
//prettyDump(Subscribers\update_subscriber(2677, "test1@test.com", array('first_name' => 'Zachhh', 'last_name' => 'Huberty')));
//prettyDump(CustomFields\create_custom_field(2677, 'test_field_3', 'boolean', 1));
//prettyDump(CustomFields\update_custom_field(2677, 10068, 'test_field_3', 'boolean', 1));
//prettyDump(CustomFields\delete_custom_field(2677, 10066));

echo "</body>";
echo "</html>";
*/
?>