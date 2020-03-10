<?php
/**
 * Template Name: Title and content only without sidebar
 * Template Post Type: post,page
 *
 * @package Neatly
 *
 */
__( 'Title and content only without sidebar', 'neatly' );
get_header();
?>
<div class="main_wrap wrap_frame f_box f_col110 jc_c001">
	<main id="post-<?php the_ID(); ?>" <?php post_class('main_contents post_contents'); ?>>
		<?php while ( have_posts() ) : the_post();

			echo '<h1 class="post_title fs24 fw_bold lh15">'. get_the_title().'</h1>';

			echo '<article id="post_body" class="post_body clearfix post_item mb_L" itemprop="articleBody">';
			the_content();
			echo '</article>';

		endwhile; ?>
	</main>
</div>
<?php get_footer();

