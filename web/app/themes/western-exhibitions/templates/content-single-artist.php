<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <div class="entry-title h1"><?php the_title(); ?></div>
      <?php
        $born_details = have_rows('born_details');
        if($born_details):
      ?>
        <div class="u-smalltext u-extra-v-margin">
          <?php while(have_rows($born_details)): the_row(); ?>
            <div><?php the_sub_field('born_detail'); ?></div>
            <div><?php the_sub_field('work_detail')?></div>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </header>
    <div class="l-exhibition-featured-image mb-5">
      <?php $alt_string = str_replace(PHP_EOL, '', get_the_title(get_post_thumbnail_id()).' '.get_post(get_post_thumbnail_id())->post_content); ?>
      <?php the_post_thumbnail('full', array('class' => 'img-fluid', 'alt' => $alt_string)); ?>
      <div class="u-smalltext u-caption text-right"><?php echo str_replace(PHP_EOL, '', get_the_title(get_post_thumbnail_id()).' '.get_post(get_post_thumbnail_id())->post_content); ?></div>
    </div>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <footer>
      <?php if(have_rows('artist_images')): ?>
        <?php while(have_rows('artist_images')): the_row(); ?>
          <div class="l-gallery">
            <div class="l-gallery-title"><?php the_sub_field('artist_images_title'); ?></div>
            <div class="l-gallery-images">
              <?php $images = get_sub_field('artist_image_collection'); ?>
              <?php if($images): ?>
                <div class="grid">
                  <div class="grid-sizer"></div>
                  <?php
                    foreach($images as $image):
                      include(locate_template('templates/we-fancybox.php', false , false));
                    endforeach;
                  ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
  </article>
<?php endwhile; ?>
