<?php
  
$minChar = elgg_get_plugin_setting("minChar", "follow_tags");
	if(!$minChar) {
		$minChar = 2; // Set Default minChar
	}

?>

elgg.provide('elgg.tags_input');

elgg.tags_input.init = function() {
	var availableTags = <?php echo follow_tags_get_all_tags(50); ?>	
	$('.elgg-input-tags').each(function(){
		$(this).attr("placeholder","add a tag");
		$(this).tagit({
			autocomplete: {
				delay: 0, 
				minLength: <?php echo $minChar ?>, 
				source:availableTags,
				}
		});
	});
}

elgg.register_hook_handler('init','system',elgg.tags_input.init);
