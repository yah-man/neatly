<?php
defined( 'ABSPATH' ) || exit;
/**
 *
 * @package Neatly
 */
/*post author*/

function neatly_author_post(){
  $display_type['date'] = get_theme_mod( 'neatly_post_date_display','both');
  $display_type['avatar'] = get_theme_mod( 'neatly_post_author_avatar',true);
  $display_type['name'] = get_theme_mod( 'neatly_post_author_name',true);
  $display_type['time'] = get_theme_mod( 'neatly_post_time_display',false);
  $display_type['type'] = 'post';
  if( $display_type['date'] !== 'none' || $display_type['avatar'] || $display_type['name'])
    neatly_author_output($display_type);
}

function neatly_author_page(){
  $display_type['date'] = get_theme_mod( 'neatly_page_date_display','none');
  $display_type['avatar'] = get_theme_mod( 'neatly_page_author_avatar',false);
  $display_type['name'] = get_theme_mod( 'neatly_page_author_name',false);
  $display_type['time'] = get_theme_mod( 'neatly_page_time_display',false);
  $display_type['type'] = 'page';
  if( $display_type['date'] !== 'none' || $display_type['avatar'] || $display_type['name'])
    neatly_author_output($display_type);
}

function neatly_author_output($display_type){

  $author['nickname'] = apply_filters( 'yahman_themes_author_nickname', get_the_author_meta('nickname') );
  $author['ID'] = get_the_author_meta( 'ID' );
  ?>

  <div class="index_meta f_box ai_c mb16">
    <?php
    if($display_type['avatar']):
      ?>
      <div class="index_avatar mr8">
        <?php echo '<a href="'.esc_url(get_author_posts_url( $author['ID'] )).'" class="f_box ai_c"><img src="' . esc_url( get_avatar_url( $author['ID'] , array("size"=>96 )) ) . '" width="32" height="32" class="br50" alt="'.esc_attr($author['nickname']).'" decoding="async" /></a>'; ?>
      </div>
      <?php
    endif;
    ?>
    <div class="lh_12 mb4">
      <?php
      if($display_type['name']):
        ?>
        <span class="index_author sub_fc fs12"><?php echo '<a href="'.esc_url(get_author_posts_url( $author['ID'] )).'" class="sub_fc">'. esc_html($author['nickname']) .'</a>'; ?></span>
        <?php
      endif;
      if($display_type['date'] !== 'none'):
        ?>
        <div class="f_box ai_c f_wrap">
          <div class="mr8">
            <?php
            if($display_type['date'] !== 'update' || get_the_modified_date('Ymd') === get_the_date('Ymd') ){
              echo '<span class="'.$display_type['type'].'_date sub_fc fs12">'.get_the_date().'</span>';
              if($display_type['time']){
                echo '<span class="'.$display_type['type'].'_time ml4 sub_fc fs12">'.get_the_time().'</span>';
              }
            }
            ?>
          </div>
          <?php



          if (get_the_modified_date('Ymd') > get_the_date('Ymd') && $display_type['date'] !== 'publish'){
            echo '<div>';
            if ($display_type['date'] === 'both'){
              echo '<span class="sub_fc mr4 svg12">'. neatly_get_theme_svg( 'refresh' ) .'</span>';
            }
            echo '<span class="'.$display_type['type'].'_update sub_fc fs12">'.get_the_modified_date().'</span>';

            if($display_type['time']){
              echo '<span class="'.$display_type['type'].'_modified ml4 sub_fc fs12">'.get_the_modified_time().'</span>';
            }
            echo '</div>';
          }
          ?>
        </div>
        <?php
      endif;
      ?>
    </div>
  </div>

  <?php
}


