<?php
/**
 *  Follow Tag by Alexander Stifel
 *
 *
 * @author Alexander Stifel
 * @copyright Alexander Stifel 2013
 * @link http://www.beaufort8.de/
 *
 * for Elgg 1.8
 *
 */

function followers_init() {
	

	//Register Libary File 
    elgg_register_library('follow_tags', dirname(__FILE__) . '/lib/follow_tags_lib.php');
    elgg_load_library('follow_tags');


    //Register Save Action for saving and changing FollowTags
    elgg_register_action("follow_tags/save", dirname(__FILE__) . '/action/save.php');

	//Register a River Tab
	if (elgg_is_logged_in()) {
		$user = elgg_get_logged_in_user_entity();
		elgg_register_menu_item('filter', array(
			'name' => 'tags',
			'href' => "/activity/tags",
			'text' => "Tags",
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

	
	//Get de default Acitvity Page Handler
	global $CONFIG, $default_activity_page_handler;
	$default_activity_page_handler = $CONFIG->pagehandler['activity'];
	
	//Register Pagehanlder for activty and follow-tags settings
	elgg_register_page_handler('activity', 'followers_activity_page_handler');
	elgg_register_page_handler('follow_tags', 'follow_tags_page_handler');


}

function followers_activity_page_handler($segments, $handle) {
	switch ($segments[0]) {
		case 'tags':
			require_once dirname(__FILE__) . '/pages/activity/follow_tags.php';
		break;
		default:
			//Use the default activity pagehandler 
			global $default_activity_page_handler;
			return call_user_func($default_activity_page_handler, $segments, $handle);
		break;
	}
}

function follow_tags_page_handler($page){

 require_once dirname(__FILE__) . '/pages/follow_tags/settings.php';

 return true;
}




elgg_register_event_handler('init', 'system', 'followers_init');