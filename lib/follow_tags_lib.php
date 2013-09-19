<?php
/**
 *  Follow Tag Libary
 *
 */

/**
 * Return true if there is only one Object for each User else return false
 *
 */

function existFollowTagObject($guid){
	$num_tags = elgg_get_entities(array(
		'type' => 'object' ,
		'subtype' => 'FollowTags',
		'owner_guid' => $guid,
		'count'  => true,
		));
	if($num_tags == 1) return true;
	return false;
}

/**
 * Create FollowTags
 *
 */

function createFollowTagObject(){
	$user = elgg_get_logged_in_user_entity();

	$followTag = new ElggObject();
	$followTag->subtype = "FollowTags";
	$followTag->owner_guid = elgg_get_logged_in_user_guid();
	$followTag->title = $user->name;
	$followTag->access_id = 1;
	$followTag->description = "";

	// Notify standard value 
	$followTag->notify = "on";

	if (!$followTag->save()) {
		register_error(elgg_echo("followTags:save:error"));
		forward(REFERER);
	}

	return true;
}

/**
 * Save FollowTags
 *
 */

function saveFollowTags($input,$id,$notify){
	// Get FollowTagObject and Clear all Tag Relationships
	$user = elgg_get_logged_in_user_entity();

	$followTags = get_entity($id);
	$followTags->clearRelationships();
	$followTags->description =$input;
	$followTags->title = $user->name;
	$followTags->access_id = 1;
	$followTags->notify = $notify;

	// Convert the Taginput string to array and save to FollowTagObj
	$tagarray = string_to_tag_array($input);
	$followTags->tags = $tagarray;

	$saved =$followTags->save();

	if(!$saved){
	  return false;
	}
	return true;
}

/**
 * Return the GUID of the FollowTagsObj
 *
 */

function getID($guid){
	$options = array(
		'type' => 'object' ,
		'subtype' => 'FollowTags',
		'owner_guid' => $guid,  
		);
	$tags = elgg_get_entities($options);

	foreach($tags as $tag) {
		$guid = $tag->getGUID();
	}
	return $guid;
}

/**
 * Return the current following tags
 *
 */

function getCurrentTagsFrom($guid){
	$options = array(
		'type' => 'object' ,
		'subtype' => 'FollowTags',
		'owner_guid' => $guid,    
		);
	$tags = elgg_get_entities($options);

	foreach($tags as $tag) {
		$value = $tag->description;
	}
	return $value;
}

/**
 * Return the Notificationsettings for FollowTags
 *
 */

function getNotificationSettings($guid){

	$follow_tag_notify = get_entity($guid);
	$notify_value = $follow_tag_notify->notify;

	if($notify_value == "on") return true;

	return false;
}

/**
 * Notify User
 *
 */

function followtags_notify($event, $type, $object) {

	//subtype 11,9,7,6 are notification, message, FollowTags, admin_notice
	//followtags_notify should not run if the create object have one of this subtypes
	 $sub = $object->subtype;
	//Dont notifyuser if object is private	
	 $access = $object->access_id; // 0 is private

	if($access != '0')
	{ 
		//Get all tags from created Object
		$tags = get_metadata_byname ($object->guid,'tags');

		//Check the number of tags and handle 0 and 1 tags
		switch (count($tags)) {
			case 0:
				return; //
				break;
			case 1:
				$tagid = $tags['value'];
		 	 	break;
			default:
				foreach ($tags as $tag) {
				$tagid .= $tag['value'];
				$tagid .= ",";
			}
		 	break;
		 }

		//Create Tagarray 
		$tagarray = explode(",",$tagid);

		//Compare object tags with all FollowTagsObject  
		$users = elgg_get_entities_from_metadata(array(
			'type' => 'object' ,
			'subtype' => 'FollowTags',
			'metadata_values' => $tagarray,
			)); 

		//Check how many user follow object tags and create a acceptor array
	
		if(count($users) == 1){
			 // Only one user 
			 $follow_tag_notify = get_entity($users[0][guid]);
			 $notify_value = $follow_tag_notify->notify;
			 if($notify_value == "on"){     
			 	$to = $users[0]['owner_guid'];
			} else {
				return;
			}

			if($to == get_loggedin_user()->guid){
				//Dont notify creator
				return;
			}
		} else {
			// More than 1 user
			foreach ($users as $user) {
				// Get guid from following user
				if($user->owner_guid != get_loggedin_user()->guid){
					//Create a string with all users
					if($user->notify == "on"){
						$to .= $user->owner_guid;
						$to .= ",";  
					}
				}
			}
		}

		//Create Notifcation subject and body
		$ftObj = get_entity($object->owner_guid);
		$creator = $ftObj->name;

		$subject = elgg_echo('follow_tags:notification:subject');
		$body = elgg_echo('follow_tags:notification:body');
		$body .= "<br>" ;
		$body .= "$creator";
		$body .= elgg_echo('follow_tags:notification:body:creator');
		$body .= "<br>" ;
		$body .= $object->getURL();

		//Prefend empty array element
		$lastChar = substr($to, -1);
		if($lastChar == ',') {
			$to = substr_replace($to,"",-1);
		}

		//Create acceptor-Array
		$toArray = explode(",",$to);

		// Notify user 
		// 1 is sender id from the elgg site
		notify_user($toArray, 1, $subject, $body, NULL);
	}
}

/**
 * Return all Site Tags for jQuery Tags Inpug plugin
 * see
 * https://github.com/xoxco/jQuery-Tags-Input
 * for Examples
 * https://github.com/xoxco/jQuery-Tags-Input/tree/master/test
 *
 */

function getAllTags(){
	if(elgg_get_plugin_setting("autocomplete", "follow_tags") == 'yes'){
		$threshold = elgg_get_plugin_setting("threshold", "follow_tags");  
		if(!$threshold) {
			// Set Default threshold
			$threshold = 2; 
		}

		$options = array(
			'limit'=>1000,
			'threshold' => $threshold,
			);
		$tags =elgg_get_tags($options);
		
		foreach ($tags as $tag) {
			$json[]=$tag->tag;
		}
		$json = array_merge($json, explode(",",elgg_get_plugin_setting("defaultTags", "follow_tags")));
		$json = json_encode($json);
	}
	return $json;
}


function getActivityFollowTags($options){

	$tags = get_metadata_byname (getID(elgg_get_logged_in_user_guid()),'tags');
	$cnt = 0;

	//Count the followTags and Create string for the SQL-query
	
	switch (count($tags)) {
		case 0:
		break;

		case 1:
		
			$tagid = $tags['value_id'];
			$value_ids = "value_id = $tagid";

		break;
	
		default:
			foreach ($tags as $tag) {
			
				$tagid = $tag['value_id'];
				$cnt++;
				if($cnt != count($tags))
				{
					$value_ids .= "value_id = $tagid";
					$value_ids .= " OR ";
				}else{

					$value_ids .= "value_id = $tagid";
				}		
			}
		 break;
	}

	//Check if the user have any FollowTags
	$user = elgg_get_logged_in_user_entity();
	$user = $user->username;
		if(count($tags)!= 0 ){
		
			$sql_where ="object_guid IN ( SELECT  entity_guid FROM elgg_metadata WHERE $value_ids  ) AND action_type = 'create'";
			$options['wheres'] = array($sql_where);
		
		
			$activity = elgg_list_river($options);
		}
		return $activity;
	
	
		//Check if the user have any FollowTags
		$user = elgg_get_logged_in_user_entity();
		$user = $user->username;
		if(count($tags)!= 0 ){
	
			$sql_where ="object_guid IN ( SELECT  entity_guid FROM elgg_metadata WHERE $value_ids  ) AND action_type = 'create'";
			$options['wheres'] = array($sql_where);
	
			$activity = elgg_list_river($options);
	
			return $activity;
		}

}

function getFollowTagsForm(){
 	
 	$content = elgg_view_form('follow_tags/activity');

	return $content;
}
