<?php
/**
 * Template Name: Viewing Room
 */
?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'viewing-room'); ?>
<?php endwhile; ?>
