<div class="container westex-vr-iamge">
  <div class="row justify-content-center">
    <div class="col-sm-12">
      <div class="image-container d-flex justify-content-center align-items-center">
      <figure>
        <?php echo wp_get_attachment_image( $image, $tc_image_size, false, $tc_classes );?>
        <?php if( $image_caption ): ?>
          <figcaption><?php echo $image_caption; ?></figcaption>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
