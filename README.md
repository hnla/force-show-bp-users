force-show-bp-users
===================

<strike>*Please Note that this script is now outdated, superceded by the new approach to storing user last activity in the bp activity table:</strike> This script is now updated to use BP functions rather than WP usemeta: http://bpdevel.wordpress.com/2014/02/21/user-last_activity-data-and-buddypress-2-0/ *

Short function to get WP usermeta 'last_activity' key/value if exists if not add a value for all WP users to enable BuddyPress to show users in it's lists.

The function can be copied to and run from a theme functions file.

Run via a url action '?action=force-active' and as super_admin only.

This is STRICTLY a developer convenience on test sites to get a number of test users showing in BP lists without needing to log in as each one.

It serves no purpose in a production environment and would cause issues if run.
