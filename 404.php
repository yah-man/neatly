<?php defined( 'ABSPATH' ) || exit;
get_header();

?>
<div class="main_wrap wrap_frame f_box f_col110 jc_c001">
	<main id="404page" <?php post_class('main_contents post_contents br4'); ?>>
		<h1 class="ta_c mb_M">404</h1>
		<h2 class="ta_c"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'neatly' ); ?></h2>
	</main>
	<?php //if(NEATLY_RIGHT_SIDEBAR)get_sidebar(); ?>
</div>
<?php get_footer();
