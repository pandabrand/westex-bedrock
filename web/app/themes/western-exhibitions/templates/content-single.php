<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <?php
      $artists = get_field('artist');
      $artist_name = '';
      if($artists):
        foreach($artists as $artist):
          $artist_name .= $artist->post_title.' ';
        endforeach;
      endif;
    ?>
    <header>
      <div class="entry-title h3"><?php echo $artist_name,' ',get_the_title(); ?></div>
    </header>
    <div class="entry-content">
      <div class=""><?php the_field('location_name'); ?></div>
      <div class=""><?php the_field('location_address'); ?></div>
      <div class=""><?php the_field('start_date'); ?> <?php echo (get_field('end_date')) ? '- ' : '' ?> <?php the_field('end_date'); ?></div>
      <div class=""><a href="<?php echo get_field('location_url'); ?>" target="_blank">Link</a></div>
      <?php the_content(); ?>
    </div>
    <footer>
      <div class="">
      <?php
        $press = get_field('pressreviews');
        if(have_rows('pressreviews')):
          while(have_rows('pressreviews')): the_row();
            $press_url = get_sub_field('press_url');
            if($press_url):
      ?>
        <div><a href="<?php echo $press_url; ?>" target="_blank"><?php the_sub_field('press_title'); ?></a></div>
      <?php else: ?>
        <div><?php the_sub_field('press_title'); ?></div>
        <?php
            endif;
          endwhile;
        endif;
        ?>
      </div>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
  </article>
<?php endwhile; ?>
