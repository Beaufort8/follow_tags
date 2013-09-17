<?php
/**
 * FollowTags Form for the activity stream
 *
 *
 * for Elgg 1.8
 */

//Get current Tags from logged in User
$value = getCurrentTagsFrom(elgg_get_logged_in_user_guid());


$user = elgg_get_logged_in_user_entity();
$username = $user->username;

$changeSettingsString = elgg_echo('follow_tags:changesettings');


if($value){

//Create Views Elements
$current_tags =  elgg_view('output/tags', array( 'name' => 'followtags',
											  	 'value' => explode(",",$value),
											));	   

}

// Display Elements
echo <<< HTML

<div>
	<!--Create a Settings Button -->
	<a class="elgg-button elgg-button-action button-tags-changesettings" href="/follow_tags/settings/$username"><span class="elgg-icon elgg-icon-settings-alt"></span>$changeSettingsString</a>

	<div style="" class="activity-tags">
	<!--Show current tags -->
	$current_tags
	</div>
</div>

HTML;


?>


