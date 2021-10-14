<?php
defined( 'ABSPATH' ) || exit;
/**
 * Template for displaying search forms in Neatly
 *
 * @package WordPress
 * @subpackage Neatly
 */


?>

<form role="search" method="get" class="search_form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" id="<?php echo esc_attr( uniqid( 'search-form-' ) ); ?>" class="search_field" placeholder="<?php esc_attr_e( 'Search', 'neatly' ) ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search_submit"><span class="svg18"><?php echo neatly_get_theme_svg( 'search' ); ?></span></button>
</form>

