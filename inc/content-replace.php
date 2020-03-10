<?php
defined( 'ABSPATH' ) || exit;
/**
 * Extra content
 *
 * @package Neatly
 */

add_filter('the_content','neatly_content_replace');

function neatly_content_replace($the_content) {

	if(get_post_format() === 'chat'){
		require_once NEATLY_THEME_DIR .  'template-parts/single/format-chat.php';
		$the_content = neatly_content_format_chat($the_content);
	}

	return $the_content;

}

