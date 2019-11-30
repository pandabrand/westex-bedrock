<?php
  $today = date('Ymd');
  $args = array(
    'numberofposts' => 3,
    'post_type' => ['art_fair'],
    'meta_query' => array(
      array(
        'key' => 'start_date',
        'compare' => '>=',
        'value' => $today,
      ),
    ),
    'orderby' => 'meta_value',
    'meta_key' => 'start_date',
    'order' => 'ASC'
  );
  $art_fair_query = new WP_Query($args);
?>
<?php if($art_fair_query->have_posts()): ?>
  <div class="h3">Upcoming Art Fairs</div>
  <?php while ($art_fair_query->have_posts()): $art_fair_query->the_post(); ?>
    <div class="l-front-page_upcoming-exhibition">
      <div class="strong emphasis mb-2">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
          <?php echo get_the_title(); ?>
        </a>
      </div>
      <div class="u-label-font u-smalltext mb-2">
        <?php
          $start_date = get_field('start_date');
          $end_date = get_field('end_date');
          echo $start_date;
          if( $end_date ):
            echo ' – ', $end_date;
          endif;
        ?>
      </div>
      <div class="mb-2">
        <?php
          $location = get_field('location');
          echo $location['address'];
        ?>
      </div>
      <?php
        $booth = get_field('booth');
        if( $booth ):
      ?>
        <div class="mb-2 c-front-gallery_smalltype u-label-font">
          <?php echo $booth; ?>
        </div>
      <?php endif; ?>
    </div>
  <?php endwhile ?>
<?php endif; ?>
<?php wp_reset_query(); ?>
