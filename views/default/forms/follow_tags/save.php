<?php
/**
 * help/save form body
 *
 *
 * for Elgg 1.8
 */

//Get current Tags from logged in User
$value = getCurrentTagsFrom(elgg_get_logged_in_user_guid());


//Create Views Elements
$instructions = elgg_echo('follow_tags:settings:instructions');
$follow_tag	 = elgg_view('input/tags', array( 'name' => 'fallowtags',
											  'value' => $value,
											));
$button = elgg_view('input/submit', array( 'value' => elgg_echo('save')));


// Display Elements
echo <<< HTML
	


<div>
	<h3>$instructions</h3>
</div>

<div>
	$follow_tag
</div>



<div class="elgg-foot">
    $button
</div>


HTML;

?>