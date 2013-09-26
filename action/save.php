<?php
/**
* Save / Change Action
**/

//Get Tags from Taginput
$follow_tag_input = get_input('followtags');

//Get Notification Settings
$notify_input = get_input('notifyfollow');

//Save the FollowTags in the TagObj
if (!saveFollowTags($follow_tag_input, getID(elgg_get_logged_in_user_guid()), $notify_input)) {
    register_error(elgg_echo("follow_tags:save:error"));
} else {
	system_message(elgg_echo("follow_tags:save:message"));
}

forward(REFERER);
