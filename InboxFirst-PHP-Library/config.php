<?php
/* These are the main configuration settings for this PHP module */

define("API_KEY", get_option(wp_inboxfirst_api_key));
define("ORG_ID", get_option(wp_inboxfirst_org_id));
define("MAILING_ID", get_option(wp_inboxfirst_mailing_id));
define("ALLOW_SUBSCRIBER_UPDATES", get_option(wp_inboxfirst_allow_subscriber_upates));
define("DEBUGGING", false);
?>