<?php
write_log(wp_get_post_parent_id(get_the_ID()));
if ($parent_post_id = wp_get_post_parent_id(get_the_ID())) {
  $parent_menu_array = array('Home' => get_permalink($parent_post_id));

  if (have_rows('westex_blocks', $parent_post_id)) {
    while (have_rows('westex_blocks', $parent_post_id)) {
      the_row();
      $parent_layout = get_row_layout();
      if ('parent_page_block' === $parent_layout) {
        $child_post = get_sub_field('child_page')[0];
        $title = !empty(get_sub_field('title')) ? get_sub_field('title') : get_the_title($child_post);
        $parent_menu_array[ $title ] = get_permalink($child_post);
      }
    }
  }

  if ($parent_post_id && 1 < count($parent_menu_array)) :
    ?>
    <div class="container westex-vr-parent-page">
      <div class="row">
        <div class="col-sm-12">
        <div class="dropdown in-depth-menu">
            <button id="in-depth-menu-button" class="in-depth-menu-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo get_the_title($parent_post_id); ?> Menu<span class="caret"></span>
            </button>
            <ul class="dropdown-menu in-depth-menu-dropdown" aria-labelledby="in-depth-menu-button">
            <?php
            foreach ($parent_menu_array as $menu_title => $menu_link) :
              ?>
              <li class="in-depth-menu-dropdown-item">
                <a href="<?php echo $menu_link; ?>"><?php echo $menu_title; ?></a>
              </li>
              <?php
            endforeach;
            ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <?php
  endif;
}
if (have_rows('westex_blocks')) :
  // Loop through rows.
  while (have_rows('westex_blocks')) : the_row();
    $layout = get_row_layout();
    switch ($layout) :
      case 'title_block':
          set_query_var( 'title', get_sub_field('title') );
          set_query_var( 'artist', get_sub_field('artist') );
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
          set_query_var( 'image_caption', get_sub_field('image_caption') );
          set_query_var( 'tc_image_size', 'viewing-room' );
          set_query_var( 'tc_classes', array( 'class' => 'img-fluid' ) );
          set_query_var( 'placement', get_sub_field('image_placement') );
          set_query_var( 'body', get_sub_field('text_body') );
          get_template_part( 'partials/block', 'two-column' );
      break;

      case 'two_column_image_block':
          set_query_var( 'image_one', get_sub_field('image_one') );
          set_query_var( 'image_two', get_sub_field('image_two') );
          set_query_var( 'image_one_caption', get_sub_field('image_one_caption') );
          set_query_var( 'image_two_caption', get_sub_field('image_two_caption') );
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
          set_query_var( 'media_caption', get_sub_field('media_caption') );
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

      case 'wide_text_block':
          set_query_var( 'body', get_sub_field('text_body') );
          get_template_part( 'partials/block', 'text-wide' );
      break;

      case 'gallery_block':
          set_query_var( 'gallery_images', get_sub_field('gallery_images') );
          get_template_part( 'partials/block', 'gallery' );
      break;

      case 'image_block':
          set_query_var( 'image', get_sub_field('image') );
          set_query_var( 'image_caption', get_sub_field('image_caption') );
          set_query_var( 'tc_image_size', 'viewing-room-large' );
          set_query_var( 'tc_classes', array( 'class' => 'img-fluid' ) );
          get_template_part( 'partials/block', 'image' );
      break;

      case 'parent_page_block':
        $child_post = get_sub_field('child_page')[0];
        $child_title = !empty(get_sub_field('title')) ? get_sub_field('title') : get_the_title($child_post);
        set_query_var('title', $child_title);
        set_query_var('introduction_text', get_sub_field('introduction_text'));
        set_query_var('child_page_link', get_permalink($child_post));
        set_query_var('image', get_sub_field('image'));
        set_query_var('image_caption', get_sub_field('image_caption'));
        set_query_var('tc_image_size', 'viewing-room-large');
        set_query_var('tc_classes', array('class' => 'img-fluid'));
        get_template_part('partials/block', 'parent-page');
      break;
    endswitch;
  // End loop.
  endwhile;
endif;

wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']);
