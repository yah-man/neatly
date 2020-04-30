<?php
defined( 'ABSPATH' ) || exit;
/**
 *
 * @package Neatly
 */
/*post order*/
function neatly_post_order( $type , $single_sortable , $post) {

  if( !is_array($single_sortable) ) return;

  if(is_front_page()){
    $switch['is_front_page'] = true ;
  }else{
    $switch['is_front_page'] = false ;
  }


  $format = get_post_format();
  $pwcat = false;

  if($type === 'page'){

    if (function_exists('pages_with_category_and_tag_register') ) $pwcat = true;

  }

  $yahman_addons_option = array();
  if(function_exists('yahman_addons_plugins_loaded')){
    $yahman_addons_option = get_option('yahman_addons') ;
  }

  foreach ($single_sortable as $key => $section) :
    switch ($section){

      case 'breadcrumbs':

      if ( function_exists( 'neatly_is_bbpress' ) && neatly_is_bbpress() ) break;

      if(!$switch['is_front_page']){
        get_template_part( 'inc/breadcrumbs' );
        neatly_breadcrumb_list();
      }

      break;

      case 'title':

      if($format != 'aside' && $format != 'link' && $format != 'status'){
        get_template_part( 'template-parts/single/'.$section );
        $vf = 'neatly_' . $section . '_' . $type;
        $vf();
      }
      break;

      case 'author':

      if(!$switch['is_front_page']){
        get_template_part( 'template-parts/single/'.$section );
        $vf = 'neatly_' . $section . '_' . $type;
        $vf();
      }

      break;

      case 'pv':

      if( isset($yahman_addons_option['pv']['enable']) ){

        if( get_theme_mod( 'neatly_pageview_logout',false) || current_user_can('administrator') ){

          $pv_count = get_post_meta($post->ID, '_yahman_addons_pv_'.get_theme_mod( 'neatly_pageview','all'), true);

          if($pv_count != ''){
            echo '<div class="page_view post_item mb_L ta_r"><span class="svg16 mr4">'. neatly_get_theme_svg( 'signal' ) .'</span> '. $pv_count .'</div>';

          }


        }
      }
      break;

      case 'thumbnail':
      if(has_post_thumbnail()) {/*サムネイルがある場合*/
        if($type === 'post'){
          $thum_size = get_theme_mod( 'neatly_post_thum_size','large');
        }else{
          $thum_size = get_theme_mod( 'neatly_page_thum_size','large');
        }
        echo '<figure class="post_thum index_thum mb_L fit_box_img_wrap fit_content">';
        the_post_thumbnail($thum_size);
        echo '</figure>';

      }
      break;

      case 'content':

      echo '<article id="post_body" class="post_body clearfix post_item mb_L" itemprop="articleBody">';
      the_content();
      echo '</article>';

      break;

      case 'widget_1':
      case 'widget_2':
      case 'widget_3':
      case 'widget_4':
      case 'widget_5':
      if($type === 'post'){
        $widget_name = 'post_'.$section;
      }else{
        $widget_name = 'page_'.$section;
      }
      /*記事下のウィジェット*/
      if ( is_active_sidebar( $widget_name ) ) :
        $fit_content = '';
        if ( get_theme_mod( 'neatly_widget_fit_'.$widget_name, true )) $fit_content = ' fit_content';
        ?>
        <aside class="post_widget post_item mb_L<?php echo $fit_content; ?>">
          <?php dynamic_sidebar( $widget_name ); ?>
        </aside>
      <?php endif;
      break;


      case 'page_link':
      //link pages
      get_template_part( 'template-parts/single/link_page' );
      break;



      case 'cta':
      if(!$switch['is_front_page']){
        $result = false;

        if( isset($yahman_addons_option['cta_social'][$type]) )$result = true;

        if($result){
          if( function_exists('yahman_addons_cta_social') ){
            echo yahman_addons_cta_social();
          }
        }
      }
      break;

      case 'share':
      if(!$switch['is_front_page']){
        $result = false;

        if( isset($yahman_addons_option['share'][$type]) )$result = true;

        if($result){
          if( function_exists('yahman_addons_social_share') ){
            echo yahman_addons_social_share();
          }
        }
      }
      break;

      case 'author_profile':
      if(!$switch['is_front_page']){
        //author_profile
        if ( ! is_singular( 'attachment' ) ) :

          get_template_part( 'template-parts/single/author_profile');
          neatly_author_profile();

        endif;
      }
      break;

      case 'related':
      if(!$switch['is_front_page'] && function_exists( 'yahman_addons_related_post' )){
        if($type === 'post'){
          echo yahman_addons_related_post($type);
        }elseif($pwcat){
          echo yahman_addons_related_post($type);
        }
      }
      break;

      case 'category':
      if(!$switch['is_front_page']){
        $categories = NULL;
        if($type === 'post'){
          $categories = get_the_category();
        }else{
          if($pwcat){
            $get_page_id = get_the_ID();
            $categories = get_the_category($get_page_id);
          }
        }

        if(!empty($categories)){
          echo '<div class="post_cats f_box f_wrap mb_M">';
          foreach($categories as $category) {
            echo '<a href="'.esc_url(get_category_link($category->cat_ID)).'" rel="category" class="post_cat fs14 mr8 mb4 p4_8 br4">'. esc_html($category->cat_name). '</a>';
          }
          echo '</div>';
        }

      }
      break;


      case 'tag':
      if(!$switch['is_front_page']){
        $result = true;
        if($type === 'page'){
          if(!has_tag() && !$pwcat )$result = false;
        }
        if($result){
          $post_tags = get_the_tags( get_the_ID() );
          if(!empty($post_tags) ){
            echo '<div class="post_tags f_box f_wrap mb_M">';
            foreach($post_tags as $post_tag){
              echo '<a href="'.esc_url(get_tag_link($post_tag->term_id)).'" rel="tag" class="post_tag fs14 mr8 mb4 p4_8 br4">#'.esc_html($post_tag->name).'</a>';
            }
            echo '</div>';
          }

        }

      }
      break;

      case 'adjacent':
      if(!$switch['is_front_page']){
          //adjacent
        get_template_part( 'template-parts/single/adjacent' );
      }
      break;
      case 'comment':
      if(!$switch['is_front_page']){
        /* If comments are open or we have at least one comment, load up the comment template.*/
        if ( comments_open() || get_comments_number() ){
          comments_template();
        }
      }
      break;






      default:
      /*どれでも無い*/
    }

  endforeach;





}


