<div class="container westex-vr-title<?php echo $narrow_class ? ' narrow' : ''; ?>">
  <div class="row justify-content-md-start justify-content-sm-center">
    <div class="col-sm-10">
      <h1><?php echo $title; ?></h1>
      <?php if( $artist ): ?>
        <div class="link">
          <a href="<?php echo get_permalink( $artist[0]->ID ); ?>"><?php echo $artist[0]->post_title; ?></a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
