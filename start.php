<?php

require_once(dirname(__FILE__) . "/lib/functions.php");

elgg_register_event_handler('init', 'system', 'follow_tags_init');

function follow_tags_init() {
	
	// Load follow-tags configuration

	if(elgg_get_plugin_setting("followTags", "follow_tags") == "true") {
			
		// Register Cache-Clear hook after change admin settig
		elgg_register_plugin_hook_handler("setting", "plugin", "follow_tags_setting");
	
		//Register Save Action for saving and changing FollowTags
		elgg_register_action("follow_tags/save", dirname(__FILE__) . '/action/save_notify.php');	
		elgg_register_action("follow_tags/activity", dirname(__FILE__) . '/action/save.php');	
		

		//Register a River Tab
		if (elgg_is_logged_in()) {
			$user = elgg_get_logged_in_user_entity();
			elgg_register_menu_item('filter', array(
				'name' => 'tags',
				'href' => "/activity/tags",
				'text' => elgg_echo("follow_tags:tab:title"),
				'priority' => 500,
				'contexts' => array('activity'),
			
			));

			//Register a Sidebar Item for Usersettings
			elgg_register_menu_item('page', array(
				'name' => "follow_tags",
				'text' => elgg_echo("follow_tags:sidebar:title"),
				'href' => "follow_tags/settings/" . $user->username,
				'context' => "settings",
			));
		}
	
		elgg_register_plugin_hook_handler("route", "activity", "follow_tags_route_activity_hook");
	
		//Register Pagehandlers
		elgg_register_page_handler('follow_tags', 'follow_tags_page_handler');
	
	}

	//Register Pagehandlers
	elgg_register_page_handler('follow_tags_data', 'follow_tags_data_page_handler');

	//Register JS and CSS for custom taginput field
	$js_url = 'mod/follow_tags/vendors/tag-it.min.js';
	elgg_register_js('jquery.tagsinput', $js_url);
	
	// Register CSS for TagInput
	$css_url = 'mod/follow_tags/vendors/tag-it.css';
	elgg_register_css('jquery.tagsinput', $css_url);
	
	// extend tags to include js/css just in time
	elgg_extend_view("input/tags", "follow_tags/extends/tags");
	
	// Add a JavaScript Initialization
	elgg_extend_view('js/elgg','js/follow_tags/site');
	 
	// Run the followtags_notofy function in event is triggerd
	elgg_register_event_handler('create', 'object', 'follow_tags_notify', 501);
	
}

function follow_tags_data_page_handler() {
	echo follow_tags_get_all_tags(50);
	return true;
}

function follow_tags_route_activity_hook($hook, $type, $return_value, $params) {
	$result = $return_value;
	
	if ($page = elgg_extract("segments", $return_value)){
		if (elgg_extract(0, $page) == "tags") {
			include(dirname(__FILE__) . '/pages/activity/follow_tags.php');
			
			$result = false; // block other page handlers
		}
	}
	
	return $result;
}

function follow_tags_page_handler($page){
	require_once dirname(__FILE__) . '/pages/follow_tags/settings.php';
	return true;
}
