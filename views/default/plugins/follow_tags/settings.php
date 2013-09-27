<?php

$yesno_options = array(
		"yes" => elgg_echo("option:yes"),
		"no" => elgg_echo("option:no")
);

$char_options = range(0,5);

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
