<?php defined( 'ABSPATH' ) || exit;
get_header(); ?>
<div class="main_wrap wrap_frame f_box f_col110 jc_c001">
	<main class="main_contents index_contents br4 f_box011 f_wrap011 <?php echo esc_attr( get_theme_mod( 'neatly_index_layout_list','list') ); ?>">
		<?php
		if(have_posts()):

			get_template_part( 'template-parts/index/content' );

		else:

			get_template_part( 'template-parts/index/content', 'none' );

		endif;

		/*pagination*/
		neatly_the_posts_pagination();
		?>
	</main>
	<?php if(NEATLY_SIDEBAR)get_sidebar(); ?>
</div>
<?php get_footer();
