<div class="col-md-4 col-sm-6 col-xs-12 u-extra-v-margin">
  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
    <div>
      <?php if ( has_post_thumbnail() ) : ?>
        <?php the_post_thumbnail('medium',array('class' => 'd-flex img-fluid mx-auto')); ?>
      <?php endif; ?>
      <div class="p-1">
        <div class="h4 text-center"><?php the_title(); ?></div>
      </div>
    </div>
  </a>
</div>
