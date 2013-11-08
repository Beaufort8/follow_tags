<?php
/**
* Save / Change Action
**/

//Get Notification Settings
$notify_input = get_input('notifyfollow');

//Save the FollowTags in the TagObj
follow_tags_save_notify(follow_tags_get_tag_guid(elgg_get_logged_in_user_guid()), $notify_input);

forward(REFERER);
