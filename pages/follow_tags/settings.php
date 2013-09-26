<?php
/**
 * FollowTags Settings Page
 *
 *
 * for Elgg 1.8
 */

//Create a FollowTagsObject if logged in user have none
if (!follow_tags_has_follow_tag_object(elgg_get_logged_in_user_guid())) {
	follow_tags_create_follow_tag_object();
}

$title = elgg_echo('follow_tags:settings:title');

$user = elgg_get_logged_in_user_entity();
elgg_push_context("settings");
elgg_set_page_owner_guid($user->getGUID());

elgg_push_breadcrumb(elgg_echo('Settings'),"settings/user/$user->username");
elgg_push_breadcrumb($title);

$content  = elgg_view_title($title);

$content .= elgg_view_form('follow_tags/save');

$body = elgg_view_layout('one_sidebar', array('content' => $content));

echo elgg_view_page($title, $body);