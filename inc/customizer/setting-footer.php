<?php
defined( 'ABSPATH' ) || exit;
/**
 * Footer Settings
 *
 * @package Neatly
 */


/*Laid Back 投稿ページ セクション並び替え*/
$wp_customize->add_section('footer_copyright_sections',array(
	'title' => esc_html__('Copyright','neatly'),
	'panel' => 'footer_panel',
));

$copyright_year = 1994;
$copyright_year_list = array();
while($copyright_year <= date('Y')){
  $copyright_year_list[$copyright_year] = (string) $copyright_year;
  ++$copyright_year;
}

$wp_customize->add_setting( 'neatly_footer_copyright_year',array(
  'default'    => date('Y'),
  'sanitize_callback' => 'wp_kses_post',
));
$wp_customize->add_control( 'neatly_footer_copyright_year',array(
  'label'   => esc_html__( 'Year of Publication', 'neatly'),
  'section' => 'footer_copyright_sections',
  'type' => 'select',
  'choices' => $copyright_year_list,
));








