<?php
  
$minChar = elgg_get_plugin_setting("minChar", "follow_tags");
	if(!$minChar) {
		$minChar = 2; // Set Default minChar
	}

?>

elgg.provide('elgg.tags_input');

elgg.tags_input.init = function() {
	$('.elgg-input-tags').each(function(){
		var el = $(this);
		$.getJSON( '<?php echo elgg_get_site_url(); ?>follow_tags_data', function( tags ) {	
			$(el).tagit({
				placeholderText: '<?php echo elgg_echo("follow_tags:tags_input:add"); ?>',
				availableTags: tags
			});
		});
	});
}

elgg.register_hook_handler('init','system',elgg.tags_input.init);
