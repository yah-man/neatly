<?php defined( 'ABSPATH' ) || exit;
get_header();?>

<div class="main_wrap wrap_frame f_box f_col110 jc_c001">
  <main class="main_contents post_contents br4">
    <header class="archive_header m16 mb_L">
      <h1 class="archive_title fsL f_box ai_c"><span class="mr4"><?php echo neatly_get_theme_svg( 'search' ); ?></span><?php /* translators: %s: search term */ printf( esc_html__( 'Search Results for: %s', 'neatly' ), get_search_query() ); ?></h1>
    </header>
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
