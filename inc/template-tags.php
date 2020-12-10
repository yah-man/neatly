<?php
defined( 'ABSPATH' ) || exit;
/**
 * Template Tags
 *
 * This file contains several template functions which are used to print out specific HTML markup
 * in the theme. You can override these template functions within your child theme.
 *
 * @package Neatly
 */

class NEATLY_WALKER_NAV_MENU extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = Array() ) {
		$output .= "";
	}
	function end_lvl( &$output, $depth = 0, $args = Array() ) {
		$output .= "";
	}
	function start_el( &$output, $item, $depth = 0, $args = Array(), $id = 0 ) {

		$menu_class = '';

		foreach ($item->classes as $key => $value) {
			$menu_class .= ' ' . $value;
		}

		if (in_array('menu-item-has-children', $item->classes)) {
        // parent

			$input_id = "nav-".$item->ID;
			$caption = $item->title;
			$label = '';

			if($args->theme_location === 'primary'){

				$label = "\n" .'<label class="drop_icon fs16 m0" for="'.$input_id.'">';
				if($depth !== 0){
					$label .= "\n" . '<span class="svg10 dn001 db lh_1">'. neatly_get_theme_svg( 'caret-down' ) .'</span><span class="svg10 dn110 db lh_1">'. neatly_get_theme_svg( 'caret-right' ) .'</span>';
				}else{
					$label .= "\n" . '<span class="svg10 db lh_1">'. neatly_get_theme_svg( 'caret-down' ) .'</span>';
				}

				$label .= "\n" . '</label>' . "\n" ;
			}

			$output .= "\n" . '<li id="menu-item-'.$item->ID.'" class="menu-item-'.$item->ID.$menu_class.' relative fs24 fw_bold">' . "\n";
			$output .= "\n" . '<input type="checkbox" id="'.$input_id.'" class="dn">';
			$output .= "\n" . '<div class="caret_wrap f_box jc_sb ai_c">' . "\n";
			$output .= $this->create_a_tag($item, $depth, $args , '');
			$output .= "\n" . $label . "\n";
			$output .= "\n" . '</div>' . "\n";
			$output .= "\n" . '<ul id="sub-'.$input_id.'" class="sub-menu absolute db lsn">';


		}
		else {
        // child
			$label = '';
			$output .= "\n" . '<li id="menu-item-'.$item->ID.'"  class="menu-item-'.$item->ID.$menu_class.' relative fs24 fw_bold">' . "\n";
			$output .= "\n" . '<div class="f_box jc_sb ai_c">' . "\n";
			$output .= $this->create_a_tag($item, $depth, $args , $label);
			$output .= "\n" . '</div>' . "\n";
		}
	}
	function end_el( &$output, $item, $depth = 0, $args = Array(), $id = 0 ) {
		if (in_array('menu-item-has-children', $item->classes)) {
        // parent
			$output .= "\n".'</ul>' . "\n" . '</li>';
		}
		else {
        // child
			$output .= "\n".'</li>' ."\n" ;
		}
	}

	private function create_a_tag($item, $depth, $args , $label) {
        // link attributes
		$attributes = ' class="menu_s_a f_box jc_sb ai_c sub_fc"';
		$attributes .= ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        //$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

		$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s%6$s</a>%7$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$label,
			$args->after
		);
		return apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}


/*ヘッダーメニュー*/
if ( ! function_exists( 'neatly_primary_menu' ) ) :

	function neatly_primary_menu() {?>

		<nav id="nav_h" class="wrap_frame nav_h" itemscope itemtype="https://schema.org/SiteNavigationElement">
			<?php wp_nav_menu( array(
				'theme_location'  => 'primary',
				'menu_class'      => 'menu_h menu_a f_box f_wrap f_col110 ai_c lsn',
				'menu_id'         => 'menu_header',
				'container'       => 'ul',
				'fallback_cb'     => '__return_false',
				'walker'            => new NEATLY_WALKER_NAV_MENU,
			));
			?>
		</nav>
		<?php
	}

endif;

/*フッターメニュー*/
if ( ! function_exists( 'neatly_footer_menu' ) ) :
	function neatly_footer_menu(){
		echo '<div id="menu_f" class="p16_0"><nav id="nav_f" class="wrap_frame nav_f f_box jc_c p16_0">';
		wp_nav_menu( array(
			'theme_location'  => 'secondary',
			'menu_class'      => 'menu_f menu_a menu_s o_s_t f_box ai_c m0 lsn',
			'menu_id'         => 'menu_footer',
			'container'       => 'ul',
			'fallback_cb'     => '__return_false',
			'walker'            => new NEATLY_WALKER_NAV_MENU,
		));
		echo '</nav></div>';
	}
endif;

/*フッターメニュー*/
if ( ! function_exists( 'neatly_credit_menu' ) ) :
	function neatly_credit_menu(){
		echo '<div id="menu_c" class="mb_L"><nav id="nav_c" class="wrap_frame nav_f f_box jc_c">';
		wp_nav_menu( array(
			'theme_location'  => 'credit',
			'menu_class'      => 'menu_f menu_a menu_s o_s_t f_box ai_c m0 lsn',
			'menu_id'         => 'menu_credit',
			'container'       => 'ul',
			'fallback_cb'     => '__return_false',
			'walker'            => new NEATLY_WALKER_NAV_MENU,
		));
		echo '</nav></div>';
	}
endif;

/*ヘッダーウィジェット*/
if ( ! function_exists( 'neatly_header_widget' ) ) :
	function neatly_header_widget(){
		echo '<div id="header_widget" class="f_box f_col100 ai_c">';
		dynamic_sidebar('header_widget');
		echo '</div>';
	}
endif;

if ( ! function_exists( 'neatly_header_logo_title' ) ) :
	function neatly_header_logo_title () {

		if ( has_custom_logo() ) {
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			echo '<a href="'. esc_url( home_url( '/' ) ) .'" rel="home" class="dib w100" style="line-height:0;"><img src="' . esc_url( $logo[0] ) . '" class="header_logo" alt="' . get_bloginfo( 'name' , 'display' ) . '" width="'.esc_attr( $logo[1] ).'" height="'.esc_attr( $logo[2] ).'" decoding="async" /></a>';
		} else {
			echo '<h1 class="title_text fs24 fw_bold"><a href="'. esc_url( home_url( '/' ) ) .'" rel="home">'.get_bloginfo( 'name' , 'display' ).'</a></h1>';
		}


	}
endif;

if ( ! function_exists( 'neatly_header_logo_icon' ) ) :
	function neatly_header_logo_icon () {

		$header_icon = get_theme_mod( 'neatly_header_icon','');

		if($header_icon !== '' ){
			$header_icon_size = wp_get_attachment_metadata( attachment_url_to_postid($header_icon) );
			echo '<a href="'. esc_url( home_url( '/' ) ) .'" rel="home" class="dib" style="line-height:0;"><img src="' . esc_url( $header_icon ) . '" class="header_icon mr8" width="'.$header_icon_size['width'].'" height="'.$header_icon_size['height'].'" alt="' . get_bloginfo( 'name' , 'display' ) . '" decoding="async" /></a>';
		}

	}
endif;

/*時差*/
if ( ! function_exists( 'neatly_human_time_diff' ) ) :
	function neatly_human_time_diff($time) {

		$tzstring = get_option( 'timezone_string' );
		$offset   = get_option( 'gmt_offset' );

    //Manual offset...
    //@see http://us.php.net/manual/en/timezones.others.php
    //@see https://bugs.php.net/bug.php?id=45543
    //@see https://bugs.php.net/bug.php?id=45528
    //IANA timezone database that provides PHP's timezone support uses POSIX (i.e. reversed) style signs
		if( empty( $tzstring ) && 0 != $offset && floor( $offset ) == $offset ){
			$offset_st = $offset > 0 ? "-$offset" : '+'.absint( $offset );
			$tzstring  = 'Etc/GMT'.$offset_st;
		}

    //Issue with the timezone selected, set to 'UTC'
		if( empty( $tzstring ) ){
			$tzstring = 'UTC';
		}

		$now = new DateTime('', new DateTimeZone( $tzstring ) );

		$interval = $now->diff(new DateTime($time, new DateTimeZone( $tzstring ) ));

		//if ($interval->invert == 0) return __('just now','neatly');//'just now';
		if ($interval->y == 1) return __('a year ago','neatly');
		/* translators: %s: years */
		if ($interval->y > 1) return  sprintf( __( '%s years ago' , 'neatly' ), $interval->format('%y') );
		if ($interval->m == 1) return __('a month ago','neatly');
		/* translators: %s: months */
		if ($interval->m > 1) return  sprintf( __( '%s months ago' , 'neatly' ), $interval->format('%m') );
		/* translators: %s: week */
		if ($interval->d > 13) return sprintf( __('%s weeks ago','neatly'), intval($interval->d / 7) );
		if ($interval->d == 7) return __('a week ago','neatly');
		/* translators: %s: time */
		if ($interval->d == 1) return sprintf( __('yesterday at %s','neatly'), get_post_time('h:i a') );
		/* translators: %s: date */
		if ($interval->d > 1) return  sprintf( __( '%s days ago' , 'neatly' ), $interval->format('%d') );
		if ($interval->h == 1) return __('an hour ago','neatly');
		/* translators: %s: hour */
		if ($interval->h > 1) return sprintf( __( '%s hours ago' , 'neatly' ), $interval->format('%h') );
		if ($interval->i == 1) return __('a minute ago','neatly');
		/* translators: %s: minute */
		if ($interval->i > 1) return sprintf( __( '%s minutes ago' , 'neatly' ), $interval->format('%i') );
		return __('just now','neatly');//$interval->format('just now');
	}
endif;


if ( ! function_exists( 'neatly_get_thumbnail' ) ) :
	function neatly_get_thumbnail($post_id = '' , $size = 'thumbnail') {

		/*
	     * @param string $post_id Post ID.
	     * @param string $size thumbnail, middle ,large etc.
	    */
		$thumbnail = array();

		if( has_post_thumbnail($post_id) ) {/*サムネイルがある場合*/
			/*配列で返す*/
			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post_id) , $size );
			$thumbnail['has_image'] = true;

			return $thumbnail;

		}else{

			preg_match("/<img[^>]+src=[\"'](s?https?:\/\/[\-_\.!~\*'()a-z0-9;\/\?:@&=\+\$,%#]+\.(jpg|jpeg|png|gif))[\"'][^>]+>/i", get_post($post_id)->post_content, $thumurl);

			if(isset($thumurl[1])){

				$img_id = attachment_url_to_postid($thumurl[1]);
				$img_data = wp_get_attachment_metadata ($img_id);

				/*サイト内の画像であれば*/
				if(!empty($img_data) ){
					$thumbnail[0] = $thumurl[1];
					$thumbnail[1] = $img_data['width'];
					$thumbnail[2] = $img_data['height'];
					$thumbnail['has_image'] = true;
					return $thumbnail;
				}

			}

		}

		$thumbnail[0] = $thumbnail[1] = $thumbnail[2] = '';
		$thumbnail['has_image'] = false;

		return $thumbnail;

	}
endif;


if ( ! function_exists( 'neatly_comment_author_anchor' ) ) :
	function neatly_comment_author_anchor( $author_link ){
		return str_replace( "<a", "<a target='_blank'", $author_link );
	}
endif;
add_filter( "get_comment_author_link", "neatly_comment_author_anchor" );

if ( ! function_exists( 'neatly_comment' ) ) :
	function neatly_comment($comment, $args, $depth) {

		switch ( $comment->comment_type ) :

			case 'pingback':
			case 'trackback':
			?>
			<li class="pingback">
				<p class="mb8"><span class="svg12 mr4"><?php echo neatly_get_theme_svg( 'caret-right' ); ?></span><?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'neatly' ), ' <span class="svg16 ml8 mr4">' . neatly_get_theme_svg( 'pencil' ) . '</span><span class="edit-link">', '</span>' ); ?></p>

				<?php

				break;
				default:

				$comment_author = '';
				$comment_author_right = '';
				if ( false !== strpos( comment_class('',null,null,false), 'bypostauthor' ) ) {
					$comment_author = 'author ';
					$comment_author_right = ' ta_r';
					$comment_author_left = ' ta_l';
				}

				?>



				<li id="comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
					<div class="comment_body mb_M pb8<?php echo esc_attr($comment_author_right); ?>" itemscope itemtype="https://schema.org/UserComments">

						<div class="<?php echo esc_attr($comment_author); ?>comment_data f_box ai_c mb8">
							<div class="comment_avatar br50 of_h m4">
								<?php echo get_avatar( $comment->comment_author_email, 60 ); ?>
							</div>

							<div class="comment_meta m12">
								<span class="fn" itemprop="creator" itemscope itemtype="https://schema.org/Person"><?php echo get_comment_author_link(); ?></span>
								<div>
									<time><?php comment_date(get_option( 'date_format' )); ?></time>

									<span class="comment_edit">
										<?php edit_comment_link('<span class="svg12">' . neatly_get_theme_svg( 'pencil' ) . '</span> '.__('Edit', 'neatly'),'  ','') ?>
									</span>
								</div>
							</div>
						</div>



						<div class="<?php echo esc_attr($comment_author); ?>comment_text" itemprop="commentText">
							<div>
								<?php comment_text() ?>
								<div class="comment_reply">
									<?php comment_reply_link(array_merge( $args, array('reply_text' => '<span class="svg12">' . neatly_get_theme_svg( 'reply' ) . '</span> '.__('Reply', 'neatly'),'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
								</div>
							</div>
						</div>


						<?php if ($comment->comment_approved == '0') : ?>
							<span><?php esc_html_e('*Your comment is awaiting moderation.*', 'neatly') ?></span>
						<?php endif; ?>
					</div>


					<?php
					break;
				endswitch;

			}
		endif;

		function neatly_move_comment_field_to_bottom( $fields ) {

			if(get_theme_mod( 'neatly_post_comments_bottom',false) ){
				$order = array('author','email','url','comment','cookies');

				uksort($fields, function($key1, $key2) use ($order) {
					return (array_search($key1, $order) > array_search($key2, $order));
				});
			}

			return $fields;
		}

		add_filter( 'comment_form_fields', 'neatly_move_comment_field_to_bottom' );


		if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Fire the wp_body_open action.
	 *
	 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
	 */
	function wp_body_open() {
		/**
		 * Triggered after the opening <body> tag.
		 */
		do_action( 'wp_body_open' );
	}
endif;



if ( ! function_exists( 'neatly_the_posts_pagination' ) ) :
	function neatly_the_posts_pagination( $args = array() ) {
		$navigation = '';

	// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages > 1 ) {
			$args = wp_parse_args(
				$args,
				array(
					'mid_size'           => 1,
					'prev_text' => '<span class="svg16">'. neatly_get_theme_svg( 'chevron-left' ) .'</span>',
					'next_text' => '<span class="svg16">'. neatly_get_theme_svg( 'chevron-right' ) .'</span>',
					'screen_reader_text' => __( 'Posts navigation' , 'neatly' ),
				)
			);

			$args['type'] = 'list';

		    // Set up paginated links.
			$links = paginate_links( $args );

			if ( $links ) {
				$links = preg_replace(array(
					'{<ul class=["\']page-numbers["\']>}',
					'{<li>}',
					'{<a class=["\']prev}',
					'{<a class=["\']next}',
					'{<a class=["\']page-numbers["\']}',
					'{["\']page-numbers current["\']}',
				),
				array(
					'<ul class="nav-links f_box ai_c jc_c f_wrap fsL lsn">',
					'<li class="mr8">',
					'<a class="prev fw8',
					'<a class="next fw8',
					'<a class="page-numbers number br4"',
					'"page-numbers current br4"',
				),
				$links);

				if ( empty( $args['screen_reader_text'] ) ) {
					$args['screen_reader_text'] = __( 'Posts navigation' , 'neatly' );
				}

				$template = '
				<nav class="navigation pagination-outer mb_L w100" role="navigation">
				<h2 class="screen-reader-text">%1$s</h2>
				%2$s
				</nav>';
				$navigation = sprintf($template, esc_html( $args['screen_reader_text'] ), $links);
			}

			echo $navigation;
		}


	}
endif;

if ( ! function_exists( 'neatly_remove_hentry' ) ) :
	/*hentryを外す*/
	function neatly_remove_hentry( $hentry ) {
		return array_diff($hentry, array('hentry'));
	}
endif;
add_filter('post_class', 'neatly_remove_hentry');



if ( ! function_exists( 'neatly_replace_reply_link_class' ) ) :
	function neatly_replace_reply_link_class($class){
		return str_replace("class='comment-reply-link", "class='comment-reply-link dib p4_8 br4", $class);
	}
endif;
add_filter('comment_reply_link', 'neatly_replace_reply_link_class');


if ( ! function_exists( 'neatly_header_search_widget' ) ) :
	function neatly_header_search_widget(){
		?>
		<div class="sw_open relative" style="z-index:100;">
			<input type="checkbox" id="sw" class="dn" />
			<div id="sw_wrap" class="left0 top0">
				<label for="sw" class="absolute w100 h100 left0 top0" style="z-index:101;"></label>
				<div class="sw_inner absolute" style="z-index:102;">
					<?php dynamic_sidebar('search_widget'); ?>
				</div>
			</div>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'neatly_show_footer_widget' ) ) :
	function neatly_show_footer_widget(){

		if ( is_page_template( 'templates/title_content_no_sidebar.php' ) ) return;

		/*bbPress判定*/
		if ( function_exists( 'neatly_is_bbpress' ) && neatly_is_bbpress() ){

			if ( is_active_sidebar( 'bbpress-footer-1' )  || is_active_sidebar( 'bbpress-footer-2' )  || is_active_sidebar( 'bbpress-footer-3' )  ) : ?>
				<div class="f_widget_wrap">
					<div class="f_widget_inner wrap_frame f_box jc_sb f_col100">
						<div class="f_widget_L f_widget_block f_col"><?php dynamic_sidebar('bbpress-footer-1'); ?></div>
						<div class="f_widget_C f_widget_block f_col"><?php dynamic_sidebar('bbpress-footer-2'); ?></div>
						<div class="f_widget_R f_widget_block f_col"><?php dynamic_sidebar('bbpress-footer-3'); ?></div>
					</div>
				</div>
				<?php
			endif;


		}elseif ( is_active_sidebar( 'footer-1' )  || is_active_sidebar( 'footer-2' )  || is_active_sidebar( 'footer-3' )  ){
			?>
			<div class="f_widget_wrap">
				<div class="f_widget_inner wrap_frame f_box jc_sb f_col100">
					<div class="f_widget_L f_widget_block f_box f_col"><?php dynamic_sidebar('footer-1'); ?></div>
					<div class="f_widget_C f_widget_block f_box f_col"><?php dynamic_sidebar('footer-2'); ?></div>
					<div class="f_widget_R f_widget_block f_box f_col"><?php dynamic_sidebar('footer-3'); ?></div>
				</div>
			</div>
			<?php


		}




	}
endif;
