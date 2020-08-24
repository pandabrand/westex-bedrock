<?php
$tc_class = $placement == 1 ? ' flex-row' : ' flex-row-reverse';
write_log($tc_classes);
?>

<div class="container westex-vr-two-column">
  <div class="row<?php echo $tc_class; ?>">
    <div class="col-sm-12 col-md-6">
      <?php echo wp_get_attachment_image( $image, $tc_image_size, false, $tc_classes );?>
    </div>
    <div class="col-sm-12 col-md-6">
      <?php echo $body; ?>
    </div>
  </div>
</div>
