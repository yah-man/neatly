<?php
defined( 'ABSPATH' ) || exit;


add_action( 'customize_register' , array( 'NEATLY_CUSTOMIZER' , 'register' ) );

class NEATLY_CUSTOMIZER {

	public static function register ( $wp_customize ) {

		$wp_customize->register_control_type( 'Neatly_Image_Select_Control' );

		/*オーダーリスト*/
		require_once NEATLY_THEME_DIR . 'template-parts/single/sort_order.php';
		/*サニタイズ*/
		require_once NEATLY_THEME_DIR . 'inc/customizer/sanitize.php';

		/*Neatly ヘッダーアイコン*/
		$wp_customize->add_setting( 'neatly_header_icon',array(
			'default'    => '',
			'sanitize_callback' => 'neatly_sanitize_image_file',
		));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'neatly_header_icon', array(
			'label' => esc_html__( 'Icon Image', 'neatly'),
			'section' => 'title_tagline',
		)));


		/*Neatly 投稿パネル*/
		$wp_customize->add_panel( 'posts_panel', array(
			//'priority'    => 1,
			'title'       => esc_html__('Posts', 'neatly'),
		));
		require_once NEATLY_THEME_DIR . 'inc/customizer/setting-posts.php';

		/*Neatly 固定ページパネル*/
		$wp_customize->add_panel( 'pages_panel', array(
			//'priority'    => 1,
			'title'       => esc_html__('Pages', 'neatly'),
		));
		require_once NEATLY_THEME_DIR . 'inc/customizer/setting-pages.php';

		/*Neatly サイドバーパネル*/
		$wp_customize->add_panel( 'sidebar_panel', array(
			'title'       => esc_html__('Sidebar', 'neatly'),
		));
		require_once NEATLY_THEME_DIR . 'inc/customizer/setting-sidebar.php';

		/*Neatly ヘッダーパネル*/
		$wp_customize->add_panel( 'header_panel', array(
			'title'       => esc_html__('Header', 'neatly'),
		));
		require_once NEATLY_THEME_DIR . 'inc/customizer/setting-header.php';

		/*Neatly フッターパネル*/
		$wp_customize->add_panel( 'footer_panel', array(
			'title'       => esc_html__('Footer', 'neatly'),
		));
		require_once NEATLY_THEME_DIR . 'inc/customizer/setting-footer.php';

		/*Neatly インデックスパネル*/
		$wp_customize->add_panel( 'index_panel', array(
			'title'       => esc_html__('Index', 'neatly'),
		));
		require_once NEATLY_THEME_DIR . 'inc/customizer/setting-index.php';

		/*YAHMAN Add-ons インデックスパネル*/
		$wp_customize->add_panel( 'yahman_addon_panel', array(
			'title'       => esc_html__('YAHMAN Add-ons', 'neatly'),
		));
		require_once NEATLY_THEME_DIR . 'inc/customizer/setting-yahman_addon.php';



	}
}//end of NEATLY_CUSTOMIZER


if ( class_exists( 'WP_Customize_Control' ) ) {

	require_once NEATLY_THEME_DIR . 'inc/customizer/control-sortable.php';

	require_once NEATLY_THEME_DIR . 'inc/customizer/control-image_select.php';

}


if ( ! function_exists( 'neatly_customizer_scripts_styles' ) ) :
	function neatly_customizer_scripts_styles() {
		wp_enqueue_style( 'neatly_customizer_css', NEATLY_THEME_URI . 'assets/css/customizer.min.css', array(), null );
	}
endif;
add_action('customize_controls_print_styles', 'neatly_customizer_scripts_styles');
