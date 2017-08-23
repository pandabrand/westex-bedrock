<article <?php post_class('my-4'); ?>>
  <?php
    $artists = get_field('artist');
    $artist_name = '';
    if($artists) {
      $artist_names = array_map(function($artist) { return ucwords(strtolower($artist->post_title)); }, $artists);
      $artist_count = count($artist_names);
      if($artist_count > 2) {
        $last_artist_name = array_pop($artist_names);
        $artist_name = implode(', ',$artist_names);
        $artist_name .= ' and '.$last_artist_name;
      } else {
        $artist_name = implode(' and ', $artist_names);
      }
    }
    $title_tags = '';
    if(get_the_tags()) {
      $tag_names = array_map(function($this_tag) { return $this_tag->name; }, get_the_tags());
      $title_tags = implode(', ', $tag_names);
    }
  ?>
  <header>
    <div class="h3 entry-title">
      <?php $location_url = get_field('location_url'); ?>
      <?php if($location_url): ?>
        <a href="<?php echo $location_url; ?>" target="_blank">
      <?php endif; ?>
        <span><?php echo $artist_name," "; ?> </span><br/>
        <span class="emphasis"><?php echo get_the_title(); ?></span>
        <span><?php echo " ", $title_tags; ?></span>
        <?php if($location_url): ?>
        </a>
        <?php endif; ?>
    </div>
  </header>
  <div class="entry-summary pl-4">
    <div class="news-title"><?php the_field('location_name'); ?></div>
    <div class="news-address"><?php the_field('location_address'); ?></div>
    <div class="news-date">
      <?php
        if(get_field('start_date')):
          $date = new DateTime(get_field('start_date'));
          echo $date->format('F j, Y');
        endif;
      ?>
      <?php echo (get_field('end_date')) ? ' - ' : '' ?>
      <?php
        if(get_field('end_date')):
          $date = new DateTime(get_field('end_date'));
          echo $date->format('F j, Y');
        endif;
      ?>
    </div>
    <?php
      $press = get_field('pressreviews');
      if(have_rows('pressreviews')):
    ?>
      <div class="d-flex flex-wrap news-pressreviews">
    <?php
      while(have_rows('pressreviews')): the_row();
        $press_url = get_sub_field('press_url');
        if($press_url):
    ?>
      <div class="p-2"><a href="<?php echo $press_url; ?>" target="_blank"><?php the_sub_field('press_title'); ?></a></div>
    <?php else: ?>
      <div class="p-2"><?php the_sub_field('press_title'); ?></div>
    <?php
        endif;
      endwhile;
    ?>
      </div>
    <?php endif; ?>
    <div class="news-content">
      <?php the_content(); ?>
    </div>
  </div>
</article>
