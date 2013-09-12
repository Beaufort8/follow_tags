<?php
  $minChar = elgg_get_plugin_setting("minChar", "follow_tags");  
   if(!$minChar) {
        $minChar = 2; // Set Default minChar
    }

   ?>
elgg.provide('elgg.tags_input');

elgg.tags_input.init = function() {
	

	    var availableTags = <?php echo getAllTags(); ?>;
	
		$('.elgg-input-tags').tagsInput({
			
			width:'auto',
			height:'auto',
			defaultText:'<?php echo elgg_echo('follow_tags:tags_input:add');?>', 
			placeholderColor:'#aaa',
			autocomplete_url:availableTags,
			autocomplete: {minLength:<?php echo $minChar; ?> },

		});
		
}

elgg.register_hook_handler('init','system',elgg.tags_input.init);







