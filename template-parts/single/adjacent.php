<?php
defined( 'ABSPATH' ) || exit;
/**
 *
 * @package NEATLY
 */
/*adjacent*/


echo '<nav class="adjacents mb_L relative">';
echo '<div class="adjacent_info w100 f_box ai_c jc_sb absolute z2">
<div class="adjacent_prev f_box ai_c f_0a"><span class="sub_fc mr4 svg12">'. neatly_get_theme_svg( 'chevron-left' ) .'</span><div class="fw_bold fs14">'.esc_html__( 'Prev', 'neatly' ).'</div></div>
<div class="adjacent_sep mla mra w100"></div>
<div class="adjacent_next f_box ai_c f_0a"><div class="fw_bold fs14">'.esc_html__( 'Next', 'neatly' ).'</div><span class="sub_fc ml4 svg12">'. neatly_get_theme_svg( 'chevron-right' ) .'</span></div>
</div>';

echo '<div class="f_box jc_sb ai_c">';

$prevpost = get_adjacent_post('', '', true); /*前の記事*/
$nextpost = get_adjacent_post('', '', false); /*次の記事*/

if ($prevpost) { /*前の記事が存在しているとき*/
	$thumurl = neatly_get_thumbnail( $prevpost->ID , 'thumbnail');
        //wp_get_attachment_image_src (get_post_thumbnail_id ($prevpost->ID,  true));

	echo '<a href="' . esc_url(get_permalink($prevpost->ID)) . '" title="' . get_the_title($prevpost->ID) . '" class="adjacent adjacent_L p16_0 f_box ai_c f_col100 p16_0 h100">';
	if ($thumurl['has_image']){
		echo '<div class="adjacent_thum adjacent_thum_L f_box ai_c mr8">';
		echo '<img src="'.esc_url( $thumurl[0] ).'" width="48" height="48" alt="'. get_the_title($prevpost->ID) .'" decoding="async" />';
		echo '</div>';
	}
	echo '<div><p class="adjacent_title adjacent_title_L p8 fsMS">' . esc_html(mb_strimwidth(get_the_title($prevpost->ID), 0, 80, "...", 'UTF-8')) . '</p></div>';


}else{

	echo '<a href="' . esc_url(home_url()) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" class="adjacent adjacent_L p16_0 f_box ai_c h100">';
	echo '<p class="adjacent_title adjacent_title_L p8"><span class="sub_fc ml8 svg24">'. neatly_get_theme_svg( 'home' ) .'</span></p>';

}

echo '</a>';

if ( $nextpost ) { /*次の記事が存在しているとき*/
	$thumurl = neatly_get_thumbnail( $nextpost->ID , 'thumbnail');
        //$thumurl = wp_get_attachment_image_src (get_post_thumbnail_id ($nextpost->ID,  true));


	echo '<a href="' . esc_url(get_permalink($nextpost->ID)) . '" title="'. get_the_title($nextpost->ID) . '" class="adjacent adjacent_R p16_0 f_box ai_c jc_fe f_col_r100 p16_0 h100">';

	echo '<div class="ta_r"><p class="adjacent_title adjacent_title_R p8 fsMS">' . esc_html(mb_strimwidth(get_the_title($nextpost->ID), 0, 80, "...", 'UTF-8')) . '</p></div>';
	if ($thumurl['has_image']){
		echo '<div class="adjacent_thum adjacent_thum_R f_box ai_c ml8">';
		echo '<img src="'.esc_url( $thumurl[0] ).'" width="48" height="48" alt="'. get_the_title($nextpost->ID) .'" decoding="async" />';
		echo '</div>';
	}

}else{

	echo '<a href="' . esc_url(home_url()) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" class="adjacent adjacent_R p16_0 f_box ai_c jc_fe h100">';

	echo '<p class="adjacent_title adjacent_title_R p8"><span class="sub_fc mr8 svg24">'. neatly_get_theme_svg( 'home' ) .'</span></p>';

}

echo '</a>';

echo '</div>';

echo '</nav>';


