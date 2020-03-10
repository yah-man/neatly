<?php
defined( 'ABSPATH' ) || exit;
/**
 * YAHMAN Add-ons Settings
 *
 * @package Neatly
 */


/*YAHMAN Add-ons*/

/*Neatly Pageview設定*/
$wp_customize->add_section('neatly_pageview_setting',array(
  'title' => esc_html__('Pageview', 'neatly'),
  'panel' => 'yahman_addon_panel',
));


$wp_customize->add_setting('pageview',array('sanitize_callback' => 'absint',));
$wp_customize->add_control('pageview',array(
  'section' => 'neatly_pageview_setting',
  'type' => 'hidden'
));
$wp_customize->selective_refresh->add_partial( 'pageview', array(
  'selector' => '.page_view',
));


$wp_customize->add_setting( 'neatly_pageview',array(
  'default'    => 'all',
  'sanitize_callback' => 'neatly_sanitize_select',
));
$wp_customize->add_control( 'neatly_pageview',array(
  'label'   => esc_html__( 'Display page view at the each post.', 'neatly'),
  'section' => 'neatly_pageview_setting',
  'type' => 'select',
  'choices' => array(
    //'none' =>  esc_html__( 'Hide', 'neatly' ),
    'all' => esc_html__('Page View', 'neatly'),
    'yearly' => esc_html__('Yearly Page View', 'neatly'),
    'monthly' => esc_html__('Monthly Page View', 'neatly'),
    'weekly' => esc_html__('Weekly Page View', 'neatly'),
    'daily' => esc_html__('Daily Page View', 'neatly'),
  ),
));

$wp_customize->add_setting( 'neatly_pageview_logout',array(
  'default'    => false,
  'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control( 'neatly_pageview_logout',array(
  'label'   => esc_html__( 'Enable', 'neatly'),
  'description' => esc_html__('Display page view to logout user.', 'neatly'),
  'section' => 'neatly_pageview_setting',
  'type' => 'checkbox',
));