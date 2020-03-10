<?php
/**
 * Template Name: With sidebar
 * Template Post Type: post,page
 *
 * @package Neatly
 *
 */
__( 'With sidebar', 'neatly' );
get_header();
?>
<div class="main_wrap wrap_frame f_box f_col110 jc_c001">
	<main id="post-<?php the_ID(); ?>" <?php post_class('main_contents post_contents br4'); ?>>
		<?php while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/single/sort_order');
			get_template_part( 'template-parts/single/order' );
			$p_type = 'page';
			if(is_single()) $p_type = 'post';
			$function_name = 'neatly_sort_order_custom_'.$p_type;
			neatly_post_order( $p_type , $function_name() , $post);

		endwhile; ?>
	</main>
	<?php get_sidebar(); ?>
</div>
<?php get_footer();

