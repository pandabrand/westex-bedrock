<div class="container westex-vr-two-column-image">
  <div class="row">
    <div class="col-sm-12 col-md-6">
      <figure>
        <?php echo wp_get_attachment_image( $image_one, $tc_image_size, false, $tc_classes );?>
        <?php if( $image_one_caption ): ?>
          <figcaption><?php echo $image_one_caption; ?></figcaption>
        <?php endif; ?>
      </figure>
    </div>
    <div class="col-sm-12 col-md-6">
      <figure>
        <?php echo wp_get_attachment_image( $image_two, $tc_image_size, false, $tc_classes );?>
        <?php if( $image_two_caption ): ?>
          <figcaption><?php echo $image_two_caption; ?></figcaption>
        <?php endif; ?>
      </figure>
    </div>
  </div>
</div>
