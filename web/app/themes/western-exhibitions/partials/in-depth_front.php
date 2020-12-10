<?php
$today = date('YMD');
$args = array(
  'numberofposts' => 1,
  'post_type' => 'in-depth',
  'meta_query' => array(
    array(
      'key' => 'start_date',
      'compare' => '<=',
      'value' => $today,
    ),
    array(
      'key' => 'end_date',
      'compare' => '>=',
      'value' => $today,
    ),
  ),
);
$ind_posts = get_posts( $args );

if( $ind_posts && is_array( $ind_posts ) ):
  $in_depth_post = $ind_posts[0];
  if( $in_depth_post ):
    $artist_array = get_field( 'artist', $in_depth_post->ID );
    $start_date = get_field( 'start_date', $in_depth_post->ID );
    $end_date = get_field( 'end_date', $in_depth_post->ID );
    ?>
      <div class="col-md-6 mb-md-5">
        <div class="jsExhibitionLink" data-url="<?php echo get_permalink( $in_depth_post->ID ); ?>" data-title="<?php echo get_the_title( $in_depth_post->ID ); ?>">
          <div class="c-front-gallery_smalltype u-label-font">Online Only: In Depth With...</div>
          <div class="strong pr-2"><?php echo $artist_array[0]->post_title; ?></div>
          <div class="c-front-gallery_h1 emphasis"><?php echo $in_depth_post->post_title; ?></div>
          <div class="c-front-gallery_smalltype u-extra-v-margin u-label-font"><?php echo $start_date, ' - ', $end_date; ?></div>
        </div>
      </div>
      <div class="col-md-6 mb-md-5">
        <?php if( has_post_thumbnail( $in_depth_post->ID ) ): ?>
          <a href="<?php echo get_permalink( $in_depth_post->ID); ?>">
            <?php echo get_the_post_thumbnail( $in_depth_post->ID, 'large', array( 'class' => 'img-fluid' ) ); ?>
          </a>
        <?php endif; ?>
      </div>
  <?php endif;
endif;
