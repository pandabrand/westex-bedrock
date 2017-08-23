<?php while ($gallery_query->have_posts()): $gallery_query->the_post(); ?>
  <div class="l-front-page_upcoming-exhibition">
    <div class="c-front-gallery_smalltype u-label-font">
      <?php
          $location = get_the_terms( get_the_ID(), 'location');
          $term = array_pop($location);
          echo $term->name;
      ?>
    </div>
    <?php $artists = get_field('artists'); $switch_title = get_field('switch_titleartist_order'); $show_title = get_field('display_exhibition_title'); ?>
    <?php if($switch_title): ?>
      <?php if($show_title): ?>
        <div class="strong emphasis mb-2">
          <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <?php echo get_the_title(); ?>
          </a>
        </div>
      <?php endif; ?>
      <div class="d-flex flex-wrap">
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
    <?php else: ?>
      <div class="d-flex flex-wrap">
        <?php
          if($artists):
            foreach ($artists as $artist):
              echo '<div class="h4 pr-2">',$artist->post_title,'</div>';
            endforeach;
          endif;

          if(have_rows('artist_non-roster')):
            while(have_rows('artist_non-roster')): the_row();
              echo '<div class="h4 pr-2">',the_sub_field('artist_non-roster_name'),'</div>';
            endwhile;
          endif;
        ?>
      </div>
      <?php if($show_title): ?>
        <div class="strong emphasis">
          <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <?php echo get_the_title(); ?>
          </a>
        </div>
      <?php endif; ?>
    <?php endif; ?>
    <div class="u-label-font u-smalltext"><?php the_field('start_date'); ?></div>
  </div>
<?php endwhile; ?>
