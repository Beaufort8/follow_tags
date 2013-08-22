<?php
/**
 * FollowTags Settings Page
 *
 *
 * for Elgg 1.8
 */

// Abfrage ob der eingeloggte Nutzer diese Seite besuchen darf oder ob er Admin is
// Page for Usersettings



$title = elgg_echo('follow_tags:settings:title');

$user = elgg_get_logged_in_user_entity();
elgg_push_context("settings");
elgg_set_page_owner_guid($user->getGUID());



elgg_push_breadcrumb(elgg_echo('Settings'),"settings/user/$user->username");
elgg_push_breadcrumb($title);


 $content = elgg_view_title($title);
 $content .= elgg_view_form('follow_tags/save');

 // use a special admin layout
 $body = elgg_view_layout('one_sidebar', array('content' => $content));

 echo elgg_view_page($title, $body);