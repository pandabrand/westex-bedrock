<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class('pb-5'); ?>>
    <header>
      <?php $artists = get_field('artists'); ?>
        <?php
          foreach ($artists as $artist) {
            echo '<h1 class="entry-title">','<a href="', get_permalink($artist->ID), '">', $artist->post_title, '</a>', '</h1>';
          }
        ?>
      <div class="h3"><?php the_title(); ?></div>
    </header>
    <div class="entry-content">
      <div class="u-smalltext u-extra-v-margin">
        <?php the_field('start_date'); ?> - <?php the_field('end_date'); ?><br/>
        <?php
          $location = get_the_terms( get_the_ID(), 'location');
          $term = array_pop($location);
          echo 'In ', $term->name;
        ?>
      </div>
      <?php $today = date('Ymd'); if(get_field('opening_reception') >= $today): ?>
        <div>Opening Reception <?php the_field('opening_reception'); ?></div>
      <?php endif; ?>
      <div class="l-exhibition-featured-image mb-5">
        <?php $alt_string = str_replace(PHP_EOL, '', get_the_title(get_post_thumbnail_id()).' '.get_post(get_post_thumbnail_id())->post_content); ?>
        <?php the_post_thumbnail('full', array('class' => 'img-fluid', 'alt' => $alt_string)); ?>
        <div class="u-smalltext text-right"><?php echo str_replace(PHP_EOL, '', get_the_title(get_post_thumbnail_id()).' '.get_post(get_post_thumbnail_id())->post_content); ?></div>
      </div>
      <?php the_content(); ?>
    </div>
    <footer>
      <div class="grid">
        <div class="grid-sizer"></div>
          <?php $images = get_field('exhibition_images'); if($images): ?>
            <?php foreach($images as $image): ?>
              <?php $gallery_string = str_replace(PHP_EOL, '', $image['title'].' '.$image['description']); ?>
              <div class="grid-item p-2">
                <div class="l-gallery-item">
                  <a href="<?php echo $image['sizes']['large']; ?>" data-fancybox="gallery-images" data-caption="<?php echo $gallery_string; ?>">
                    <img class="img-fluid" src="<?php echo $image['sizes']['medium'];?>" />
                    <div class="l-gallery-item--text u-smalltext mx-auto">
                      <?php echo $gallery_string; ?>
                    </div>
                  </a>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif;?>
      </div>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
  </article>
<?php endwhile; ?>
