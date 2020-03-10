<?php
defined( 'ABSPATH' ) || exit;
/**
 * Header Settings
 *
 * @package Neatly
 */


/*Neatly 投稿ページ セクション並び替え*/
$wp_customize->add_section('header_tagline_sections',array(
	'title' => esc_html__('Tagline','neatly'),
	'panel' => 'header_panel',
));

$wp_customize->add_setting( 'neatly_tagline_display', array(
	'default'           => true,
	'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control( 'neatly_tagline_display', array(
	'label'    => esc_html__( 'Display', 'neatly' ),
	'section'  => 'header_tagline_sections',
	'type' => 'checkbox',
));








