<div class="col-md-4 u-extra-v-margin">
  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
    <div class="card">
      <?php if ( has_post_thumbnail() ) : ?>
        <?php the_post_thumbnail('medium',array('class' => 'img-fluid card-img-top artist-thumbnail')); ?>
      <?php endif; ?>
      <div class="card-block">
        <h4 class="card-title text-center"><?php the_title(); ?></h4>
      </div>
    </div>
  </a>
</div>
