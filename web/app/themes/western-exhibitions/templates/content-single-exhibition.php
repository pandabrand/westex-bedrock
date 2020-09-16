<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class('pb-5'); ?>>
    <header>
      <?php $artists = get_field('artists'); $switch_title = get_field('switch_titleartist_order'); $show_title = get_field('display_exhibition_title'); ?>
      <?php if($switch_title): ?>
        <?php if($show_title): ?>
          <div class="emphasis h1"><?php the_title(); ?></div>
        <?php endif; ?>
        <div class="d-flex flex-wrap">
          <?php
            if($artists):
              foreach ($artists as $artist):
                echo '<div class="pr-2 h3">','<a href="', get_permalink($artist->ID), '">', $artist->post_title, '</a>', '</div>';
              endforeach;
            endif;

            if(have_rows('artist_non-roster')):
              while(have_rows('artist_non-roster')): the_row();
                echo '<div class="pr-2 h3">',the_sub_field('artist_non-roster_name'),'</div>';
              endwhile;
            endif;
          ?>
        </div>
      <?php else: ?>
        <div class="d-flex flex-wrap">
          <?php
            if($artists):
              foreach ($artists as $artist):
                echo '<div class="pr-2 h1">','<a href="', get_permalink($artist->ID), '">', $artist->post_title, '</a>', '</div>';
              endforeach;
            endif;

            if(have_rows('artist_non-roster')):
              while(have_rows('artist_non-roster')): the_row();
                echo '<div class="pr-2 h1">',the_sub_field('artist_non-roster_name'),'</div>';
              endwhile;
            endif;
          ?>
        </div>
        <?php if($show_title): ?>
          <div class="emphasis h3"><?php the_title(); ?></div>
        <?php endif; ?>
      <?php endif; ?>
    </header>
    <div class="entry-content">
      <div class="u-smalltext u-extra-v-margin u-label-font">
        <?php the_field('start_date'); ?> - <?php the_field('end_date'); ?><br/>
        <?php
          if(get_field('off-site_exhibition') == 0) {
            $location = get_the_terms( get_the_ID(), 'location');
            $term = array_pop($location);
            echo 'In ', $term->name;
          }
        ?>
      </div>
      <div class="l-exhibition-featured-image mb-5">
        <?php $alt_string = str_replace(PHP_EOL, '', get_the_title(get_post_thumbnail_id()).' '.get_post(get_post_thumbnail_id())->post_content); ?>
        <?php the_post_thumbnail('full', array('class' => 'img-fluid', 'alt' => $alt_string)); ?>
        <div class="u-smalltext u-caption text-right"><?php echo str_replace(PHP_EOL, '', get_the_title(get_post_thumbnail_id()).' '.get_post(get_post_thumbnail_id())->post_content); ?></div>
      </div>
      <?php if(get_field('off-site_exhibition') == 1): ?>
        <div>
          <?php if(get_field('off-site_url')): ?>
            <a href="<?php get_field('off-site_url'); ?>" target="_blank">
              <?php the_field('off-site_details'); ?>
            </a>
          <?php else: ?>
            <?php if(get_field('off-site_details')): ?>
              <?php the_field('off-site_details'); ?>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      <?php endif; ?>
      <?php the_content(); ?>
    </div>
    <footer>
      <div class="grid">
        <div class="grid-sizer"></div>
          <?php $images = get_field('exhibition_images'); if($images): ?>
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
