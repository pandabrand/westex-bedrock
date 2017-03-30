<?php
  $today = date('Ymd');
  $args = array(
    'post_type' => ['exhibition'],
    'orderby' => 'start',
    'order' => 'DESC',
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
      )
    )
  );
  $wp_query = new WP_Query($args);
  ?>

<div class="container">
  <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
    <div class="row l-front-gallery_row jsExhibitonLink" data-url="<?php the_permalink(); ?>" data-title="<?php the_title(); ?>">
      <div class="col-md-6">
        <div class="c-front-gallery_smalltype"><?php
              $location = get_the_terms( get_the_ID(), 'location');
              $term = array_pop($location);
              echo 'In ', $term->name;
            ?>
        </div>
        <div class="c-front-gallery_h1"><?php the_title(); ?></div>
        <?php $artists = get_field('artists'); ?>
        <div class="strong">
          <?php
            foreach ($artists as $artist) {
              echo '<div>',$artist->post_title,'</div>';
            }
          ?>
        </div>
        <div class="c-front-gallery_smalltype u-extra-v-margin"><?php the_field('start_date'); ?> - <?php the_field('end_date'); ?></div>
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
