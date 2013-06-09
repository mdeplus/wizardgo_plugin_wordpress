<?php
/*
Plugin Name: WizardGo Audio Player - Hear your content aloud
Plugin URI: http://www.wizardgo.com
Description: WizardGo Audio Player is a plugin that allows your visitors to listen to a beautiful narration of your posts.  Engage and amaze your users, allowing them to interact with your content in a new way, by listening to it.  You think this *sounds* too good to be true?  We challenge you to give it a try and draw your own conclusions!  Visitors will love to hear your content aloud!
Version: 0.5
Author: WizardGo
Author URI: http://www.wizardgo.com
License: GPLv2 or later
*/


if( !function_exists('wizardgo_player_add_div_to_post')){
	function wizardgo_player_add_div_to_post( $content='' ) {
		global $wp_query;

		if ( is_single() ) {
			$permalink = get_permalink($wp_query->post->ID); //get post link

			$content = sprintf('<div class="wg-player" data-canonical="%s"></div><div class="wg-player-content">%s</div>', $permalink, $content);
		}
		
		return $content;
	}
	
	add_filter( 'the_content', 'wizardgo_player_add_div_to_post' );
}

if( !function_exists('wizardgo_player_js') ) {
	function wizardgo_player_js(){
		echo <<<EOT
<script>
(function(id) {
  var js, jss = document.getElementsByTagName('script')[0];
  if (document.getElementById(id)) return;
  js = document.createElement('script'); js.id = id;
  js.src = "http://wizardgo.com/player/embed.js";
  jss.parentNode.insertBefore(js, jss);
}('wizardgo-player'));
</script>
EOT;
	}

	add_action('wp_footer', 'wizardgo_player_js', 5);
}
?>