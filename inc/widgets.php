<?php
defined( 'ABSPATH' ) || exit;

add_action( 'widgets_init', 'neatly_widgets_init' );

if ( ! function_exists( 'neatly_widgets_init' ) ) :
  /*ウィジェット追加*/
  function neatly_widgets_init() {

    register_sidebar(array(
      'name' => esc_html__( 'Sidebar', 'neatly' ),
      'id' => 'sidebar-1',
      'description' => sprintf(esc_html__('Widgets in this area will be displayed in %s.', 'neatly'),esc_html__( 'right sidebar', 'neatly' ) ),
      'before_widget' => '<div id="%1$s" class="widget s_widget %2$s br4 mb_L">',
      'after_widget' => '</div>',
      'before_title' => '<div class="widget_title sw_title mb_S fsS fw_bold">',
      'after_title' => '</div>'
    ));

    register_sidebar(array(
      'name' => esc_html__( 'Left of footer', 'neatly' ),
      'id' => 'footer-1',
      'description' => sprintf(esc_html__('Widgets in this area will be displayed in %s.', 'neatly'),esc_html__( 'the first column in the footer', 'neatly' ) ),
      'before_widget' => '<div id="%1$s" class="widget f_widget %2$s br4 mb_L">',
      'after_widget' => '</div>',
      'before_title' => '<div class="widget_title fw_title mb_S fsS fw_bold">',
      'after_title' => '</div>'
    ));
    register_sidebar(array(
      'name' => esc_html__( 'Center of footer', 'neatly' ),
      'id' => 'footer-2',
      'description' => sprintf(esc_html__('Widgets in this area will be displayed in %s.', 'neatly'),esc_html__( 'the second column in the footer', 'neatly' ) ),
      'before_widget' => '<div id="%1$s" class="widget f_widget %2$s br4 mb_L">',
      'after_widget' => '</div>',
      'before_title' => '<div class="widget_title fw_title mb_S fsS fw_bold">',
      'after_title' => '</div>'
    ));
    register_sidebar(array(
      'name' => esc_html__( 'Right of footer', 'neatly' ),
      'id' => 'footer-3',
      'description' => sprintf(esc_html__('Widgets in this area will be displayed in %s.', 'neatly'),esc_html__( 'the third column in the footer', 'neatly' ) ),
      'before_widget' => '<div id="%1$s" class="widget f_widget %2$s br4 mb_L">',
      'after_widget' => '</div>',
      'before_title' => '<div class="widget_title fw_title mb_S fsS fw_bold">',
      'after_title' => '</div>'
    ));

    register_sidebar(array(
      'name' => esc_html__( 'Header', 'neatly' ),
      'id' => 'header_widget',
      'description' => sprintf(esc_html__('Widgets in this area will be displayed in %s.', 'neatly'),esc_html__( 'header', 'neatly' ) ),
      'before_widget' => '<div id="%1$s" class="widget h_widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<div class="widget_title hw_title mb_S fsS fw_bold">',
      'after_title' => '</div>'
    ));


    register_sidebar(array(
      'name' => esc_html__( 'Fixed Sidebar for Laptop', 'neatly' ),
      'id' => 'sidebar-fixed',
      'description' => sprintf(esc_html__('Widgets in this area will be displayed in %s.', 'neatly'),esc_html__( 'right sidebar and fix in bottom', 'neatly' ) ),
      'before_widget' => '<div id="%1$s" class="widget s_widget %2$s br4 mb_L">',
      'after_widget' => '</div>',
      'before_title' => '<div class="widget_title sw_title mb_S fsS fw_bold">',
      'after_title' => '</div>'
    ));

    register_sidebar(array(
      'name' => esc_html__( 'Search', 'neatly' ),
      'id' => 'search_widget',
      'description' => sprintf(esc_html__('Widgets in this area will be displayed in %s.', 'neatly'),esc_html__( 'header', 'neatly' ) ),
      'before_widget' => '<div id="%1$s" class="widget search_widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<div class="widget_title search_widget_title mb_S fsS fw_bold">',
      'after_title' => '</div>'
    ));

    register_sidebar(array(
      'name' => esc_attr__( 'Custom Homepage', 'neatly' ),
      'id' => 'custom_homepage',
      'description' => sprintf(esc_html__('Widgets in this area will be displayed in %s.', 'neatly'),esc_html__( 'Homepage', 'neatly' ) ),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<div class="widget_title ch_title mb_S fsS fw_bold">',
      'after_title' => '</div>'
    ));

    $setting_url = esc_url(admin_url('customize.php?autofocus[section]=index_widget_sections'));

    register_sidebar(array(
      'name' => esc_html__( 'Index List', 'neatly' ),
      'id' => 'index_list',
      'description' => sprintf(esc_html__('Widgets in this area will be displayed in %s.', 'neatly'),esc_html__( 'index list', 'neatly' ) ).' <a href="'.$setting_url.'">'.esc_html__( 'change the number of insert widget area.', 'neatly' ).'</a>',
      'before_widget' => '<div id="%1$s" class="widget %2$s i_widget">',
      'after_widget' => '</div>',
      'before_title' => '<div class="widget_title mb_S fsS">',
      'after_title' => '</div>'
    ));

    $i = 1;
    while($i<6){
      register_sidebar(array(
        'name' => esc_html__( 'Post widget', 'neatly' ).' '.$i,
        'id' => 'post_widget_'.$i,
        'description' => sprintf(esc_html__('Widgets in this area will be displayed in %s.', 'neatly'),esc_html__( 'contents of the post', 'neatly' ) ),
        'before_widget' => '<div id="%1$s" class="widget %2$s post_widget mb_L">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widget_title">',
        'after_title' => '</div>'
      ));
      ++$i;
    }


    $i = 1;
    while($i<6){
      register_sidebar(array(
        'name' => esc_html__( 'Page widget', 'neatly' ).' '.$i,
        'id' => 'page_widget_'.$i,
        'description' => sprintf(esc_html__('Widgets in this area will be displayed in %s.', 'neatly'),esc_html__( 'contents of the page', 'neatly' ) ),
        'before_widget' => '<div id="%1$s" class="widget %2$s post_widget mb_L">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widget_title">',
        'after_title' => '</div>'
      ));
      ++$i;
    }


  }
endif;

