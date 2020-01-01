<?php
  $today = date('Ymd');
  $meta_query_val = get_query_var('artist_filter');

  $meta_query = array(
    'relation' => 'AND',
    array(
      'key' => 'start_date',
      'compare' => '<',
      'value' => $today,
    ),
    array(
      'key' => 'end_date',
      'compare' => '<',
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
  );

  if(!empty($meta_query_val)) {
    $meta_query[] = array(
      'key' => 'artists',
      'compare' => 'LIKE',
      'value' => '"' . $meta_query_val . '"'
    );
  }

  $args = array(
    'post_type' => ['exhibition'],
    // 'orderby' => 'start',
    // 'order' => 'DESC',
    // 'posts_per_page' => 5,
    // 'paged' => $paged,
    'meta_query' => array($meta_query),
    'nopaging' => true,
    'orderby' => array('start_date' => 'DESC', 'gallery_location_clause' => 'ASC')
  );
  $wp_query = new WP_Query($args);
  $display_year = 0;
  ?>

<div class="container">
  <?php while (have_posts()) : the_post(); ?>
    <?php
      $current_date = get_field('start_date');
      $date_year = DateTime::createFromFormat('M d, Y', $current_date)->format('Y');
      if($date_year != $display_year ):
    ?>
      <div class="row l-front-gallery_row">
        <div class="col-md-12">
          <div class="h2"><?php echo $date_year; ?></div>
        </div>
      </div>
    <?php
      endif;
      $display_year = ($display_year != $date_year) ? $date_year : $display_year;
    ?>
    <div class="row l-front-gallery_row">
      <div class="col-md-6">
        <?php
          if ( has_post_thumbnail() ) {
            the_post_thumbnail( 'medium' );
          }
        ?>
      </div>
      <div class="col-md-6">
        <?php $artists = get_field('artists'); $switch_title = get_field('switch_titleartist_order'); $show_title = get_field('display_exhibition_title'); ?>
        <?php if($switch_title): ?>
          <?php if($show_title): ?>
            <div class="emphasis h3"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
          <?php endif; ?>
          <div class="d-flex flex-wrap mt-2">
            <?php
              if($artists):
                foreach ($artists as $artist):
                  echo '<div class="strong h4 pr-2">',$artist->post_title,'</div>';
                endforeach;
              endif;

              if(have_rows('artist_non-roster')):
                while(have_rows('artist_non-roster')): the_row();
                  echo '<div class="strong h4 pr-2">',the_sub_field('artist_non-roster_name'),'</div>';
                endwhile;
              endif;
            ?>
          </div>
        <?php else: ?>
          <div class="d-flex flex-wrap mt-2">
            <?php
              if($artists):
                echo sprintf('<a href="%s" title="%s">', get_permalink(), get_the_title());
                foreach ($artists as $artist):
                  echo '<span class="strong h3 pr-2">',$artist->post_title,'</span>';
                endforeach;
                echo '</a>';
              endif;

              if(have_rows('artist_non-roster')):
                echo sprintf('<a href="%s" title="%s">', get_permalink(), get_the_title());
                while(have_rows('artist_non-roster')): the_row();
                  echo '<span class="strong h3 pr-2">',the_sub_field('artist_non-roster_name'),'</span>';
                endwhile;
                echo '</a>';
              endif;
            ?>
          </div>
          <?php if($show_title): ?>
            <div class="emphasis h4"><?php the_title(); ?></div>
          <?php endif; ?>
        <?php endif; ?>
        <div class="c-front-gallery_smalltype u-label-font"><?php the_field('start_date'); ?> - <?php the_field('end_date'); ?></div>
        <?php $today = date('Ymd'); if(get_field('opening_reception') <= $today): ?>
          <div>Opening Reception <?php the_field('opening_reception'); ?></div>
        <?php endif; ?>
      </div>
    </div>
  <?php endwhile; ?>
</div>

<?php wp_reset_query(); ?>
