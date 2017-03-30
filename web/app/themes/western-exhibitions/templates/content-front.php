<?php
  $today = date('Ymd');
  $args = array(
    'numberofposts' => 3,
    'post_type' => ['exhibition'],
    'orderby' => 'gallery_location',
    'order' => 'ASC',
    'meta_query' => array(
      'relation' => 'AND',
      array(
        'key' => 'start_date',
        'compare' => '<=',
        'value' => $today,
      ),
      array(
        'key' => 'end_date',
        'compare' => '>=',
        'value' => $today,
      )
    )
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
      </div>
    </div>
  </div>
</div>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
