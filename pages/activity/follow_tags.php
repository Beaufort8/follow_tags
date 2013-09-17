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
$tags = get_metadata_byname (getID(elgg_get_logged_in_user_guid()),'tags');
$cnt = 0;

//Count the followTags and Create string for the SQL-query
	
switch (count($tags)) {
    case 0:
    break;

    case 1:
        
       	$tagid = $tags['value_id'];
		$value_ids = "value_id = $tagid";

    break;
    
    default:
        foreach ($tags as $tag) {
			
			$tagid = $tag['value_id'];
			$cnt++;
			if($cnt != count($tags))
			{
				$value_ids .= "value_id = $tagid";
				$value_ids .= " OR ";
			}else{

				$value_ids .= "value_id = $tagid";
			}
			
		}
     break;
}


//Check if the user have any FollowTags
$user = elgg_get_logged_in_user_entity();
$user = $user->username;
if(count($tags)!= 0 ){

	$sql_where ="object_guid IN ( SELECT  entity_guid FROM elgg_metadata WHERE $value_ids  ) AND action_type = 'create'";
	$options['wheres'] = array($sql_where);


	$activity = elgg_list_river($options);
	if(!$activity){

			$content = "";
			
			$activity = '<div class="emptynotice">';
					$activity .= elgg_echo('follow_tags:notags') . ' ';
					$activity .= elgg_view('output/url', array(
						'text' => elgg_echo('follow_tags:notags:settings'),
						'href' => "follow_tags/settings/$user",
						'is_trusted' => true
						));
					$activity .= '.</div>';
	}


}else{
		
	$content = "";

	$activity = '<div class="emptynotice">';
					$activity .= elgg_echo('follow_tags:notags') . ' ';
					$activity .= elgg_view('output/url', array(
						'text' => elgg_echo('follow_tags:notags:settings'),
						'href' => "follow_tags/settings/$user",
						'is_trusted' => true
						));
					$activity .= '.</div>';

}



//Get Edit Button and Current Tags
$content = elgg_view_form('follow_tags/activity');

//Get Riverfilter
$content .= elgg_view('core/river/filter', array('selector' => $selector));

//Get Sidebar
$sidebar = elgg_view('core/river/sidebar');

$params = array(
        'content' => $content . $activity,
        'sidebar' => $sidebar,
        'filter_override' => elgg_view('filter_override/filteractivity',array('selected'=>$page_filter)),
        'class' => 'elgg-river-layout',
        
);



/*
$params = array(
	'content' =>  $content . $activity,
	'sidebar' => $sidebar,
	'filter_context' => 'tags',
	'class' => 'elgg-river-layout',
);

*/

$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);


?>
<!-- Current solution for TagTab selected state problem -->
<script type="text/javascript">
$(document).ready(function(){
     $('.tag-tab').addClass('elgg-state-selected');    
});
</script>




