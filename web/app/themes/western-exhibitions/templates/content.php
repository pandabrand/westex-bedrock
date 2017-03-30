<article <?php post_class(); ?>>
  <?php
    $artists = get_field('artist');
    $artist_name = '';
    if($artists) {
      foreach($artists as $artist) {
        $artist_name .= $artist->post_title.' ';
      }
    }
  ?>
  <header>
    <h2 class="entry-title u-titlecase"><a href="<?php the_permalink(); ?>"><?php echo $artist_name,get_the_title(); ?></a></h2>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
</article>
