<?php use Roots\Sage\Titles; ?>

<div class="page-header">
  <h1><?= Titles\title(); ?></h1>
  <?php if('press' == get_post_type()): ?>
    <?php
      $meta_query_val = get_query_var('artist_press');
      if($meta_query_val) {
        $artist_post = get_page_by_title($meta_query_val, OBJECT, 'artist');
        $artist_title = $artist_post->post_title;
      } else {
        $artist_title = 'Western Exhibitions';
      }
    ?>
    <div class="h3"><?php echo $artist_title; ?></div>
  <?php endif; ?>
</div>
