<?php
  $today = date('Ymd');
  $args = array(
    'post_type' => ['exhibition'],
    // 'orderby' => 'start',
    // 'order' => 'DESC',
    'posts_per_page' => 5,
    'paged' => $paged,
    'meta_query' => array(
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
    ),
    'orderby' => array('start_date' => 'DESC', 'gallery_location_clause' => 'ASC')
  );
  $wp_query = new WP_Query($args);
  ?>

<div class="container">
  <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
    <div class="row l-front-gallery_row jsExhibitonLink" data-url="<?php the_permalink(); ?>" data-title="<?php the_title(); ?>">
      <div class="col-md-6">
        <div class="c-front-gallery_smalltype u-label-font">
          <?php
              $location = get_the_terms( get_the_ID(), 'location');
              $term = array_pop($location);
              echo 'In ', $term->name;
            ?>
        </div>
        <?php $artists = get_field('artists'); $switch_title = get_field('switch_titleartist_order'); $show_title = get_field('display_exhibition_title'); ?>
        <?php if($switch_title): ?>
          <?php if($show_title): ?>
            <div class="emphasis h3"><?php the_title(); ?></div>
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
                foreach ($artists as $artist):
                  echo '<div class="strong h3 pr-2">',$artist->post_title,'</div>';
                endforeach;
              endif;

              if(have_rows('artist_non-roster')):
                while(have_rows('artist_non-roster')): the_row();
                  echo '<div class="strong h3 pr-2">',the_sub_field('artist_non-roster_name'),'</div>';
                endwhile;
              endif;
            ?>
          </div>
          <?php if($show_title): ?>
            <div class="emphasis h4"><?php the_title(); ?></div>
          <?php endif; ?>
        <?php endif; ?>
        <div class="c-front-gallery_smalltype u-extra-v-margin u-label-font"><?php the_field('start_date'); ?> - <?php the_field('end_date'); ?></div>
        <?php $today = date('Ymd'); if(get_field('opening_reception') <= $today): ?>
          <div>Opening Reception <?php the_field('opening_reception'); ?></div>
        <?php endif; ?>
      </div>
      <div class="col-md-6">
        <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php the_post_thumbnail('large',array('class' => 'img-fluid')); ?>
            </a>
        <?php endif; ?>
      </div>
    </div>
  <?php endwhile; ?>
</div>

<div class="nav-links">
    <?php previous_posts_link('Newer') ?>
    <?php next_posts_link('Older') ?>
</div>

<?php wp_reset_query(); ?>
