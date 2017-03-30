<?php
/**
 * Template Name: Previous Exhibitions
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'previous_exhibitions'); ?>
<?php endwhile; ?>
