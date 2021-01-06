<?php
defined( 'ABSPATH' ) || exit;

define( 'NEATLY_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'NEATLY_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );
define( 'NEATLY_VERSION', wp_get_theme(get_template())->Version );

// Handle SVG icons.
require_once NEATLY_THEME_DIR . '/inc/svg-icons.php';

require_once NEATLY_THEME_DIR . 'inc/widgets.php' ;

require_once NEATLY_THEME_DIR . 'inc/template-tags.php' ;


if ( ! function_exists( 'neatly_after_setup_theme' ) ) :
	function neatly_after_setup_theme() {
		/*----SETUP-----*/
		require_once NEATLY_THEME_DIR . 'inc/after_setup_theme.php' ;

	}
endif;
add_action( 'after_setup_theme', 'neatly_after_setup_theme' );


if ( ! function_exists( 'neatly_content_width' ) ) :
	function neatly_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'neatly_content_width', 730 );
	}
endif;
add_action( 'template_redirect', 'neatly_content_width', 0 );


/**
 * Register navigation menus uses wp_nav_menu in three places.
 */
if ( ! function_exists( 'neatly_menus' ) ) :
	function neatly_menus() {
		/*メニュー*/
		register_nav_menus( array(
			'primary'   => __( 'Header Menu', 'neatly' ),
			'secondary' => __( 'Footer Menu', 'neatly' ),
			'credit'  => __( 'Credit Menu', 'neatly' ),
		) );
	}
endif;
add_action( 'init', 'neatly_menus' );


add_action( 'wp', 'neatly_decision_sidebar');
/*parse_queryではカスタマイザーで反映されない*/
/*wpが最速か*/
if ( ! function_exists( 'neatly_decision_sidebar' ) ) :
	/*サイドバーの設定*/
	function neatly_decision_sidebar() {

		if ( defined('NEATLY_RIGHT_SIDEBAR') ) return;
		/*サイドバーの設定*/

		/*----サイドバー設定-----*/
		$sidebar['right'] = false;
		$sidebar['left'] = false;

		$sidebar_display = get_theme_mod( 'neatly_sidebar_display','all');

		if( $sidebar_display === 'none') return neatly_define_sidebar($sidebar);

		/*ウィジェット判定*/
		if( ( is_active_sidebar( 'sidebar-1' ) || is_active_sidebar( 'sidebar-fixed' ) ) ){

			$sidebar['right'] = true;

		}

		if( ( is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-fixed-2' ) ) ){

			$sidebar['left'] = true;

		}

		if( is_singular() ){

			/*スマホ・タブレットからのアクセス*/
			if(wp_is_mobile()){

				if( get_theme_mod( 'neatly_sidebar_single_mobile_display',false) ){
					$sidebar['right'] = false;
					$sidebar['left'] = false;
				}

			}

			if( $sidebar_display === 'index' ){
				$sidebar['right'] = false;
				$sidebar['left'] = false;
			}

		}




		/*bbPress*/
		if ( function_exists( 'neatly_bbpress_sidebar' ) && neatly_is_bbpress() )
			$sidebar = neatly_bbpress_sidebar();


		if (is_page_template('templates/with_sidebar.php') ){
			$sidebar['right'] = true;
			$sidebar['left'] = true;
		}


		if(is_page_template('templates/title_content_no_sidebar.php') || is_page_template('templates/without_sidebar.php') ){
			$sidebar['right'] = false;
			$sidebar['left'] = false;
		}



		neatly_define_sidebar($sidebar);

	}
endif;

function neatly_define_sidebar($sidebar) {
	define( 'NEATLY_RIGHT_SIDEBAR', $sidebar['right'] );
	define( 'NEATLY_LEFT_SIDEBAR', $sidebar['left'] );
}

if ( ! function_exists( 'neatly_scripts_styles' ) ) :
	function neatly_scripts_styles() {

		//wp_enqueue_style( 'dashicons' );
		wp_enqueue_style( 'neatly_style', NEATLY_THEME_URI . 'assets/css/style.min.css',array() );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			 // Load comment-reply.js (into footer)
			wp_enqueue_script( 'comment-reply', '/wp-includes/js/comment-reply.min.js', array(), false, true );
		}

	}
endif;
add_action( 'wp_enqueue_scripts', 'neatly_scripts_styles' );


if ( ! function_exists( 'neatly_block_front_styles' ) ) :
	function neatly_block_front_styles(){
		if ( function_exists( 'has_block' ) ){
			if( has_blocks() ){

				if ( !defined("NEATLY_RIGHT_SIDEBAR") ) define( 'NEATLY_RIGHT_SIDEBAR', false );

				wp_enqueue_style( 'neatly_block', NEATLY_THEME_URI . 'assets/css/block.min.css',array('neatly_style') );

				if(!NEATLY_RIGHT_SIDEBAR || is_page_template( 'templates/title_content_no_sidebar.php' )){
					wp_enqueue_style( 'neatly_block_one_column', NEATLY_THEME_URI . 'assets/css/block_one_column.min.css',array( 'neatly_block' ) );
				}

				//if (  has_block( 'core-embed/vimeo' ) || has_block( 'core-embed/youtube') || has_block( 'video' ) ) {
				/*FITVIDS.JS*/
					//wp_enqueue_script( 'fitvids',NEATLY_THEME_URI . 'assets/js/block/jquery.fitvids.min.js', array('jquery'), null, true);
					//wp_add_inline_script( 'fitvids',  'jQuery(document).ready(function(){jQuery(".wp-block-embed-vimeo").fitVids();});');
				//}

				return;

			}
		}
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
	}
endif;
add_action( 'enqueue_block_assets', 'neatly_block_front_styles' );


if ( ! function_exists( 'neatly_footer_scripts_styles' ) ) :
	function neatly_footer_scripts_styles() {

		wp_enqueue_style( 'neatly_fontawesome', NEATLY_THEME_URI . 'assets/font/fontawesome/style.min.css',array() );

		wp_enqueue_style( 'neatly_keyframes', NEATLY_THEME_URI . 'assets/css/keyframes.min.css',array() );

		wp_enqueue_style( 'neatly_printer', NEATLY_THEME_URI . 'assets/css/printer.min.css',array() );

	};
endif;
add_action( 'wp_footer', 'neatly_footer_scripts_styles' );



if ( is_admin() ){

    // Displays plugin notices on admin backend
	require_once NEATLY_THEME_DIR . 'inc/tgm/notice.php';

	require_once NEATLY_THEME_DIR . 'inc/tgm/tgm.php';

	add_action('enqueue_block_editor_assets', function(){
		wp_enqueue_style( 'neatly_admin_block', NEATLY_THEME_URI . 'assets/css/admin_block.min.css' );
		wp_enqueue_style( 'neatly_block', NEATLY_THEME_URI . 'assets/css/block.min.css',array('neatly_admin_block') );
		wp_enqueue_style( 'neatly_block_one_column', NEATLY_THEME_URI . 'assets/css/block_one_column.min.css',array( 'neatly_block' ) );
	});

}else{

	require_once NEATLY_THEME_DIR . 'inc/content-replace.php' ;

}

if( is_customize_preview() )
    // Setup the Theme Customizer settings and controls...
	require_once NEATLY_THEME_DIR . 'inc/customizer/customizer.php';

/* bbPress installed */
if ( class_exists( 'bbPress' ) ) {
	require_once NEATLY_THEME_DIR . 'inc/third/bbpress.php';
}

