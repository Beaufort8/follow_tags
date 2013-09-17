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


//Create Views Elements
$current_tags =  elgg_view('output/tags', array( 'name' => 'followtags',
											  	 'value' => explode(",",$value),
											));	   

// Display Elements
echo <<< HTML

<div style="padding:5px;">
	<!--Create a Settings Button -->
	<a style="float:left"; href="/follow_tags/settings/$username"><span class="elgg-icon elgg-icon-settings-alt "></span>Change Settings</a>

	<!--Show current tags -->
	$current_tags

</div>

HTML;


?>
<div id="container">
  <dl>
    <dt>Hier steht die Überschrift <a href="#" id="button" class="closed">Details</a></dt>
    <dd>Hier steht die detallierte Beschreibung. Dieser Text wird erst nach einem Klick auf das übergeordnete Elemente (dt) eingeblendet. Parallel wird auch die Klasse des Links gewechselt um den Pfeil zu drehen.</

  </dl>
</div>

<script type="text/javascript">

$(document).ready(function(){
	$("dt").click(function(){ // trigger 
		$(this).next("dd").slideToggle("fast"); // blendet beim Klick auf "dt" die nächste "dd" ein. 
		$(this).children("a").toggleClass("closed open"); // wechselt beim Klick auf "dt" die Klasse des enthaltenen a-Tags von "closed" zu "open". 
	});
});

</script>

