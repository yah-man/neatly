<?php
defined( 'ABSPATH' ) || exit;
?>
<aside id="sidebar_right" class="sidebar sidebar_right f_box f_col101" itemscope itemtype="https://schema.org/WPSideBar">
	<?php
	if ( function_exists( 'neatly_bbpress_sidebar' ) && neatly_is_bbpress() ){

		dynamic_sidebar( 'bbpress-sidebar-1' );

	}else{

		dynamic_sidebar( 'sidebar-1' );
		if( is_active_sidebar( 'sidebar-fixed' ) ) {
			echo '<div class="fix_sidebar">';
			dynamic_sidebar( 'sidebar-fixed' );
			echo '</div>';
		}

	}


	?>
</aside>

