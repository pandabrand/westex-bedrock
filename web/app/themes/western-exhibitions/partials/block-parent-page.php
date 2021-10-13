<div class="container westex-vr-parent-page">
  <div class="row">
    <div class="col-sm-12">
      <h2><a href="<?php echo $child_page_link; ?>"><?php echo $title; ?></a></h2>
    </div>
    <div class="col-sm-12 col-md-6">
      <figure>
        <?php echo wp_get_attachment_image($image, $tc_image_size, false, $tc_classes);?>
        <?php if ($image_caption) : ?>
          <figcaption><?php echo $image_caption; ?></figcaption>
        <?php endif; ?>
      </figure>
    </div>
    <div class="col-sm-12 col-md-6">
      <?php echo $introduction_text; ?>
    </div>
  </div>
</div>
