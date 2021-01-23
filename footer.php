<?php defined( 'ABSPATH' ) || exit; ?>
<footer id="site_f" itemscope itemtype="https://schema.org/WPFooter">
	<?php
	neatly_show_footer_widget();


	if( has_nav_menu('secondary') ) neatly_footer_menu(); ?>
	<div class="f_credit w100 p16_0">
		<div class="wrap_frame fs12 sub_fc ta_c p16_0">
			<?php if( has_nav_menu('credit') ) neatly_credit_menu(); ?>
			<div class="f_box f_col100 jc_c ai_c">
				<div class="m4">Powered by <a href="<?php echo esc_attr__( 'https://wordpress.org/', 'neatly' ); ?>">WordPress</a></div>
				<div class="m4">Theme by <a href="<?php echo esc_attr__( 'https://dev.back2nature.jp/en/neatly/', 'neatly' ); ?>">Neatly</a></div>
			</div>
			<div class="m4 p16_0">&copy;<?php echo esc_html( get_theme_mod( 'neatly_footer_copyright_year', date('Y') ) ) .' <a href="'. esc_url( home_url() ).'">'.esc_html( get_bloginfo('name') , 'display' ).'</a>'; ?></div>
		</div>
	</div>
</footer>
<?php
if(is_active_sidebar( 'search_widget' )) neatly_header_search_widget();
wp_footer(); ?>
</body>
</html>
