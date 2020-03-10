<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif;

wp_head();

?>
</head>
<body <?php body_class(); ?> ontouchstart="">
	<?php wp_body_open(); ?>
	<header id="h_wrap" class="h_wrap f_box f_col ai_c w100" itemscope itemtype="https://schema.org/WPHeader">

		<div class="wrap_frame w100">
			<input type="checkbox" id="mh" class="dn" />
			<div class="h_top<?php if ( !has_nav_menu( 'primary' ) ) echo ' no_menu'; ?> f_box ai_c f_col110 w100 relative">

				<div class="mh_wrap f_box ai_c relative">

					<?php
					if(is_active_sidebar( 'search_widget' )) : ?>
						<label for="sw" id="sw_icon" class="svg18 absolute left0 m0 p4 tap_no lh_1 dn001" style="cursor:pointer;"><?php echo neatly_get_theme_svg( 'search' ); ?></label>
					<?php endif; ?>
					<div class="h_logo_wrap">
						<div class="h_logo f_box ai_c jc_c110">
							<?php neatly_header_logo_icon(); ?>
							<?php neatly_header_logo_title(); ?>
						</div>
						<?php if(get_theme_mod( 'neatly_tagline_display',true)): ?>
							<div class="description fs12 sub_fc">
								<?php echo get_bloginfo('description' , 'display'); ?>
							</div>
						<?php endif; ?>
					</div>
					<?php
					if ( has_nav_menu( 'primary' ) ) : ?>

						<label for="mh" id="toggle-menu" class="mh svg18 absolute right0 m0 p4 tap_no lh_1 dn001"><?php echo neatly_get_theme_svg( 'menu' ); ?></label>

					<?php endif; ?>


				</div>
				<?php neatly_header_widget();
				if(is_active_sidebar( 'search_widget' )) echo '<label for="sw" id="" class="svg18 m0 p4 tap_no lh_1 dn110" style="cursor:pointer;margin-left:12px;">'.neatly_get_theme_svg( 'search' ).'</label>';
				?>
			</div>
			<?php neatly_primary_menu(); ?>

		</div>
	</header>
