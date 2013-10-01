<?php
/**
 * follow_tags plugin settings.
 *
 */
$yesno_options = array(
		"false" => elgg_echo("option:no"),
		"true" => elgg_echo("option:yes")
);

$char_options = range(0,5);
$tag_options = range(0,25);

//integer  dropdowns
$minChar = elgg_view("input/dropdown", array("name" => "params[minChar]", "options_values" => $char_options, "value" => $vars['entity']->minChar));
$threshold = elgg_view("input/dropdown", array("name" => "params[threshold]", "options_values" => $char_options, "value" => $vars['entity']->threshold));
$tagLimit = elgg_view("input/dropdown", array("name" => "params[tagLimit]", "options_values" => $tag_options, "value" => $vars['entity']->tagLimit));

//boolean dropdowns
$removeConfirmation = elgg_view("input/dropdown", array("name" => "params[removeConfirmation]", "options_values" => $yesno_options, "value" => $vars['entity']->removeConfirmation));
$caseSensitive = elgg_view("input/dropdown", array("name" => "params[caseSensitive]", "options_values" => $yesno_options, "value" => $vars['entity']->caseSensitive));
$allowSpaces = elgg_view("input/dropdown", array("name" => "params[allowSpaces]", "options_values" => $yesno_options, "value" => $vars['entity']->allowSpaces));

// generate output
$body ="<table class='elgg-table-alt'>";
$body.="<tr><th>setting</th><th>value</th><th>description</th></tr>";
	$body.="<tr><td>minChar</td><td>".$threshold."</td><td>". elgg_echo('follow_tags:settings:minChar')."</td></tr>";	
	$body.="<tr><td>threshold</td><td>".$threshold."</td><td>". elgg_echo('follow_tags:settings:threshold')."</td></tr>";	
	$body.="<tr><td>tagLimit</td><td>".$tagLimit."</td><td>". elgg_echo('follow_tags:settings:tagLimit')."</td></tr>";	
	$body.="<tr><td>removeConfirmation</td><td>".$removeConfirmation."</td><td>". elgg_echo('follow_tags:settings:removeConfirmation')."</td></tr>";	
	$body.="<tr><td>caseSensitive</td><td>".$caseSensitive."</td><td>". elgg_echo('follow_tags:settings:caseSensitive')."</td></tr>";
	$body.="<tr><td>allowSpaces</td><td>".$allowSpaces."</td><td>". elgg_echo('follow_tags:settings:allowSpaces')."</td></tr>";	
$body.="</table>";

echo elgg_view_module("inline", elgg_echo("Autocomplete Settings"), $body);

$body  = "<div>";
$body  .= elgg_echo('follow_tags:settings:defaultTags');
$body  .= elgg_view("input/text", array("name" => "params[defaultTags]", "value" => $vars['entity']->defaultTags));
$body  .= "</div>";

echo elgg_view_module("inline", elgg_echo("Default Tags"), $body);


?>
