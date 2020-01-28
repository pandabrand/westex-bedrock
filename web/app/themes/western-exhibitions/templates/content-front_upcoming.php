<?php
  $today = date('Ymd');
  if( false === ( $gallery_query = get_transient( 'front_upcoming' ) ) ) {
    $args = array(
      'numberofposts' => 3,
      'post_type' => ['exhibition'],
      'tax_query' => array(
        array(
          'taxonomy' => 'location',
          'field' => 'slug',
          'terms' => array('gallery-one', 'gallery-two', 'gallery-one-and-two')
          )
        ),
        'meta_query' => array(
          'display_start_date_clause' => array(
            'key' => 'display_start_date',
            'compare' => '>',
            'value' => $today,
          ),
          array(
            'key' => 'off-site_exhibition',
            'compare' => '==',
            'value' => '0',
          ),
          'gallery_location_clause' => array(
            'key' => 'gallery_location',
            'compare' => 'EXISTS'
            )
          ),
          'orderby' => array('display_start_date_clause' => 'ASC', 'gallery_location_clause' => 'ASC'),
        );
        $gallery_query = new WP_Query($args);
        set_transient( 'front_upcoming', $gallery_query, 60*60*12 );
  }
?>
<?php if($gallery_query->have_posts()): ?>
  <div class="h3">Upcoming Exhibitions</div>
  <?php include( locate_template('templates/content-front_upcoming_details.php', false, false)); ?>
<?php endif; ?>
<?php wp_reset_query(); ?>
