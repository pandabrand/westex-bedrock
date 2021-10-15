<div class="container westex-vr-media<?php echo $narrow_class ? ' narrow' : ''; ?>">
  <div class="row justify-content-center">
    <div class="col-sm-12">
      <div class="embed-container">
        <?php echo $media; ?>
      </div>
      <?php if( $media_caption ): ?>
        <div class="caption">
          <?php echo $media_caption; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
