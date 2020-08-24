<div class="container westex-vr-two-column-image">
  <div class="row<?php echo $tc_class; ?>">
    <div class="col-sm-12 col-md-6">
      <?php echo wp_get_attachment_image( $image_one, $tc_image_size, false, $tc_classes );?>
    </div>
    <div class="col-sm-12 col-md-6">
      <?php echo wp_get_attachment_image( $image_two, $tc_image_size, false, $tc_classes );?>
    </div>
  </div>
</div>
