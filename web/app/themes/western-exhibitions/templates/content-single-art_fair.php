<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class('pb-5'); ?>>
    <header>
      <div class="emphasis h1"><?php the_title(); ?></div>
    </header>
    <div class="entry-content">
      <div class="u-smalltext u-label-font">
        <?php
          $start_date = get_field('start_date');
          $end_date = get_field('end_date');
          echo $start_date;
          if( $end_date ):
            echo ' – ', $end_date;
          endif;
        ?>
      </div>
      <div class="">
        <?php
          $location = get_field('location');
          echo $location['address'];
        ?>
      </div>
      <div class="d-flex flex-wrap">
        <?php
          $artists = get_field('western_exhibitions_artists');
          if($artists):
            foreach ($artists as $artist):
              echo '<div class="pr-2 c-front-gallery_smalltype ">',get_the_title( $artist ),'</div>';
            endforeach;
          endif;

          if(have_rows('artists_non-roster')):
            while(have_rows('artists_non-roster')): the_row();
              echo '<div class="pr-2 c-front-gallery_smalltype ">',the_sub_field('artist_non-roster_name'),'</div>';
            endwhile;
          endif;
        ?>
      </div>
      <?php
        $booth = get_field('booth');
        if( $booth ):
      ?>
        <div class="my-2 c-front-gallery_smalltype u-label-font">
          <?php echo $booth; ?>
        </div>
      <?php endif; ?>
      <div class="l-exhibition-featured-image mb-5">
        <?php $alt_string = str_replace(PHP_EOL, '', get_the_title(get_post_thumbnail_id()).' '.get_post(get_post_thumbnail_id())->post_content); ?>
        <?php the_post_thumbnail('full', array('class' => 'img-fluid', 'alt' => $alt_string)); ?>
        <div class="u-smalltext u-caption text-right"><?php echo str_replace(PHP_EOL, '', get_the_title(get_post_thumbnail_id()).' '.get_post(get_post_thumbnail_id())->post_content); ?></div>
      </div>
      <?php the_content(); ?>
    </div>
    <footer>
      <div class="grid">
        <div class="grid-sizer"></div>
          <?php $images = get_field('art_fair_gallery'); if($images): ?>
            <?php foreach($images as $image): ?>
              <?php $gallery_string = htmlentities(str_replace(PHP_EOL, ' ', $image['title'].' '.$image['description']), ENT_QUOTES); ?>
              <div class="grid-item p-2">
                <div class="l-gallery-item">
                  <?php
                    $image_url;
                    if($image['type'] == 'video'):
                      $image_url =  $image['url'];
                    else:
                      $image_url = $image['sizes']['large'];
                    endif;
                  ?>
                  <a href="<?php echo $image_url; ?>" data-fancybox="gallery-images" data-caption="<?php echo $gallery_string; ?>"  class="we-fancybox-anchor">
                    <img class="img-fluid" src="<?php echo $image['sizes']['large'];?>" />
                    <div class="l-gallery-item--text u-smalltext u-caption mx-auto">
                      <?php echo $image['title']; ?>
                    </div>
                    <label class="we-fancybox-label">
                      <span class="we-fancybox-title emphasis"><?php echo $image['title']; ?></span>
                      <span class="we-fancybox-caption"><?php echo $image['description']; ?></span>
                    </label>
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
