<?php
defined( 'ABSPATH' ) || exit;
/**
 * Index Settings
 *
 * @package Neatly
 */




/*Neatly レイアウト設定*/
$wp_customize->add_section('neatly_index_layout',array(
  'title' => esc_html__('Layout', 'neatly'),
  'panel' => 'index_panel',
));

/*表示グリッド*/
$wp_customize->add_setting( 'neatly_index_layout_list', array(
  'default'           => 'list',
  'sanitize_callback' => 'sanitize_key',
) );
$wp_customize->add_control( new Neatly_Image_Select_Control( $wp_customize, 'neatly_index_layout_list', array(
  'label'       => esc_html__( 'Layout', 'neatly' ),
  'description' => __( 'Choose a layout for the blog posts.', 'neatly' ),
  'section'     => 'neatly_index_layout',
  'choices'     => array(
    'list' => array(
      'label' => esc_html__( 'List layout', 'neatly' ),
      'url'   => '%slayout_list.png'
    ),
    'grid'    => array(
      'label' => esc_html__( 'Grid layout', 'neatly' ),
      'url'   => '%slayout_grid.png'
    ),
    'lg'    => array(
      'label' => esc_html__( 'List layout before grid layout', 'neatly' ),
      'url'   => '%slayout_list_grid.png'
    ),
    'lgl'    => array(
      'label' => esc_html__( 'List layout and grid layout are alternately repeated', 'neatly' ),
      'url'   => '%slayout_lgl.png'
    ),
  ),
)));







/*Neatly サムネイルのサイズ*/
$wp_customize->add_section('index_thumbnail_sections',array(
	'title' => esc_html__('Thumbnail','neatly'),
	'panel' => 'index_panel',
));

$wp_customize->add_setting( 'neatly_index_thum_size', array(
  'default'           => 'large',
  'sanitize_callback' => 'neatly_sanitize_radio',
));
$wp_customize->add_control( 'neatly_index_thum_size', array(
  'label'    => esc_html__( 'Original size of thumbnail', 'neatly' ),
  'section'  => 'index_thumbnail_sections',
  'type'     => 'select',
  'choices'  => array(
    'thumbnail' => esc_html__( 'Thumbnail', 'neatly' ),
    'medium' => esc_html__( 'Medium', 'neatly' ),
    'large' => esc_html__( 'Large', 'neatly' ),
    'full' => esc_html__( 'Full', 'neatly' ),
  ),
));

/*Neatly INDEXのウェイジェット*/
$wp_customize->add_section('index_widget_sections',array(
	'title' => esc_html__('Widget','neatly'),
	'panel' => 'index_panel',
));

$wp_customize->add_setting( 'neatly_index_widget', array(
	'default'           => 'after',
	'sanitize_callback' => 'neatly_sanitize_radio',
));
$wp_customize->add_control( 'neatly_index_widget', array(
	'label'    => esc_html__( 'How to Insert Index list widget area', 'neatly' ),
	'section'  => 'index_widget_sections',
	'type'     => 'radio',
	'choices'  => array(
		'after' => esc_html__( 'Just after post', 'neatly' ),
		'every' => esc_html__( 'Every post', 'neatly' ),
	),
));

$wp_customize->add_setting( 'neatly_index_widget_num', array(
	'default' => 3,
	'sanitize_callback' => 'absint',
));
$wp_customize->add_control( 'neatly_index_widget_num', array(
	'label' => esc_html__( 'Count of post for above configuring', 'neatly' ),
    'section' => 'index_widget_sections', // Add a default or your own section
    'type' => 'number',
    'input_attrs' => array(
    	'min' => 1, 'step' => 1, 'max' => 10,
    ),
));



/*Neatly 投稿者*/
$wp_customize->add_section('index_author_sections',array(
  'title' => esc_html__('Author','neatly'),
  'panel' => 'index_panel',
));

$wp_customize->add_setting( 'neatly_index_avatar', array(
  'default'           => true,
  'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control( 'neatly_index_avatar', array(
  'label'    => esc_html__( 'Avatar', 'neatly' ),
  'section'  => 'index_author_sections',
  'type' => 'checkbox',
));

$wp_customize->add_setting( 'neatly_index_author_name', array(
  'default'           => true,
  'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control( 'neatly_index_author_name', array(
  'label'    => esc_html__( 'Name', 'neatly' ),
  'section'  => 'index_author_sections',
  'type' => 'checkbox',
));

/*Neatly サムネイルのサイズ*/
$wp_customize->add_section('index_date_sections',array(
  'title' => esc_html__('Date','neatly'),
  'panel' => 'index_panel',
));

$wp_customize->add_setting( 'neatly_index_date_type', array(
  'default'           => 'human',
  'sanitize_callback' => 'neatly_sanitize_radio',
));
$wp_customize->add_control( 'neatly_index_date_type', array(
  'label'    => esc_html__( 'Display method', 'neatly' ),
  'section'  => 'index_date_sections',
  'type'     => 'select',
  'choices'  => array(
    'human' => esc_html__( 'Human readable time difference', 'neatly' ),
    'normal' => esc_html__( 'Normal display', 'neatly' ),
    'none' => esc_html__( 'None', 'neatly' ),
  ),
));