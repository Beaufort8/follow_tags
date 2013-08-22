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
$toggle ="Edit";

$follow_tag	 = elgg_view('input/tags', array( 'name' => 'fallowtags',
											  'value' => $value,
											 'class' => 'hidden',

											));

$current_tags =  elgg_view('output/tags', array( 'name' => 'current_fallowtags',
											  'value' => explode(",",$value),

											));	   

$button = elgg_view('input/submit', array( 'value' => elgg_echo('save'),
											'class' => 'hidden',
											'id'	=> 'tagSave',
									));



// Display Elements
echo <<< HTML
	


<div><p class="toggle">$toggle</p></div>

<div>$current_tags</div>

<div>$follow_tag</div>

<div class="elgg-foot">$button</div>


HTML;

?>

<script type="text/javascript">
$(document).ready(function(){
  $(".toggle").click(function(){
   $(".elgg-input-tags").toggle();
   $(".elgg-tags").toggle();
   $("#tagSave").toggle();
  });
});
</script>