<?php

/*
Plugin Name: Top Bottom Content
Description: Throw arbitrary content in the top and bottom of a post

Author: Michael Bianco
Author URI: http://cliffsidemedia.com/
Plugin URI: https://github.com/iloveitaly/wordpress-top-bottom-content

Version: 1.0
License: MIT
*/


define( 'TBC_PLUGIN_PATH', dirname( __FILE__ ) );
define( 'TBC_WEB_ROOT', str_replace( getcwd(), home_url(), dirname(__FILE__) ) );

// register options
register_activation_hook(__FILE__, 'tbc_setup_options');
function tbc_setup_options() {
	add_option('tbc_options', '');
}

if(is_admin()) {
	add_action('admin_menu', 'tbc_create_admin_menu');
	function tbc_create_admin_menu() {
		add_options_page('Top + Bottom Post Content', 'Top + Bottom Content', 'manage_options', 'tbc_options', 'tbc_admin_options_page');
	}

	add_action('admin_init', 'tbc_register_settings');
	function tbc_register_settings() {
		register_setting('tbc_options', 'tbc_enabled');
		register_setting('tbc_options', 'tbc_top_content');
		register_setting('tbc_options', 'tbc_bottom_content');
	}
}

function tbc_admin_options_page() {
	load_template(TBC_PLUGIN_PATH . '/templates/admin.php');
}

add_filter('the_content', 'tbc_add_content');
function tbc_add_content($content) {
	if(is_feed() || is_page()) {
		return $content;
	}

	$enabled = get_option('tbc_enabled');
	if(!empty($enabled)) {
		$top_content = get_option('tbc_top_content');
		$bottom_content = get_option('tbc_bottom_content');

		if(!empty($top_content)) {
			$top_content = do_shortcode($top_content);
			$content = $top_content . $content;
		}

		if(!empty($bottom_content)) {
			$bottom_content = do_shortcode($bottom_content);
			$content = $content . $bottom_content;
		}
	}

	return $content;
}
