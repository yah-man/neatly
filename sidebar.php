<?php
defined( 'ABSPATH' ) || exit;
?>
<aside id="sidebar" class="sidebar f_box f_col101" itemscope itemtype="https://schema.org/WPSideBar">
	<?php dynamic_sidebar( 'sidebar-1' );
	if( is_active_sidebar( 'sidebar-fixed' ) ) {
		echo '<div class="fix_sidebar">';
		dynamic_sidebar( 'sidebar-fixed' );
		echo '</div>';
	}
	?>
</aside>
