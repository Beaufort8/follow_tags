<?php
/**
 * Activity Tags and save form body
 *
 *
 * for Elgg 1.8
 */

//Get current Tags from logged in User and Notify value
$value = follow_tags_get_current_tags(elgg_get_logged_in_user_guid());


//Create Views Elements
$save_btn = elgg_view('input/submit', array(
	'value' => elgg_echo('save'),
	'class' => 'elgg-button-submit',
	));

$follow_tags = elgg_view('input/tags', array(
	'name' => 'followtags',
	'value' => $value,
	'id' => 'follow',
	));




// Display Elements
echo <<< HTML

<div class="follow_tagsinput">$follow_tags</div>

<div class="followtags_save hidden">
	$save_btn
</div>


<script>
 $(document).ready(function () {
	$( ".follow_tagsinput" ).focus(function() {
  		$(".followtags_save").show();
	});
});
</script>

HTML;

