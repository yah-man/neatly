<?php
defined( 'ABSPATH' ) || exit;
/**
 *
 * @package Neatly
 */
/*post title*/

function neatly_title_post(){
	echo '<h1 class="post_title fs24 fw_bold lh15">'. get_the_title().'</h1>';
}

function neatly_title_page(){
	echo '<h1 class="post_title fs24 fw_bold lh15">'. get_the_title().'</h1>';
}

