<?php defined( 'ABSPATH' ) || exit;
/**
 * Template Name: Custom Homepage
 * Template Post Type: page
 *
 * @package Neatly
 *
 */
__( 'Custom Homepage', 'neatly' );
get_header();
?>
<div class="main_wrap hp_wrap wrap_frame f_box f_col110 jc_c001">
	<main id="post-<?php the_ID(); ?>" <?php post_class('main_contents post_contents page_contents hp_contents br4'); ?>>
		<?php

		dynamic_sidebar( 'custom_homepage' );
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;

		?>
	</main>
	<?php
	if(NEATLY_LEFT_SIDEBAR)get_sidebar('left');
	if(NEATLY_RIGHT_SIDEBAR)get_sidebar('right');
	?>
</div>
<?php get_footer();
