<?php
defined( 'ABSPATH' ) || exit;
/**
 * The template part for displaying a message that posts cannot be found
 *
 * @package NEATLY
 */

?>
<div class="p12">

  <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

  <p><?php esc_html_e( 'Ready to publish your first post?', 'neatly'); ?>
  <a href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>">
    <?php esc_html_e( 'Get started here.', 'neatly' ); ?></a></p>

    <?php elseif ( is_search() ) : ?>

      <p><?php esc_html_e( 'Sorry, but nothing matched your search terms.', 'neatly' ); ?></p>
      <p class="mb_L"><?php esc_html_e( 'Please try again with some different keywords.', 'neatly' ); ?></p>
      <?php get_search_form(); ?>

      <?php else : ?>

        <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'neatly' ); ?></p>
        <p class="mb_L"><?php esc_html_e( 'Perhaps searching can help.', 'neatly' ); ?></p>
        <?php get_search_form(); ?>

      <?php endif; ?>


    </div>
