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
//Get All TagsID´s from FollowTagsObject 
$cnt = false;
$tags = get_metadata_byname (getID(elgg_get_logged_in_user_guid()),'tags');
		foreach ($tags as $tag) {
  			$tagid = $tag['value_id'];
			if($cnt) {
				$value_ids .= " OR ";
			}
			$cnt = true;
			$value_ids .= "value_id = $tagid";

}

$sql_where ="object_guid IN ( SELECT  entity_guid FROM elgg_metadata WHERE $value_ids  ) AND action_type = 'create'";
$options['wheres'] = array($sql_where);


$activity = elgg_list_river($options);
if (!$activity) {
		
		$content = "";
		$activity = elgg_echo('follow_tags:noactivity') ;
}	

//Get Riverfilter
$content = elgg_view('core/river/filter', array('selector' => $selector));
//Get Settingsform
$content .= elgg_view_form('follow_tags/save');
//Get Sidebar
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
<!-- Current solution for TagTab selected state problem -->
<script type="text/javascript">
$(document).ready(function(){
     $('.elgg-menu-item-tags').addClass('elgg-state-selected');    


});
</script>




