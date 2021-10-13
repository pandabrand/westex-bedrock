<?php if ('artist' == get_post_type()) : ?>
  <div class="c-sidebar-links u-label-font">
    <?php $file = get_field('cv_file'); if ($file) : ?>
      <div class="c-sidebar-link">
        <a href="<?php echo $file['url']; ?>" target="_blank">CV Bio</a>
      </div>
    <?php endif; ?>
      <div>
        <a href="/press/?artist_filter=<?php echo get_the_id(); ?>">Press</a>
      </div>
      <div>
        <a href="/previous-exhibitions/?artist_filter=<?php echo get_the_id(); ?>">Exhibitions</a>
      </div>
  </div>
<?php endif; ?>
<?php if ('press' == get_post_type() || is_page_template('template-previous_exhibitions.php')) : ?>
  <div class="c-sidebar-links u-label-font">
    <div class="c-sidebar-link">
        <?php
          $meta_query_val = get_query_var('artist_filter');
        if ($meta_query_val) {
            $artist_title = get_the_title($meta_query_val);
            $artist_link = get_permalink($meta_query_val);
            echo 'Back to <a href="'.$artist_link.'">'.$artist_title.'</a>';
        }
        ?>
    </div>
  </div>
<?php endif; ?>
<?php dynamic_sidebar('sidebar-primary'); ?>
