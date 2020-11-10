<?php
defined( 'ABSPATH' ) || exit;
/**
 * Extra content
 *
 * @package Neatly
 */



add_action( 'admin_notices', 'neatly_yahman_addons_notice' );
function neatly_yahman_addons_notice() {
	if (  ! current_user_can( 'manage_options' ) || ! current_user_can( 'install_plugins' ) ) return;






	$meta = get_user_meta( get_current_user_id(), 'neatly_yahman_addons_notice_dismiss', true );
	if ( $meta ) {
		return;
	}
	$setting['name'] = esc_html__('YAHMAN Add-ons', 'neatly');
	$setting['dir'] = 'yahman-add-ons';
	$setting['filename'] = 'yahman-add-ons.php';
	require_once NEATLY_THEME_DIR . 'inc/tgm/plugin_button.php';
	$button = neatly_plugin_button($setting);
	if($button == 'activated' ) return;
	?>
	<div id="" class="updated neatly_plugin_wrap" style="position:relative;">
		<h3 class="neatly_notice_title"><?php esc_html_e('Welcome! Thank you for choosing the theme Neatly.' , 'neatly'); ?></h3>
		<p class="neatly_notice_description">
			<?php echo sprintf( esc_html__( 'If you want to take full advantage of the options this theme has to offer, please install and activate %s.', 'neatly' ), sprintf( '<strong>%s</strong>', 'YAHMAN Add-ons' ) ); ?>
		</p>
		<p class="neatly_notice_description">
			<?php echo esc_html__( 'This plugin optimize for Neatly.', 'neatly' ); ?>
		</p>
		<p class="neatly_notice_description">
			<?php echo esc_html__( 'Pageviews,Google Adsense,Analytics,Social,Profile,Table of contents,Related Posts,sitemap,SEO,JSON-LD structured data,Open Graph protocol(OGP),Blog card,Twitter timeline,Facebook timeline,Accelerated Mobile Pages(AMP), etc.', 'neatly' ); ?>
		</p>
		<p class="neatly_notice_description">
			<?php echo esc_html__( 'Of course, it\'s free.', 'neatly' ); ?>
		</p>


		<?php

		echo $button;
		?>
		<a href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'neatly-yahman_addons-notice_dismiss', 'notice_nonce' ), 'neatly-notice_dismiss-' . get_current_user_id() ) ); ?>" class="notice-dismiss" style="text-decoration:none;"><span class="screen-reader-text">Skip</span></a>
	</div>

	<?php
}



function neatly_yahman_addons_notice_dismiss() {
	if ( isset( $_GET['neatly-yahman_addons-notice_dismiss'] ) && check_admin_referer( 'neatly-notice_dismiss-' . get_current_user_id() ) ) {
		update_user_meta( get_current_user_id(), 'neatly_yahman_addons_notice_dismiss', true );
	}
}
add_action( 'wp_loaded', 'neatly_yahman_addons_notice_dismiss' );
