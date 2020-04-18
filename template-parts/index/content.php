<?php
defined( 'ABSPATH' ) || exit;
/**
 *
 * @package Neatly
 */
/*Loop*/
$i = 1;


$mod_value = array(
	'index_widget' => get_theme_mod( 'neatly_index_widget','after'),
	'index_widget_num' => get_theme_mod( 'neatly_index_widget_num',3),
	'thum_size' => get_theme_mod( 'neatly_index_thum_size','large'),
	'index_avatar' => get_theme_mod( 'neatly_index_avatar',true),
	'index_author_name' => get_theme_mod( 'neatly_index_author_name',true),
	'index_date_type' => get_theme_mod( 'neatly_index_date_type','human'),
);


while(have_posts()): the_post();
	$post_title = get_the_title();


	$post_author = get_the_author();
	$human_time = '';
	$sticky = '';

	/*抜粋オプション判定*/
	if(has_excerpt()){

		$allowed_html = array(
			'br' => array(),
		);
		$post_content =  wp_kses( nl2br( get_post_field('post_excerpt', $post->ID) ), $allowed_html);

	}else{

		$post_content = mb_strimwidth( wp_strip_all_tags( preg_replace('{\[[^\]]+\]}s', '',  get_the_content() ), true), 0 , 300, '...' );

	}


		$post_date = '';
	if( is_sticky() ) {
		$sticky = '<span class="mr4 svg16">'. neatly_get_theme_svg( 'thumb-tack' ) .'</span> ';

	}else{
		$post_date = get_the_date();
		if( $mod_value['index_date_type'] === 'human'){

			$human_time =  neatly_human_time_diff( date_i18n('Y-m-d H:i:s', get_the_time('U') ) );
			if($human_time !== '')$post_date = $human_time;

		}

	}

	?>
	<article <?php post_class('index_frame'); ?>>
		<a href="<?php the_permalink(); ?>" class="main_fc tap_no">
			<?php
			if(has_post_thumbnail()) {/*サムネイルがある場合*/
				echo '<figure class="index_thum mb_M fit_index fit_box_img_wrap">';
				the_post_thumbnail($mod_value['thum_size']);
				echo '</figure>';
			}



			echo '<h2 class="index_title f_box ai_c lh_15 mb8">'.$sticky.$post_title.'</h2>';
			echo '<div class="index_content line_clamp lc3 of_h fsS mb_M">'.$post_content.'</div>';
			?>
		</a>
		<div class="index_meta">
			<?php
			if ( comments_open() ) {
				$num_comments = intval( get_comments_number() );
				if($num_comments !== 0): ?>
					<div class="index_comment mb_M fs14 sub_fc">
						<a href="<?php the_permalink(); ?>#comments"><span class="svg12"><?php echo neatly_get_theme_svg( 'comment-o' ); ?></span> <?php comments_number('0','1','%'); ?></a>
					</div>
				<?php endif;
			} ?>
			<div class="index_avatime f_box ai_c">
				<?php if($mod_value['index_avatar']): ?>
					<div class="index_avatar mr4">
						<?php echo '<a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'" class="f_box ai_c"><img src="' . esc_url( get_avatar_url( get_the_author_meta( 'ID' ) , array("size"=>96 )) ) . '" width="32" height="32" class="br50" alt="'.get_the_author_meta( 'nickname' ).'" decoding="async" /></a>'; ?>
					</div>
				<?php endif; ?>
				<div class="lh_12">
					<?php if($mod_value['index_author_name']): ?>
						<div class="index_author sub_fc fs12 mb4"><?php echo '<a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'" class="sub_fc">'. $post_author .'</a>'; ?></div>
					<?php endif;
					if($mod_value['index_date_type'] !== 'none'): ?>
						<div class="index_date sub_fc fs12" title="<?php echo get_the_date(); ?>"><?php echo $post_date; ?></div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</article>
	<?php

	/*Index Widget*/
	if ( is_active_sidebar( 'index_list' ) ){
		if( ($mod_value['index_widget_num'] === $i && $mod_value['index_widget'] === 'after') || ( $i % $mod_value['index_widget_num'] === 0 && $mod_value['index_widget'] === 'every') ){
			?>
			<div class="index_frame">
				<?php dynamic_sidebar( 'index_list' ); ?>
			</div>
			<?php
		}
	}

	++$i;

endwhile;

