<?php
    $artist_array = get_field( 'artist', get_the_ID() );
    $start_date = get_field( 'start_date', get_the_ID() );
    $end_date = get_field( 'end_date', get_the_ID() );
?>
<div class="col-md-4 col-sm-6 col-xs-12 u-extra-v-margin">
  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
    <div>
      <?php if ( has_post_thumbnail() ) : ?>
        <?php the_post_thumbnail('medium',array('class' => 'd-flex img-fluid mx-auto')); ?>
      <?php endif; ?>
      <div class="p-1 text-center">
        <div class="h4"><?php the_title(); ?></div>
        <div class="strong pr-2"><?php echo $artist_array[0]->post_title; ?></div>
        <div class="c-front-gallery_h1 emphasis"><?php echo $in_depth_post->post_title; ?></div>
        <div class="c-front-gallery_smalltype u-label-font"><?php echo $start_date, ' - ', $end_date; ?></div>
      </div>
    </div>
  </a>
</div>
