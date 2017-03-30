<?php if('artist' == get_post_type()): ?>
  <div class="c-sidebar-links">
    <?php $file = get_field('cv_file'); if($file): ?>
      <div class="c-sidebar-link">
        <a href="<?php echo $file['url']; ?>" target="_blank">CV Bio</a>
      </div>
    <? endif; ?>
      <div>
        <a href="/press/?artist_press=<?php the_title(); ?>">Press</a>
      </div>
  </div>
<?php endif; ?>
<?php if('press' == get_post_type()): ?>
  <div class="c-sidebar-links">
    <div class="c-sidebar-link">
      <?php if('press' == get_post_type()): ?>
        <?php
          $meta_query_val = get_query_var('artist_press');
          if($meta_query_val) {
            $artist_post = get_page_by_title($meta_query_val, OBJECT, 'artist');
            $artist_title = $artist_post->post_title;
            $artist_link = get_permalink($artist_post->ID);
          } else {
            $artist_title = 'Home';
            $artist_link = '/';
          }
        ?>
        Back to <a href="<?php echo $artist_link; ?>"><?php echo $artist_title ?></a>
      <?php endif; ?>
    </div>
  </div>
<?php endif; ?>
<?php dynamic_sidebar('sidebar-primary'); ?>
