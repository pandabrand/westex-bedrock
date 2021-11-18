<?php
$tc_class = $placement == 1 ? ' flex-row' : ' flex-row-reverse';
?>

<div class="container westex-vr-two-column<?php echo $narrow_class ? ' narrow' : ''; ?>">
  <div class="row<?php echo $tc_class; ?>">
    <div class="col-sm-12 col-md-6">
      <figure>
        <?php echo wp_get_attachment_image( $image, $tc_image_size, false, $tc_classes );?>
        <?php if( $image_caption ): ?>
          <figcaption><?php echo $image_caption; ?></figcaption>
        <?php endif; ?>
      </figure>
    </div>
    <div class="col-sm-12 col-md-6 d-flex align-items-center justify-content-center">
      <?php echo $body; ?>
    </div>
  </div>
</div>
