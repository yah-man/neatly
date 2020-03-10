<?php defined( 'ABSPATH' ) || exit; ?>
<footer id="site_f" itemscope itemtype="https://schema.org/WPFooter">
	<?php
	if ( !is_page_template( 'templates/title_content_no_sidebar.php' ) && (is_active_sidebar( 'footer-1' )  || is_active_sidebar( 'footer-2' )  || is_active_sidebar( 'footer-3' ) ) ) : ?>
		<div class="f_widget_wrap">
			<div class="f_widget_inner wrap_frame f_box jc_sb f_col100">
				<div class="f_widget_L f_widget_block f_box f_col"><?php dynamic_sidebar('footer-1'); ?></div>
				<div class="f_widget_C f_widget_block f_box f_col"><?php dynamic_sidebar('footer-2'); ?></div>
				<div class="f_widget_R f_widget_block f_box f_col"><?php dynamic_sidebar('footer-3'); ?></div>
			</div>
		</div>
		<?php
	endif;


	if( has_nav_menu('secondary') ) neatly_footer_menu(); ?>
	<div class="f_credit w100 p16_0">
		<div class="wrap_frame fs12 sub_fc ta_c p16_0">
			<?php if( has_nav_menu('credit') ) neatly_credit_menu();
			$local_url = '';
			if( get_locale() !== 'ja' )$local_url = 'en/';
			?>
			<div class="f_box f_col100 jc_c ai_c">
				<div class="m4">Powered by <a href="<?php echo esc_url('https://wordpress.org/'); ?>">WordPress</a></div>
				<div class="m4">Theme by <a href="<?php echo esc_url('https://back2nature.jp/'.$local_url.'themes/neatly'); ?>">Neatly</a></div>
			</div>
			<div class="m4 p16_0">&copy;<?php echo esc_html( date('Y') ) .' <a href="'. esc_url( home_url() ).'">'.esc_html( get_bloginfo('name') , 'display' ).'</a>'; ?></div>
		</div>
	</div>
</footer>
<?php
if(is_active_sidebar( 'search_widget' )) neatly_header_search_widget();
wp_footer(); ?>
</body>
</html>
