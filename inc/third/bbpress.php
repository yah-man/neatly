<?php
defined( 'ABSPATH' ) || exit;

add_action( 'widgets_init', 'neatly_bbpress_widgets_init' );

if ( ! function_exists( 'neatly_bbpress_widgets_init' ) ) :
  /*ウィジェット追加*/
  function neatly_bbpress_widgets_init() {

    register_sidebar(array(
      'name' => esc_html__( 'Right sidebar for bbPress', 'neatly' ),
      'id' => 'bbpress-sidebar-1',
      'description' => sprintf(esc_html__('Widgets in this area will be displayed in %s for bbPress.', 'neatly'),esc_html__( 'right sidebar', 'neatly' ) ),
      'before_widget' => '<div id="%1$s" class="widget s_widget %2$s br4 mb_L">',
      'after_widget' => '</div>',
      'before_title' => '<div class="widget_title sw_title mb_S fsS fw_bold">',
      'after_title' => '</div>'
    ));

    register_sidebar(array(
      'name' => esc_html__( 'Left sidebar for bbPress', 'neatly' ),
      'id' => 'bbpress-sidebar-2',
      'description' => sprintf(esc_html__('Widgets in this area will be displayed in %s for bbPress.', 'neatly'),esc_html__( 'left sidebar', 'neatly' ) ),
      'before_widget' => '<div id="%1$s" class="widget s_widget %2$s br4 mb_L">',
      'after_widget' => '</div>',
      'before_title' => '<div class="widget_title sw_title mb_S fsS fw_bold">',
      'after_title' => '</div>'
    ));

    register_sidebar(array(
      'name' => esc_html__( 'Left of footer for bbPress', 'neatly' ),
      'id' => 'bbpress-footer-1',
      'description' => sprintf(esc_html__('Widgets in this area will be displayed in %s for bbPress.', 'neatly'),esc_html__( 'the first column in the footer', 'neatly' ) ),
      'before_widget' => '<div id="%1$s" class="widget f_widget %2$s br4 mb_L">',
      'after_widget' => '</div>',
      'before_title' => '<div class="widget_title fw_title mb_S fsS fw_bold">',
      'after_title' => '</div>'
    ));
    register_sidebar(array(
      'name' => esc_html__( 'Center of footer for bbPress', 'neatly' ),
      'id' => 'bbpress-footer-2',
      'description' => sprintf(esc_html__('Widgets in this area will be displayed in %s for bbPress.', 'neatly'),esc_html__( 'the second column in the footer', 'neatly' ) ),
      'before_widget' => '<div id="%1$s" class="widget f_widget %2$s br4 mb_L">',
      'after_widget' => '</div>',
      'before_title' => '<div class="widget_title fw_title mb_S fsS fw_bold">',
      'after_title' => '</div>'
    ));
    register_sidebar(array(
      'name' => esc_html__( 'Right of footer for bbPress', 'neatly' ),
      'id' => 'bbpress-footer-3',
      'description' => sprintf(esc_html__('Widgets in this area will be displayed in %s for bbPress.', 'neatly'),esc_html__( 'the third column in the footer', 'neatly' ) ),
      'before_widget' => '<div id="%1$s" class="widget f_widget %2$s br4 mb_L">',
      'after_widget' => '</div>',
      'before_title' => '<div class="widget_title fw_title mb_S fsS fw_bold">',
      'after_title' => '</div>'
    ));

  }
endif;

if ( ! function_exists( 'neatly_bbpress_sidebar' ) ) :

  function neatly_bbpress_sidebar(){

    $sidebar['right'] = false;
    $sidebar['left'] = false;

    if( is_active_sidebar( 'bbpress-sidebar-1' ) ){
      $sidebar['right'] = true;
    }

    if( is_active_sidebar( 'bbpress-sidebar-2' ) ){
      $sidebar['left'] = true;
    }

    return $sidebar;

  }

endif;

if ( ! function_exists( 'neatly_is_bbpress' ) ) :

  function neatly_is_bbpress(){

    if( bbp_is_topic() || bbp_is_forum() || bbp_is_forum_archive() || bbp_is_single_forum() || bbp_is_forum_edit() || bbp_is_single_topic() || bbp_is_topic_archive() || bbp_is_topic_edit() || bbp_is_topic_tag() || bbp_is_topic_tag_edit() || bbp_is_reply() || bbp_is_reply_edit() || bbp_is_single_reply() || bbp_is_favorites() || bbp_is_subscriptions() || bbp_is_search_results() || bbp_is_user_home() ) {


      add_action( 'wp_enqueue_scripts', 'neatly_add_bbpress_css' );

      return true;

    }else{

      add_action( 'wp_enqueue_scripts', 'neatly_remove_bbpress_css' );

      return false;

    }

  }

endif;


if ( ! function_exists( 'neatly_remove_bbpress_css' ) ) :
  function neatly_remove_bbpress_css() {
    wp_dequeue_style( 'bbp-default' );
  }
endif;

if ( ! function_exists( 'neatly_add_bbpress_css' ) ) :
  function neatly_add_bbpress_css() {
    wp_enqueue_style( 'neatly_bbpress_style', NEATLY_THEME_URI . 'assets/css/bbpress.min.css',array('neatly_style') );
  }
endif;

