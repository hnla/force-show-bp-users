<?php

/** 
* Set usermeta 'last_activity' if no key/value pair exists.
* 
* 
* ################## This script is now outdated please do not use: see readme.md ########################
* 
* BP will not show users who have no valid meta pair set
* 'last_activity' is set when users log in
* The script forces a key/value in wp_usermeta to trick BuddyPress
* into populating the members dir list.
* 
* This is strictly for  development purposes only where one needs to quickly
* get a set of test users to display on the frontend.
*
* We run this via a url query '?action=force-active'
* You have to be logged in as is_super_admin() '1' to run function
*
* The function can be simply copied to and run from your theme functions file, but removed before
* releasing to production.
*
* @author Hugo Ashmore hnla 
* @version 1.0
*/
function fua_force_last_activity_meta() {
global $wpdb;
	
	if( !is_super_admin() )
		return;
	
	if( isset($_GET['action']) && $_GET['action'] == 'force-active' ) {

		
		$sql = "SELECT `ID` FROM {$wpdb->users}";
		$fua_user_ids = $wpdb->get_col($sql);
	
		foreach($fua_user_ids as  $fua_user_id){
	
		$last_activity_exists =  get_user_meta($fua_user_id, 'last_activity');

	
			if( false == $last_activity_exists ) {
				add_user_meta($fua_user_id, 'last_activity', date('Y-m-d H:i:s') );
				// Lets try and get a different time stamp for each entry
				sleep(2);	
			} 
		} // close foreach
	} // close get action

}
add_action('init', 'fua_force_last_activity_meta');

?>
