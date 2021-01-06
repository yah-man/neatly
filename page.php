<?php defined( 'ABSPATH' ) || exit;
get_header();

?>
<div class="main_wrap wrap_frame f_box f_col110 jc_c001">
	<main id="post-<?php the_ID(); ?>" <?php post_class('main_contents post_contents page_contents br4'); ?>>
		<?php while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/single/sort_order');
			get_template_part( 'template-parts/single/order' );

			neatly_post_order( 'page' , neatly_sort_order_custom_page() , $post);

		endwhile; ?>
	</main>
	<?php
	if(NEATLY_LEFT_SIDEBAR)get_sidebar('left');
	if(NEATLY_RIGHT_SIDEBAR)get_sidebar('right');
	?>
</div>
<?php get_footer();
