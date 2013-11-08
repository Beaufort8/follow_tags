<?php 
/*
*	Get autocomplete settings
*/ 
$minChar = elgg_get_plugin_setting("minChar", "follow_tags");
	if(!$minChar) {
		$minChar = 2; // Set Default minChar
	}

$tagLimit = elgg_get_plugin_setting("tagLimit", "follow_tags");
	if(!$tagLimit OR $tagLimit == 0) {
		$tagLimit = null; // Set Default minChar
	}
	
$removeConfirmation = elgg_get_plugin_setting("removeConfirmation", "follow_tags");
	if(!$removeConfirmation) {
		$removeConfirmation	 = "true"; // Set Default minChar
	}
	
$caseSensitive = elgg_get_plugin_setting("caseSensitive", "follow_tags");
	if(!$caseSensitive) {
		$caseSensitive	 = "true"; // Set Default minChar
	}
	
$allowSpaces = elgg_get_plugin_setting("allowSpaces", "follow_tags");
	if(!$allowSpaces) {
		$allowSpaces	 = "false"; // Set Default minChar
	}
?>

elgg.provide('elgg.tags_input');

elgg.tags_input.init = function() {
	$('div:not(.mandatory) > .elgg-input-tags').each(function(){
		var el = $(this);
		$.getJSON( '<?php echo elgg_get_site_url(); ?>follow_tags_data', function( tags ) {	
			$(el).tagit({
				placeholderText: '<?php echo elgg_echo("follow_tags:tags_input:add"); ?>',
				availableTags: tags,
				autocomplete: {delay: 0, minLength: <?php echo $minChar; ?>},
				tagLimit: '<?php echo $tagLimit; ?>',
				removeConfirmation: <?php echo $removeConfirmation; ?>,	
				caseSensitive: <?php echo $caseSensitive;  ?>,
				allowSpaces: <?php echo $allowSpaces; ?>,

			});
		});
	});
}

elgg.register_hook_handler('init','system',elgg.tags_input.init);
