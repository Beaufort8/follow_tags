<?php
/**
 *  Follow Tag Lib
 *
 */


function existFollowTagObject($guid){
	$num_tags = elgg_get_entities(array('type' => 'object' ,
                  'subtype' => 'FollowTags',
                  'owner_guid' => $guid,
                  'count'  => true,              
                  ));
	//Return true if there is only one Object for each User else return false
	if($num_tags == 1){ return true; }else{ return false;}
}


function createFollowTagObject(){
	$followTag = new ElggObject();
	$followTag->subtype = "FollowTags";
	$followTag->owner_guid = elgg_get_logged_in_user_guid();
	$followTag->title = "Iam a FollowTags Object";
	$followTag->description = "";
	
	if (!$followTag->save()) {
    register_error(elgg_echo("followTags:save:error"));
    forward(REFERER);
	}

	return true;
}

function saveFollowTags($input,$id){
	//Get FollowTagObject and Clear all Tag Relationships
	$followTags = get_entity($id);
	$followTags->clearRelationships();
	$followTags->description =$input;

	//Convert the Taginput string to array and save to FollowTagObj
	$tagarray = string_to_tag_array($input);
	$followTags->tags = $tagarray;
	
	$saved =$followTags->save();
 
	if(!$saved){
  		return false;
	}
 		return true;
}


function getID($guid){
    $options = array('type' => 'object' ,
                  'subtype' => 'FollowTags',
                  'owner_guid' => $guid,    
                                             );
    $tags = elgg_get_entities($options);

    foreach($tags as $tag) {
        $guid = $tag->getGUID();
    }
    //Return the GUID of the FollowTagObj
    return $guid;
}

function getCurrentTagsFrom($guid){
    $options = array('type' => 'object' ,
                  'subtype' => 'FollowTags',
                  'owner_guid' => $guid,    
                                             );
    $tags = elgg_get_entities($options);

    foreach($tags as $tag) {
        $value = $tag->description;
    }
    return $value;
}



