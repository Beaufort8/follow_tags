<?php
/**
 * Main activity stream list page
 */

$options = array();

$page_type = 'tags';
$type = get_input('type', 'all');
$subtype = get_input('subtype', '');
if ($subtype) {
	$selector = "type=$type&subtype=$subtype";
} else {
	$selector = "type=$type";
}

if ($type != 'all') {
	$options['type'] = $type;
	if ($subtype) {
		$options['subtype'] = $subtype;
	}
}


$title = elgg_echo('river:tags');


//Option vor FollowTags
	
$value_ids ="value_id = 11 OR value_id = 2921";
$test ="object_guid IN ( SELECT  entity_guid FROM elgg_metadata WHERE $value_ids  ) AND action_type = 'create'";
$options['wheres'] = array($test);



$activity = elgg_list_river($options);
if (!$activity) {
		
		$content = "";
		
		$activity = elgg_echo('follow_tags:noactivity') ;

}




$content = elgg_view('core/river/filter', array('selector' => $selector));
$sidebar = elgg_view('core/river/sidebar');

$params = array(
	'content' =>  $content . $activity,
	'sidebar' => $sidebar,
	'filter_context' => 'tags',
	'class' => 'elgg-river-layout',
);

$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);

?>

<script>
	$(document).ready(function(){
     $('.elgg-menu-item-tags').addClass('elgg-state-selected');    
    });
 </script>

