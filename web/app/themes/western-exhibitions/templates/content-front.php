<?php
  $today = date('Ymd');
  $args = array(
    'numberofposts' => 3,
    'post_type' => ['exhibition'],
    // 'orderby' => 'gallery_location',
    // 'order' => 'ASC',
    'meta_query' => array(
      'relation' => 'AND',
      'start_date_clause' => array(
        'key' => 'display_start_date',
        'compare' => '<=',
        'value' => $today,
      ),
      'end_date_clause' => array(
        'key' => 'display_end_date',
        'compare' => '>=',
        'value' => $today,
      ),
      array(
        'relation' => 'OR',
        array(
          'key' => 'off-site_exhibition',
          'compare' => 'EXISTS',
          'value' => ''
        ),
        array(
          'key' => 'off-site_exhibition',
          'compare' => '==',
          'value' => '0',
        )
      ),
      'gallery_location_clause' => array(
        'key' => 'gallery_location',
        'compare' => 'EXISTS'
      )
    ),
    'orderby' => array('gallery_location_clause' => 'ASC'),
  );
  $front_query = new WP_Query($args);
?>
<?php if($front_query->have_posts()): ?>
  <?php include( locate_template('templates/content-front_gallery_details.php', false , false)); ?>
<?php endif; ?>
<?php wp_reset_query(); ?>
<div class="l-front-page_content">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <?php the_content(); ?>
      </div>
      <div class="col-md-6">
        <?php get_template_part('templates/content-front_upcoming'); ?>
        <?php get_template_part('templates/content-front_upcoming-art-fair'); ?>
      </div>
    </div>
  </div>
</div>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
