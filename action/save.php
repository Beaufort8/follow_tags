<?php
/**
* Save / Change Action
**/

//Get Tags from Taginput
$follow_tag_input = get_input('followtags');

//Save the FollowTags in the TagObj
if (!follow_tags_save_follow_tags($follow_tag_input, follow_tags_get_tag_guid(elgg_get_logged_in_user_guid()), $notify_input)) {
    register_error(elgg_echo("follow_tags:save:error"));
} else {
	system_message(elgg_echo("follow_tags:save:message"));
}

forward(REFERER);
