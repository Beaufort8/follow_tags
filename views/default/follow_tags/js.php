<?php
  
$minChar = elgg_get_plugin_setting("minChar", "follow_tags");
if(!$minChar) {
	$minChar = 2; // Set Default minChar
}

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
			el.tagsInput({
				autocomplete_url:tags,
				// target: autocomplete_url: ["Marketing","Australia","Berlin", ...],
				// does not function:
				// autocomplete_url:'<?php echo elgg_get_site_url(); ?>follow_tags_data',
				width:'auto',
				height:'auto',
				defaultText:'<?php echo elgg_echo('follow_tags:tags_input:add'); ?>',
				placeholderColor:'#aaa',
				minChars: <?php echo $minChar; ?>,
			});
		});
	});
}

elgg.register_hook_handler('init','system',elgg.tags_input.init);
