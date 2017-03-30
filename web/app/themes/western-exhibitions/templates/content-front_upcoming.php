<div class="h3">Upcoming Exhibitions</div>
<?php
  $today = date('Ymd');
  $args = array(
    'numberofposts' => 1,
    'post_type' => ['exhibition'],
    'tax_query' => array(
      array(
        'taxonomy' => 'location',
        'field' => 'slug',
        'terms' => array('gallery-one')
      )
    ),
    'meta_query' => array(
      array(
        'key' => 'start_date',
        'compare' => '>=',
        'value' => $today,
      )
    )
  );
  $gallery_query = new WP_Query($args);
?>
<?php if($gallery_query->have_posts()): ?>
  <?php include( locate_template('templates/content-front_upcoming_details.php', false, false)); ?>
<?php endif; ?>
<?php wp_reset_query(); ?>
<?php
  $today = date('Ymd');
  $args = array(
    'numberofposts' => 1,
    'post_type' => ['exhibition'],
    'tax_query' => array(
      array(
        'taxonomy' => 'location',
        'field' => 'slug',
        'terms' => array('gallery-two')
      )
    ),
    'meta_query' => array(
      array(
        'key' => 'start_date',
        'compare' => '>=',
        'value' => $today,
      )
    )
  );
  $gallery_query = new WP_Query($args);
?>
<?php if($gallery_query->have_posts()): ?>
  <?php include( locate_template('templates/content-front_upcoming_details.php', false, false)); ?>
<?php endif; ?>
