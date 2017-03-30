<?php while ($gallery_query->have_posts()): $gallery_query->the_post(); ?>
  <div class="l-front-page_upcoming-exhibition">
    <div class="c-front-gallery_smalltype">
      <?php
          $location = get_the_terms( get_the_ID(), 'location');
          $term = array_pop($location);
          echo $term->name;
      ?>
    </div>
    <div class="h4">
      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php echo get_the_title(); ?>
      </a>
    </div>
    <?php $artists = get_field('artists'); ?>
    <div class="strong">
      <?php
        foreach ($artists as $artist) {
          echo '<div>',$artist->post_title,'</div>';
        }
      ?>
    </div>
    <div class=""><?php the_field('start_date'); ?></div>
  </div>
<?php endwhile; ?>
