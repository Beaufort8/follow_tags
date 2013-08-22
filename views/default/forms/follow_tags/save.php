<?php
/**
 * help/save form body
 *
 *
 * for Elgg 1.8
 */




// ------------  Create Views  -----------------------------

$instructions = elgg_echo('follow_tag:settings:instructions');
$follow_tag	 = elgg_view('input/tags', array( 'name' => 'fallowtag',
											  'value' => $value,
											));
$button = elgg_view('input/submit', array( 'value' => elgg_echo('save')));

//---------------------------------------------------------

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