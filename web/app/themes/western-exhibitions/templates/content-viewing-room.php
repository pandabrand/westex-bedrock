<?php
// Check value exists.
if( have_rows('westex_blocks') ):

  // Loop through rows.
  while ( have_rows('westex_blocks') ) : the_row();

      $layout = get_row_layout();
      switch( $layout ):
        case 'title_block':
            set_query_var( 'title', get_sub_field('title') );
            get_template_part( 'partials/block', 'title' );
          break;

          case 'full_width_image_block':
            set_query_var( 'image', get_sub_field('image') );
            set_query_var( 'fw_image_size', 'viewing-room-full img-fluid' );
            set_query_var( 'image_classes', array( 'img-fw' ) );
            get_template_part( 'partials/block', 'full-width-image' );
        break;

        case 'two_column_block':
            set_query_var( 'image', get_sub_field('image') );
            set_query_var( 'tc_image_size', 'viewing-room' );
            set_query_var( 'tc_classes', array( 'class' => 'img-fluid' ) );
            set_query_var( 'placement', get_sub_field('image_placement') );
            set_query_var( 'body', get_sub_field('text_body') );
            get_template_part( 'partials/block', 'two-column' );
        break;

        case 'two_column_image_block':
            set_query_var( 'image_one', get_sub_field('image_one') );
            set_query_var( 'image_two', get_sub_field('image_two') );
            set_query_var( 'tc_image_size', 'viewing-room' );
            set_query_var( 'tc_classes', array( 'class' => 'img-fluid' ) );
            get_template_part( 'partials/block', 'two-column-image' );
        break;

        case 'quote_block':
            set_query_var( 'quote', get_sub_field('quote') );
            get_template_part( 'partials/block', 'quote' );
        break;

        case 'embed_media_block':
            set_query_var( 'media', get_sub_field('media') );
            get_template_part( 'partials/block', 'media' );
        break;

        case 'slideshow_block':
            set_query_var( 'images', get_sub_field('slideshow_images') );
            set_query_var( 'slideshow_size', 'slide-show' );
            set_query_var( 'slideshow_image_class', array('class' => 'd-block img-fluid') );
            get_template_part( 'partials/block', 'slideshow' );
        break;

        case 'text_block':
            set_query_var( 'body', get_sub_field('text_body') );
            get_template_part( 'partials/block', 'text' );
        break;

      endswitch;

  // End loop.
  endwhile;

// No value.
else :
  // Do nothing...
endif;

wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']);
