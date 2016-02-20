<?php

/** 
* Set BP forced 'last_activity' timestamp if no existing BP last activity found for a user.
* 
* 
* ################## This script is now updated for BP 2.0 please see readme.md ########################
* 
* BP will not show users who have no valid last activity recorded in activity table.
* 'last_activity' is set when users log in
* The script forces a timestamp entry to trick BuddyPress
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
* @version 1.0.1
*/
function fua_force_last_activity_meta() {
global $wpdb;
	
	if( !is_super_admin() )
		return;
	
	if( isset($_GET['action']) && $_GET['action'] == 'force-active' ) {

		
		$sql = "SELECT `ID` FROM {$wpdb->users}";
		$fua_user_ids = $wpdb->get_col($sql);
	
		foreach($fua_user_ids as  $fua_user_id){
	
		$last_activity_exists =  BP_Core_User::get_last_activity( $fua_user_id );

	
			if( count($last_activity_exists) <= 1 ) {
				bp_update_user_last_activity($fua_user_id,  date('Y-m-d H:i:s') );
				// Lets try and get a different time stamp for each entry
				sleep(2);	
			} 
		} // close foreach
	} // close get action

}
add_action('bp_init', 'fua_force_last_activity_meta');

?>
