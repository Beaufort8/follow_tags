<?php
/**
* Save /Change Action for Help Plugin
*
**/


//Get Tags from Taginput
$follow_tag_input  = get_input('fallowtags');

//Save the FollowTags in the TagObj
if(!saveFollowTags($follow_tag_input,getID(elgg_get_logged_in_user_guid()))){
    register_error(elgg_echo("Follow Tags konnten nicht gespeichert werden!"));
}else{
	system_message("$follow_tag_input -> Tags are saved");
}

forward(REFERER);







