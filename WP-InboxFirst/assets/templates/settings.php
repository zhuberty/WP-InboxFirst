<!-- Heading -->
<div class="wrap">
<h2>Custom Fields</h2>

<!-- Form -->
<form method="post" action="options.php"> 


<?php
# Say which settings are allowed to be modified by this form
settings_fields( 'wp_inboxfirst' );

# Print the authorized settings options to the page
do_settings_sections('wp_inboxfirst');
?>

<!-- Custom Fields Table -->
<table class='form-table'>
		<tr valign='top'>
			<th class='row-title'>InboxFirst API Key</th>
			<td scope='row'><input type='text' name='wp_inboxfirst_api_key' value='<?= esc_attr( get_option( 'wp_inboxfirst_api_key' ) ); ?>' /></td>
		</tr>
		<tr valign='top'>
			<th class='row-title'>InboxFirst Organization ID</th>
			<td scope='row'><input type='text' name='wp_inboxfirst_org_id' value='<?= esc_attr( get_option( 'wp_inboxfirst_org_id' ) ); ?>' /></td>
		</tr>
		<tr valign='top'>
			<th class='row-title'>Mailing List ID</th>
			<td scope='row'><input type='text' name='wp_inboxfirst_mailing_id' value='<?= esc_attr( get_option( 'wp_inboxfirst_mailing_id' ) ); ?>' /></td>
		</tr>
</table>

<!-- Submit -->
<?php submit_button(); ?>

</form>
</div>