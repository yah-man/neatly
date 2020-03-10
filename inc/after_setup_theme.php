<?php
defined( 'ABSPATH' ) || exit;


load_theme_textdomain( 'neatly', NEATLY_THEME_DIR . 'languages' );

add_theme_support( 'post-thumbnails' );/*サムネイル有効化*/
add_theme_support( 'title-tag' );/*自動的にhead内にタイトル挿入*/
add_theme_support( 'automatic-feed-links' );/*RSSフィード有効*/

//add_theme_support( 'dark-editor-style' );
add_theme_support( 'editor-styles' );
add_editor_style( array( 'assets/css/editor.min.css' ) );

add_theme_support( 'responsive-embeds' );/*埋め込みコンテンツのレスポンシブ対応*/

add_theme_support( 'post-formats', array( 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video', 'audio' ) );

/*gutenberg*/
add_theme_support( 'wp-block-styles' );
add_theme_support( 'align-wide' );



/*Switch default core output valid HTML5.*/
add_theme_support( 'html5', array(
	'search-form',
	'comment-form',
	'comment-list',
	'gallery',
	'caption',
	'script',
	'style',
) );


add_theme_support( 'custom-background', array(/*カスタム背景有効化*/
	'default-color'          => '',
	'default-image'          => '',
	'default-repeat'         => 'repeat',
	'default-position-x'     => 'left',
	'default-position-y'     => 'top',
	'default-size'           => 'auto',
	'default-attachment'     => 'scroll',
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
));



add_theme_support( 'custom-logo', array(
	'height'      => 80,
	'width'       => 320,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => false,
	//'header-text' => array( 'site-title', 'site-description' ),
));

/*----カスタマイザー-----*/
   // Indicate widget sidebars can use selective refresh in the Customizer.(WP4.7)
add_theme_support( 'customize-selective-refresh-widgets' );

