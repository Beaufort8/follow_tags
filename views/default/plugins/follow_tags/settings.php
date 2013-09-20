<?php
/**
 * Groups plugin settings
 */
 $yesno_options = array(
		"yes" => elgg_echo("follow_tags:option:yes"),
		"no" => elgg_echo("follow_tags:option:no")
);

$char_options = array(
		"1" => elgg_echo("1"),
		"2" => elgg_echo("2"),
		"3" => elgg_echo("3"),
		"4" => elgg_echo("4"),
		"5" => elgg_echo("5"),
);


 
echo "<div>";
echo elgg_echo('follow_tags:settings:autocomplete');
echo elgg_view("input/dropdown", array("name" => "params[autocomplete]", "options_values" => $yesno_options, "value" => $vars['entity']->autocomplete));
echo "</div>";



echo "<div>";
echo elgg_echo('follow_tags:settings:minChar');
echo elgg_view("input/dropdown", array("name" => "params[minChar]", "options_values" => $char_options, "value" => $vars['entity']->minChar));
echo "</div>";


echo "<div>";
echo elgg_echo('follow_tags:settings:threshold');
echo elgg_view("input/dropdown", array("name" => "params[threshold]", "options_values" => $char_options, "value" => $vars['entity']->threshold));
echo "</div>";


echo "<div>";
echo elgg_echo('follow_tags:settings:defaultTags');
echo elgg_view("input/text", array("name" => "params[defaultTags]", "value" => $vars['entity']->defaultTags));
echo "</div>";


