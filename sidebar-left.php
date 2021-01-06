<?php
defined( 'ABSPATH' ) || exit;
?>
<aside id="sidebar_left" class="sidebar sidebar_left f_box f_col101" itemscope itemtype="https://schema.org/WPSideBar">
	<?php
	if ( function_exists( 'neatly_bbpress_sidebar' ) && neatly_is_bbpress() ){

		dynamic_sidebar( 'bbpress-sidebar-2' );

	}else{

		dynamic_sidebar( 'sidebar-2' );
		if( is_active_sidebar( 'sidebar-fixed-2' ) ) {
			echo '<div class="fix_sidebar">';
			dynamic_sidebar( 'sidebar-fixed-2' );
			echo '</div>';
		}

	}


	?>
</aside>

