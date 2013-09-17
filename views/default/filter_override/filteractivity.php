<?php

$base=elgg_get_site_url()."activity/";

$tabs = array(
	'mine' => array(
		'title' => elgg_echo('activity_plus:mine'),
		'url' => $base.'mine',
		'selected' => $vars['selected']=='mine',
		),
	'groups' => array(
		'title' => elgg_echo('activity_plus:groups'),
		'url' => $base.'groups',
		'selected' => $vars['selected']=='groups',
		),
	'tags' => array(
		'title' => elgg_echo('follow_tags:tab:title'),
		'url' => $base."tags",
		'selected' => $vars['selected']=='tags',
		),
	'all' => array(
		'title' => elgg_echo('activity_plus:all'),
		'url' => $base."all",
		'selected' => $vars['selected']=='all',
		),
	
	);

echo elgg_view('navigation/tabs',array('tabs'=>$tabs));
