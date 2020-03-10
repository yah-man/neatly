<?php
defined( 'ABSPATH' ) || exit;
/**
 * Pages Settings
 *
 * @package Neatly
 */


/*Neatly 投稿ページ セクション並び替え*/
$wp_customize->add_section('pages_reorder_sections',array(
  'title' => esc_html__('Reorder Sections & Show / Hide','neatly'),
  'panel' => 'pages_panel',
));

/*表示ボックス並び替え*/
$wp_customize->add_setting( 'neatly_pages_sortable',
 array(
  'default'   => neatly_sort_order_default_base_page(),
  'sanitize_callback' => 'neatly_array_sanitize',
)
);
$wp_customize->add_control( new Neatly_Posts_Sortable_Custom_Control( $wp_customize, 'neatly_pages_sortable',
 array(
  'type' => 'posts_sortable',
  'label' => esc_html__( 'Reorder Sections & Show / Hide', 'neatly' ),
  'description' => esc_html__( 'drag the columns to rearrange their order.', 'neatly' ).esc_html__( 'Switch to show or hide when eye icon click or tap.', 'neatly' ),
  'section' => 'pages_reorder_sections',
  'choices'  => neatly_sort_order_custom_page(),
)
) );

/*Neatly サムネイルのサイズ*/
$wp_customize->add_section('page_thumbnail_sections',array(
  'title' => esc_html__('Thumbnail','neatly'),
  'panel' => 'pages_panel',
));
$wp_customize->add_setting( 'neatly_page_thum_size', array(
  'default'           => 'large',
  'sanitize_callback' => 'neatly_sanitize_radio',
));
$wp_customize->add_control( 'neatly_page_thum_size', array(
  'label'    => esc_html__( 'Original size of thumbnail', 'neatly' ),
  'section'  => 'page_thumbnail_sections',
  'type'     => 'select',
  'choices'  => array(
    'thumbnail' => esc_html__( 'Thumbnail', 'neatly' ),
    'medium' => esc_html__( 'Medium', 'neatly' ),
    'large' => esc_html__( 'Large', 'neatly' ),
    'full' => esc_html__( 'Full', 'neatly' ),
  ),
));

$wp_customize->add_section('neatly_page_date',array(
  'title' => esc_html__('Date','neatly'),
  'panel' => 'pages_panel',
));

$wp_customize->add_setting( 'neatly_page_date_display', array(
  'default'           => 'none',
  'sanitize_callback' => 'neatly_sanitize_radio',
));
$wp_customize->add_control( 'neatly_page_date_display', array(
  'label'    => esc_html__( 'Date display', 'neatly' ),
  'section'  => 'neatly_page_date',
  'type'     => 'radio',
  'choices'  => array(
    'none' => esc_html__( 'Hidden', 'neatly' ),
    'publish' => esc_html__( 'Publish', 'neatly' ),
    'update' => esc_html__( 'Update', 'neatly' ),
    'both' => esc_html__( 'Publish & Update', 'neatly' ),
  ),
));


$wp_customize->add_section('neatly_page_author',array(
  'title' => esc_html__('Author','neatly'),
  'panel' => 'pages_panel',
));

$wp_customize->add_setting( 'neatly_page_author_avatar',array(
  'default'    => false,
  'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control( 'neatly_page_author_avatar',array(
  'label'   => esc_html__( 'Avatar', 'neatly'),
  'section' => 'neatly_page_author',
  'type' => 'checkbox',
));

$wp_customize->add_setting( 'neatly_page_author_name',array(
  'default'    => false,
  'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control( 'neatly_page_author_name',array(
  'label'   => esc_html__( 'Name', 'neatly'),
  'section' => 'neatly_page_author',
  'type' => 'checkbox',
));

$wp_customize->add_section('neatly_page_widget_fit_sections',array(
  'title' => esc_html__('Fit content','neatly'),
  'panel' => 'pages_panel',
));

$i = 1;
while($i<6){
  $wp_customize->add_setting( 'neatly_widget_fit_page_widget_'.$i, array(
    'default'           => true,
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control( 'neatly_widget_fit_page_widget_'.$i,array(
    'label'   => esc_html__( 'Page widget', 'neatly' ).' '.$i,
    'section' => 'neatly_page_widget_fit_sections',
    'type' => 'checkbox',
  ));
  ++$i;
}
