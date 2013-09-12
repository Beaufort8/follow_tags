<?php
/**
 * help/save form body
 *
 *
 * for Elgg 1.8
 */

//Get current Tags from logged in User and Notify value
$value = getCurrentTagsFrom(elgg_get_logged_in_user_guid());
$check =getNotificationSettings(getID(elgg_get_logged_in_user_guid()));

	
//Create Views Elements
$save_btn = elgg_view('input/submit', array( 'value' => elgg_echo('save'),	
											 'class' => 'elgg-button-submit ',
									));

$current_tags =  elgg_view('output/tags', array( 'name' => 'current_followtags',
											  	 'value' => explode(",",$value),
											));	   


$follow_tags	 = elgg_view('input/tags', array( 'name' => 'followtags',
											      'value' => $value,
											      'id'   => 'follow',
											));

$follow_tags_checkbox	 = elgg_view('input/checkbox', array( 'name' => 'notifyfollow',
											      			  'checked'   => $check,
																));



$strings_title_tag = elgg_echo("follow_tags:settings:title:tags");
$strings_title_notify = elgg_echo("follow_tags:settings:title:notify");
$strings_notify_description = elgg_echo("follow_tags:settings:notify:description");

// Display Elements
echo <<< HTML

<div class="followtags_settings">
<div class="elgg-module elgg-module-info">
	<div class="elgg-head">
		<h3>$strings_title_tag</h3>
	</div>

<div class="current_tags_field">$current_tags</div>
<div class="follow_tagsinput">$follow_tags</div>

</div>
</div>


<div class="notification_personal">
<div class="elgg-module elgg-module-info">
	<div class="elgg-head">
		<h3>$strings_title_notify</h3>
	</div>
</div>

<table id="notificationstable" cellspacing="0" cellpadding="4" width="100%">
	<tr>
		<td>$strings_notify_description</td>
		<td><a>$follow_tags_checkbox</a></td>
	</tr>
</table>
</div>

<div class="elgg-footer">
	$save_btn
</div>


HTML;


?>



