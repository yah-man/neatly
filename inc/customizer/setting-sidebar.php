<?php
defined( 'ABSPATH' ) || exit;
/**
 * Sidebar Settings
 *
 * @package Neatly
 */


/*Neatly サイドバー表示方法*/
$wp_customize->add_section('sidebar_display_sections',array(
	'title' => esc_html__('Display','neatly'),
	'panel' => 'sidebar_panel',
));

$wp_customize->add_setting( 'neatly_sidebar_display', array(
	'default'           => 'all',
	'sanitize_callback' => 'neatly_sanitize_radio',
));
$wp_customize->add_control( 'neatly_sidebar_display', array(
	'label'    => esc_html__( 'Sidebar display', 'neatly' ),
	'section'  => 'sidebar_display_sections',
	'type'     => 'radio',
	'choices'  => array(
		'none' => esc_html__( 'Hidden', 'neatly' ),
		'all' => esc_html__( 'All', 'neatly' ),
		'index' => esc_html__( 'Only index', 'neatly' ),
	),
));


$wp_customize->add_setting( 'neatly_sidebar_single_mobile_display', array(
	'default'           => false,
	'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control( 'neatly_sidebar_single_mobile_display', array(
	'label'    => esc_html__( 'Access from mobile not display only when single page', 'neatly' ),
	'section'  => 'sidebar_display_sections',
	'type' => 'checkbox',
));






