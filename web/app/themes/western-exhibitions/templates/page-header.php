<?php use Roots\Sage\Titles; ?>

<div class="page-header">
  <div class="h1"><?= Titles\title(); ?></div>
  <?php if('press' == get_post_type() || is_page_template('template-previous_exhibitions.php')): ?>
    <?php
      $meta_query_val = get_query_var('artist_filter');
      if($meta_query_val) {
        $artist_title = get_the_title($meta_query_val);
        echo '<div class="h3">'.$artist_title.'</div>';
      }
    ?>
  <?php endif; ?>
</div>
