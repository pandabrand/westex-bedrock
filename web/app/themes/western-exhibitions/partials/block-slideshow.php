<div class="container westex-vr-slideshow">
  <div class="row justify-content-center">
    <div class="col-sm-12">
      <div id="westex-slide" class="carousel slide" data-interval="false">
        <div class="carousel-inner">
          <?php foreach( $images as $idx => $image ): ?>
            <?php $active_class = $idx == 0 ? ' active' : ''; ?>
            <div class="carousel-item<?php echo $active_class; ?>">
              <?php echo wp_get_attachment_image( $image['image'], $slideshow_size, false, $slideshow_image_class ); ?>
              <?php if( isset( $image['image_caption'] ) && !empty( $image['image_caption'] ) ): ?>
                <div class="carousel-caption d-none d-md-block">
                  <p><?php echo $image['image_caption']; ?></p>
                </div>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
        <a href="#westex-slide" class="carousel-control carousel-control-prev" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a href="#westex-slide" class="carousel-control carousel-control-next" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
</div>
