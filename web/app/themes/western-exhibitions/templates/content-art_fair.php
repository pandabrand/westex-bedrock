<div class="d-flex flex-column">
  <div class="h2"><a href="<?php echo the_permalink(); ?>" rel="follow"><?php the_title(); ?></a></div>
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
  <div class="mb-2">
    <?php
      $location = get_field('location');
      echo $location['address'];
    ?>
  </div>
  <?php
    $booth = get_field('booth');
    if( $booth ):
  ?>
    <div class="mb-2 c-front-gallery_smalltype u-label-font">
      <?php echo $booth; ?>
    </div>
  <?php endif; ?>
</div>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
