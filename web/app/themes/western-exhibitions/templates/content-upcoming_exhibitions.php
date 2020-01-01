<?php
  $today = date('Ymd');
  $args = array(
    'post_type' => ['exhibition'],
    'meta_query' => array(
      'relation' => 'AND',
      'display_start_date_clause' => array(
        'key' => 'display_start_date',
        'compare' => '>',
        'value' => $today,
      ),
      array(
        'relation' => 'OR',
        array(
          'key' => 'off-site_exhibition',
          'compare' => 'EXISTS',
          'value' => ''
        ),
        array(
          'key' => 'off-site_exhibition',
          'compare' => '==',
          'value' => '0',
        )
      ),
      'gallery_location_clause' => array(
        'key' => 'gallery_location',
        'compare' => 'EXISTS',
      )
    ),
    'orderby' => array('display_start_date' => 'ASC','gallery_location_clause' => 'ASC')
  );
  $wp_query = new WP_Query($args);
  ?>
    <div class="container">
      <div class="row">
        <div class="col-md-6 pl-0">
          <div class="h2 mb-4 u-label-font">Upcoming Exhibitions On-Site</div>
          <?php while (have_posts()) : the_post(); ?>
            <div class="l-front-gallery_row jsExhibitonLink" data-url="<?php the_permalink(); ?>" data-title="<?php the_title(); ?>">
              <div class="c-front-gallery_smalltype u-label-font"><?php
                    $location = get_the_terms( get_the_ID(), 'location');
                    $term = array_pop($location);
                    echo 'In ', $term->name;
                  ?>
              </div>
              <?php $artists = get_field('artists'); $switch_title = get_field('switch_titleartist_order'); ?>
              <?php if($switch_title): ?>
                <?php $show_title = get_field('display_exhibition_title'); if($show_title): ?>
                  <div class="emphasis h3"><?php the_title(); ?></div>
                <?php endif; ?>
                <div class="d-flex flex-wrap mt-2">
                  <?php
                    if($artists):
                      foreach ($artists as $artist):
                        echo '<div class="strong pr-2">',$artist->post_title,'</div>';
                      endforeach;
                    endif;

                    if(have_rows('artist_non-roster')):
                      while(have_rows('artist_non-roster')): the_row();
                        echo '<div class="strong pr-2">',the_sub_field('artist_non-roster_name'),'</div>';
                      endwhile;
                    endif;
                  ?>
                </div>
              <?php else: ?>
                <div class="d-flex flex-wrap mt-2">
                  <?php
                    if($artists):
                      foreach ($artists as $artist):
                        echo '<div class="h3 pr-2">',$artist->post_title,'</div>';
                      endforeach;
                    endif;

                    if(have_rows('artist_non-roster')):
                      while(have_rows('artist_non-roster')): the_row();
                        echo '<div class="h3 pr-2">',the_sub_field('artist_non-roster_name'),'</div>';
                      endwhile;
                    endif;
                  ?>
                </div>
                <?php $show_title = get_field('display_exhibition_title'); if($show_title): ?>
                  <div class="emphasis strong"><?php the_title(); ?></div>
                <?php endif; ?>
              <?php endif; ?>
              <div class="c-front-gallery_smalltype u-label-font"><?php the_field('start_date'); ?> - <?php the_field('end_date'); ?></div>
              <?php $today = date('Ymd'); if(get_field('opening_reception') > $today): ?>
                <div class="c-front-gallery_smalltype u-label-font">Opening Reception <?php the_field('opening_reception'); ?></div>
              <?php endif; ?>
              <div>
                <?php if ( has_post_thumbnail() ) : ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php the_post_thumbnail('medium',array('class' => 'img-fluid')); ?>
                    </a>
                <?php endif; ?>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      <?php wp_reset_query(); ?>
      <?php
        $today = date('Ymd');
        $args = array(
          'post_type' =>  ['post'],
          'category_name' => 'off-site-exhibition',
          'posts_per_page' => 20,
          'meta_query' => array(
            'relation' => 'AND',
            array(
              'relation' => 'OR',
              array(
                'key' => 'web_display_start_date',
                'compare' => '>=',
                'value' => $today,
              ),
              array(
                'key' => 'web_display_end_date',
                'compare' => '>=',
                'value' => $today,
              ),
            ),
            'artist_sort_clause' => array(
              'key' => 'artist',
              'compare' => 'EXISTS',
            ),
            'web_display_start_date_clause' => array(
              'key' => 'web_display_start_date',
              'compare' => 'EXISTS',
            )
          ),
          'orderby' => array('artist_sort_clause' => 'ASC','web_display_start_date_clause' => 'ASC')
        );
        $wp_query = new WP_Query($args);
        ?>
        <div class="col-md-6 pr-0">
          <div class="h2 mb-4 u-label-font">Current and Upcoming Exhibitions Off-Site</div>
          <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
            <div class="l-front-gallery_row jsExhibitonLink" data-url="<?php the_field('location_url'); ?>" data-title="<?php the_title(); ?>">
              <?php $artists = get_field('artist'); ?>
              <div class="h3 mt-2">
                <a href="<?php the_field('location_url'); ?>" target="_blank" rel="external" title="<?php the_title(); ?>">
                  <?php
                    if($artists):
                      foreach ($artists as $artist):
                        echo '<div>',$artist->post_title,'</div>';
                      endforeach;
                    endif;

                    if(have_rows('artist_non-roster')):
                      while(have_rows('artist_non-roster')): the_row();
                        the_sub_field('artist_non-roster_name');
                      endwhile;
                    endif;
                  ?>
                </a>
              </div>
              <div class="strong emphasis"><?php the_title(); ?></div>
              <div class="news-name"><?php the_field('location_name'); ?></div>
              <div class="news-location"><?php the_field('location_address'); ?></div>
              <div class="c-front-gallery_smalltype u-label-font">
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
              <div>
                <?php if ( has_post_thumbnail() ) : ?>
                    <a href="<?php the_field('location_url'); ?>" title="<?php the_title_attribute(); ?>">
                        <?php the_post_thumbnail('medium',array('class' => 'img-fluid')); ?>
                    </a>
                <?php endif; ?>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
    <?php wp_reset_query(); ?>
