<?php
defined( 'ABSPATH' ) || exit;
get_header();
get_template_part( 'template-parts/index/format', 'archive_title' );
?>

<div class="main_wrap wrap_frame f_box f_col110 jc_c001">
  <main class="main_contents index_contents br4">
    <header class="archive_header m16 mb_L">
      <?php
      the_archive_title( '<h1 class="archive_title fsL mb_M f_box ai_c">', '</h1>' );
      the_archive_description( '<div class="archive_description">', '</div>' );
      ?>
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
