<?php

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
  $vars[] = "artist_press";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

function wpsites_query( $query ) {
  if ( $query->is_archive() && $query->is_main_query() && !is_admin() ) {
    $query->set( 'posts_per_page', 12 );
    if(isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'press') {
      $meta_query_val = get_query_var('artist_press');
      $meta_query = array();
      if($meta_query_val) {
        $artist_post = get_page_by_title($meta_query_val, OBJECT, 'artist');
        $artist_post_id = $artist_post->ID;
        $meta_query = array(
          'key' => 'artist_press',
          'value' => $artist_post_id,
          'compare' => 'IN'
        );
      } else {
        $meta_query = array(
          'key' => 'gallery_press',
          'value' => '1',
          'compare' => '=='
        );
      }
      $filter = array(
        'meta_query' => array(
          $meta_query,
        )
      );
      $query->set('meta_query', $filter);
    }
  }
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
  $montserrat = _x( 'on', 'Montserrat font: on or off', 'theme-slug' );

  /* Translators: If there are characters in your language that are not
  * supported by Open Sans, translate this to 'off'. Do not translate
  * into your own language.
  */
  $raleway = _x( 'on', 'Raleway font: on or off', 'theme-slug' );

  if ( 'off' !== $montserrat || 'off' !== $raleway ) {
    $font_families = array();

    if ( 'off' !== $montserrat ) {
      $font_families[] = 'Montserrat:400,700,400italic';
    }

    if ( 'off' !== $raleway ) {
      $font_families[] = 'Raleway:400';
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

function theme_slug_custom_header_fonts() {
  wp_enqueue_style( 'theme-slug-fonts', theme_slug_fonts_url(), array(), null );
}
add_action( 'admin_print_styles-appearance_page_custom-header', 'theme_slug_custom_header_fonts' );
