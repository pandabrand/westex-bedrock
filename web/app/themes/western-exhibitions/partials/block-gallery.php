<div class="container westex-vr-slideshow<?php echo $narrow_class ? ' narrow' : ''; ?>">
  <div class="row justify-content-center">
    <div class="col-sm-12">
      <div class="grid">
        <div class="grid-sizer"></div>
          <?php foreach( $gallery_images as $idx => $image ): ?>
            <?php $gallery_string = htmlentities(str_replace(PHP_EOL, ' ', $image['title'].' '.$image['description']), ENT_QUOTES); ?>
            <div class="grid-item p-2">
                <div class="l-gallery-item">
                <?php
                    $image_url;
                    if($image['type'] == 'video'):
                      $image_url =  $image['url'];
                    else:
                      $image_url = $image['sizes']['large'];
                    endif;
                  ?>
                  <a href="<?php echo $image_url; ?>" data-fancybox="gallery-images" data-caption="<?php echo $gallery_string; ?>"  class="we-fancybox-anchor">
                    <img class="img-fluid" src="<?php echo $image['sizes']['large'];?>" />
                    <div class="l-gallery-item--text u-smalltext u-caption mx-auto">
                      <?php echo $image['title']; ?>
                    </div>
                    <label class="we-fancybox-label">
                      <span class="we-fancybox-title emphasis"><?php echo $image['title']; ?></span>
                      <span class="we-fancybox-caption"><?php echo $image['description']; ?></span>
                    </label>
                  </a>
                </div>
            </div>
          <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
