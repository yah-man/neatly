<?php
defined( 'ABSPATH' ) || exit;
/**
 *
 * @package Neatly
 */
/*sort order*/

if ( ! function_exists( 'neatly_sort_order_base_post' ) ) :
  function neatly_sort_order_base_post() {
    if(function_exists('yahman_addons_plugins_loaded')){
      return array(
       'thumbnail','title','author','pv','content','page_link','widget_1','cta','share','author_profile','related','category','tag','adjacent','comment','widget_2','widget_3','widget_4','widget_5','breadcrumbs',
     );
    }else{
      return array(
       'thumbnail','title','author','content','page_link','widget_1','author_profile','category','tag','adjacent','comment','widget_2','widget_3','widget_4','widget_5','breadcrumbs',
     );
    }

  }
endif;

if ( ! function_exists( 'neatly_sort_order_base_page' ) ) :
  function neatly_sort_order_base_page() {

    if(function_exists('yahman_addons_plugins_loaded')){
      return array(
       'thumbnail','title','author','pv','content','page_link','widget_1','cta','share','author_profile','related','category','tag','comment','widget_2','widget_3','widget_4','widget_5','breadcrumbs',
     );
    }else{
      return array(
       'thumbnail','title','author','content','page_link','widget_1','author_profile','category','tag','comment','widget_2','widget_3','widget_4','widget_5','breadcrumbs',
     );
    }

  }
endif;

if ( ! function_exists( 'neatly_sort_order_diff_post' ) ) :

  function neatly_sort_order_diff_post() {

    return array_diff( neatly_sort_order_base_post() , get_theme_mod( 'neatly_posts_sortable', neatly_sort_order_base_post() ) );

  }

endif;

if ( ! function_exists( 'neatly_sort_order_diff_page' ) ) :

  function neatly_sort_order_diff_page() {

    return array_diff( neatly_sort_order_base_page() , get_theme_mod( 'neatly_pages_sortable' , neatly_sort_order_default_base_page() ) );

  }

endif;


if ( ! function_exists( 'neatly_sort_order_custom_post' ) ) :

  function neatly_sort_order_custom_post() {

   return array_diff( get_theme_mod( 'neatly_posts_sortable', neatly_sort_order_base_post() ) , neatly_sort_order_diff_post() );

  }

endif;

if ( ! function_exists( 'neatly_sort_order_custom_page' ) ) :

  function neatly_sort_order_custom_page() {

   return array_diff( get_theme_mod( 'neatly_pages_sortable' , neatly_sort_order_default_base_page() ) , neatly_sort_order_diff_page() );

  }

endif;

if ( ! function_exists( 'neatly_sort_order_default_base_page' ) ) :
  function neatly_sort_order_default_base_page() {

    $base = array();

    foreach ( neatly_sort_order_base_page() as $key => $value ){
      if($value !== 'author' && $value !== 'date' && $value !== 'author_profile' && $value !== 'comment'){
        $base[$key] = $value;
      }
    }

    return $base;

  }
endif;
