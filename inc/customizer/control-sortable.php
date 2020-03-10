<?php
defined( 'ABSPATH' ) || exit;
/**
 * Sortable Control
 *
 * @package Neatly
 */

class Neatly_Posts_Sortable_Custom_Control extends WP_Customize_Control {
  /**The type of control being rendered */
  public $type = 'neatly_posts_sortable';
  /*** Enqueue our scripts and styles */
  public function enqueue() {
    wp_register_script(
      'neatly_sortable',
      NEATLY_THEME_URI . 'assets/js/customizer/sortable.min.js',
      array( 'jquery', 'customize-base', 'jquery-ui-core', 'jquery-ui-sortable' ),
      '',
      true
    );
    wp_enqueue_script( 'neatly_sortable' );
  }

  /**  * Render the control in the customizer  */
  public function render_content() {


    echo '<span class="customize-control-title">'.esc_html($this->label).'</span>';
    echo '<span class="description customize-control-description">'.esc_html($this->description).'</span>';
    echo '<ul class="neatly_posts_sortable_ul">';

    foreach ($this->choices as $key => $value) {
      $value_item = self::section_name($value);
      echo '<li class="" data-value="'.esc_attr($value).'"><i class="dashicons dashicons-visibility visibility"></i>'.esc_html($value_item).'<i class="dashicons dashicons-menu"></i></li>';
    }

    $diff = '';
    require_once NEATLY_THEME_DIR . 'template-parts/single/sort_order.php';
    if($this->id === 'neatly_posts_sortable'){
      $diff = neatly_sort_order_diff_post();
    }
    if($this->id === 'neatly_pages_sortable'){
      $diff = neatly_sort_order_diff_page();
    }
    if(!empty($diff)){
      foreach ($diff as $key => $value) {
        $value_item = self::section_name($value);
        echo '<li class="invisible" data-value="'.esc_attr($value).'"><i class="dashicons dashicons-visibility visibility dashicons-visibility-faint"></i>'.esc_html($value_item).'<i class="dashicons dashicons-menu"></i></li>';
      }
    }

    echo '</ul>';
  }


  public function section_name($value) {

    switch ($value){
      case 'breadcrumbs':
      $value_item = esc_html_x( 'Breadcrumbs' , 'post_sortable' ,'neatly' );
      break;
      case 'title':
      $value_item = esc_html_x( 'Title' , 'post_sortable' ,'neatly' );
      break;
      case 'date':
      $value_item = esc_html_x( 'Date' , 'post_sortable' ,'neatly' );
      break;
      case 'author':
      $value_item = esc_html_x( 'Author & Date' , 'post_sortable' ,'neatly' );
      break;
      case 'pv':
      $value_item = esc_html_x( 'Page views' , 'post_sortable' ,'neatly' );
      break;
      case 'thumbnail':
      $value_item = esc_html_x( 'Thumbnail' , 'post_sortable' ,'neatly' );
      break;
      case 'content':
      $value_item = esc_html_x( 'Content' , 'post_sortable' ,'neatly' );
      break;
      case 'widget_1':
      $value_item = esc_html_x( 'Widget' , 'post_sortable' ,'neatly' ).' 1';
      break;
      case 'widget_2':
      $value_item = esc_html_x( 'Widget' , 'post_sortable' ,'neatly' ).' 2';
      break;
      case 'widget_3':
      $value_item = esc_html_x( 'Widget' , 'post_sortable' ,'neatly' ).' 3';
      break;
      case 'widget_4':
      $value_item = esc_html_x( 'Widget' , 'post_sortable' ,'neatly' ).' 4';
      break;
      case 'widget_5':
      $value_item = esc_html_x( 'Widget' , 'post_sortable' ,'neatly' ).' 5';
      break;
      case 'page_link':
      $value_item = esc_html_x( 'Page Link' , 'post_sortable' ,'neatly' );
      break;
      case 'cta':
      $value_item = esc_html_x( 'CTA' , 'post_sortable' ,'neatly' );
      break;
      case 'share':
      $value_item = esc_html_x( 'Share' , 'post_sortable' ,'neatly' );
      break;
      case 'author_profile':
      $value_item = esc_html_x( 'About the author' , 'post_sortable' ,'neatly' );
      break;
      case 'related':
      $value_item = esc_html_x( 'Related' , 'post_sortable' ,'neatly' );
      break;
      case 'category':
      $value_item = esc_html_x( 'Category' , 'post_sortable' ,'neatly' );
      break;
      case 'tag':
      $value_item = esc_html_x( 'Tag' , 'post_sortable' ,'neatly' );
      break;
      case 'adjacent':
      $value_item = esc_html_x( 'Adjacent' , 'post_sortable' ,'neatly' );
      break;
      case 'comment':
      $value_item = esc_html_x( 'Comment' , 'post_sortable' ,'neatly' );
      break;
      default:
      $value_item = esc_html_x( 'Mystery' , 'post_sortable' ,'neatly' );
    }

    return $value_item;
  }


  }//end Neatly_Posts_Sortable_Custom_Control


