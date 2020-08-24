<?php

use Roots\Sage\Extras;

add_filter( 'get_the_archive_title', function ($title) {

if (is_post_type_archive() /*artist' == get_post_type()*/ ) {
    $title = sprintf( __( '%s' ), post_type_archive_title( '', false ) );
  }

  return $title;
});

if ( ! function_exists( 'westex_scripts' ) ) :
function westex_scripts() {
  wp_enqueue_script( 'fontawesome', 'https://use.fontawesome.com/9846696b3f.js', array(), '20170328', false );
}
endif;
add_action( 'wp_enqueue_scripts', 'westex_scripts' );


function add_query_vars_filter( $vars ){
  $vars[] = "artist_filter";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

function wpsites_query( $query ) {
  if(is_admin() || !$query->is_main_query()) {
    return;
  }

  if( is_home() ) {
    $today = date('Ymd');
    $query->set('meta_query', array(
      'relation' => 'OR',
      array(
        'key' => 'web_display_start_date',
        'compare' => '<=',
        'value' => $today,
      ),
      array(
        'relation' => 'AND',
        array(
          'key'     => 'start_date',
          'compare' => 'EXISTS'
        ),
        array(
          'key'     => 'web_display_start_date',
          'compare' => 'NOT EXISTS',
        ),
      ),
      array(
        'relation' => 'AND',
        array(
          'key'     => 'start_date',
          'compare' => 'NOT EXISTS'
        ),
        array(
          'key'     => 'web_display_start_date',
          'compare' => 'NOT EXISTS',
        ),
      ),
    ));
    $query->set( 'posts_per_page', 12 );
    $query->set('orderby', 'meta_value_num post_date');
  }

  if ( $query->is_archive() && $query->is_main_query() && !is_admin() ) {
    $query->set( 'posts_per_page', 12 );

    if(is_post_type_archive('press')) {
      $meta_query_val = get_query_var('artist_filter');
      $meta_query = array();
      if($meta_query_val) {
        $meta_query = array(
          'key' => 'artist_press',
          'value' => $meta_query_val,
          'compare' => 'IN'
        );
        $filter = array(
          'meta_query' => array(
            $meta_query,
          )
        );
        $query->set('meta_query', $filter);
      }
    }

    if(is_post_type_archive('artist')) {
      $query->set('posts_per_page', -1 );
      $query->set('meta_key', 'artist_sort_order');
      $query->set('orderby', 'meta_value_num');
      $query->set('order', 'ASC');
      return;
    }

    if(is_post_type_archive( 'art_fair' )) {
      $meta_query_val = get_query_var('artist_filter');
      $meta_query = array();
      if($meta_query_val) {
        $meta_query = array(
          'key' => 'western_exhibitions_artists',
          'value' => $meta_query_val,
          'compare' => 'LIKE'
        );
        $filter = array(
          'meta_query' => array(
            $meta_query,
          )
        );
        $query->set('meta_query', $filter);
      }

      $query->set('meta_key', 'start_date');
      $query->set('orderby', 'meta_value_num');
      $query->set('order', 'DESC');
      // return;
    }

  }
  return $query;
}
add_action( 'pre_get_posts', 'wpsites_query' );

function posts_link_attributes() {
    return 'class="w-50"';
}

add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function theme_slug_fonts_url() {
  $fonts_url = '';

  /* Translators: If there are characters in your language that are not
  * supported by Lora, translate this to 'off'. Do not translate
  * into your own language.
  */
  $gentium = _x( 'on', 'Gentium font: on or off', 'theme-slug' );

  /* Translators: If there are characters in your language that are not
  * supported by Open Sans, translate this to 'off'. Do not translate
  * into your own language.
  */
  $raleway = _x( 'on', 'Raleway font: on or off', 'theme-slug' );
  $sanchez = _x( 'off', 'Sanchez font: on or off', 'theme-slug' );
  $lato = _x( 'on', 'Lato font: on or off', 'theme-slug' );

  if ( 'off' !== $gentium || 'off' !== $raleway || 'off' !== $sanchez || 'off' !== $lato) {
    $font_families = array();

    if ( 'off' !== $gentium ) {
      $font_families[] = 'Gentium+Book+Basic:400,700,400italic';
    }

    if ( 'off' !== $raleway ) {
      $font_families[] = 'Raleway:400';
    }

    if ( 'off' !== $sanchez ) {
      $font_families[] = 'Sanchez:400';
    }

    if ( 'off' !== $lato ) {
      $font_families[] = 'Lato:400,700';
    }

    $query_args = array(
      'family' => urlencode( implode( '|', $font_families ) ),
      'subset' => urlencode( 'latin,latin-ext' ),
    );

    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
  }

  return esc_url_raw( $fonts_url );
}

function theme_slug_scripts_styles() {
  wp_enqueue_style( 'theme-slug-fonts', theme_slug_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'theme_slug_scripts_styles' );

function theme_slug_editor_styles() {
  add_editor_style( array( 'editor-style.css', theme_slug_fonts_url() ) );
}
add_action( 'after_setup_theme', 'theme_slug_editor_styles' );

function westex_image_sizes() {
  add_image_size( 'viewing-room', 720, 720 );
  add_image_size( 'viewing-room-full', 2400, 500 );
  add_image_size( 'slide-show', 500, 500 );
}
add_action( 'after_setup_theme', 'westex_image_sizes' );

function theme_slug_custom_header_fonts() {
  wp_enqueue_style( 'theme-slug-fonts', theme_slug_fonts_url(), array(), null );
}
add_action( 'admin_print_styles-appearance_page_custom-header', 'theme_slug_custom_header_fonts' );

function westex_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'News';
    $submenu['edit.php'][5][0] = 'News';
    $submenu['edit.php'][10][0] = 'Add News';
    $submenu['edit.php'][16][0] = 'News Tags';
}

function westex_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'News';
    $labels->singular_name = 'News';
    $labels->add_new = 'Add News';
    $labels->add_new_item = 'Add News';
    $labels->edit_item = 'Edit News';
    $labels->new_item = 'News';
    $labels->view_item = 'View News';
    $labels->search_items = 'Search News';
    $labels->not_found = 'No News found';
    $labels->not_found_in_trash = 'No News found in Trash';
    $labels->all_items = 'All News';
    $labels->menu_name = 'News';
    $labels->name_admin_bar = 'News';
}

add_action( 'admin_menu', 'westex_change_post_label' );
add_action( 'init', 'westex_change_post_object' );

// add_action('pmxi_update_post_meta', 'westex_update_post_meta', 10, 3);
//
// function westex_update_post_meta($pid, $m_key, $m_value) {
//   if ( $m_key == 'artist') {
//     update_field($m_key, unserialize($m_value)[0], $pid);
//   }
// }
add_filter('acf/settings/google_api_key', function ($value) {
  return GOOGLE_API_KEY;
});

function write_log ( $log )  {
  if ( is_array( $log ) || is_object( $log ) ) {
    error_log( print_r( $log, true ) );
  } else {
    error_log( $log );
  }
}

function tock_header_script() {
  ?>
  <script>
    !function(t,o,c,k){if(!t.tock){var e=t.tock=function(){e.callMethod?
    e.callMethod.apply(e,arguments):e.queue.push(arguments)};t._tock||(t._tock=e),
    e.push=e,e.loaded=!0,e.version='1.0',e.queue=[];var f=o.createElement(c);f.async=!0,
    f.src=k;var g=o.getElementsByTagName(c)[0];g.parentNode.insertBefore(f,g)}}(
    window,document,'script','https://www.exploretock.com/tock.js');

    tock('init', 'westernexhibitions');
    </script>
  <?php
}

add_action('wp_head', 'tock_header_script');

function tock_widget() {
  return '<div class="btn btn-tock"><span data-tock-reserve="true" data-tock-offering="150586">Book Appointment</span></div>';
}

add_shortcode('tock-widget', 'tock_widget');
