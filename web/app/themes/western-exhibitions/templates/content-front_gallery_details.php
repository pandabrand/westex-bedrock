<div class="container">
  <?php while ($front_query->have_posts()): $front_query->the_post(); ?>
    <div class="row l-front-gallery_row jsExhibitonLink" data-url="<?php the_permalink(); ?>" data-title="<?php the_title(); ?>">
      <div class="col-md-6 pl-0">
        <div class="c-front-gallery_smalltype u-label-font"><?php
              $location = get_the_terms( get_the_ID(), 'location');
              $term = array_pop($location);
              echo 'In ', $term->name;
            ?>
        </div>
        <?php $artists = get_field('artists'); $switch_title = get_field('switch_titleartist_order'); $show_title = get_field('display_exhibition_title'); ?>
        <?php if($switch_title): ?>
          <?php if($show_title): ?>
            <div class="c-front-gallery_h1 emphasis"><?php the_title(); ?></div>
          <?php endif; ?>
          <div class="d-flex flex-wrap">
            <?php
              if($artists):
                foreach ($artists as $artist):
                  echo '<div class="strong pr-2">',$artist->post_title,'</div>';
                endforeach;
              endif;

              if(have_rows('artist_non-roster')):
                while(have_rows('artist_non-roster')): the_row();
                  echo '<div class="strong pr-2">',the_sub_field('artist_non-roster_name'),'</div>';
                endwhile;
              endif;
            ?>
          </div>
        <?php else: ?>
          <div class="d-flex flex-wrap c-front-gallery_h1">
            <?php
              if($artists):
                foreach ($artists as $artist):
                  echo '<div class="pr-2">',$artist->post_title,'</div>';
                endforeach;
              endif;

              if(have_rows('artist_non-roster')):
                while(have_rows('artist_non-roster')): the_row();
                  echo '<div class="pr-2">',the_sub_field('artist_non-roster_name'),'</div>';
                endwhile;
              endif;
            ?>
          </div>
          <?php if($show_title): ?>
            <div class="strong emphasis"><?php the_title(); ?></div>
          <?php endif; ?>
        <?php endif; ?>
        <div class="c-front-gallery_smalltype u-extra-v-margin u-label-font"><?php the_field('start_date'); ?> - <?php the_field('end_date'); ?></div>
        <?php $today = date('Ymd'); if(get_field('opening_reception') <= $today): ?>
          <div>Opening Reception <?php the_field('opening_reception'); ?></div>
        <?php endif; ?>
      </div>
      <div class="col-md-6 pr-0">
        <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>" title="<?php get_the_title(get_post_thumbnail_id()); ?>">
                <?php the_post_thumbnail('large',array('class' => 'img-fluid')); ?>
            </a>
            <div class="u-smalltext u-caption"><?php echo get_the_title(get_post_thumbnail_id()); ?></div>
        <?php endif; ?>
      </div>
    </div>
  <?php endwhile; ?>
</div>
