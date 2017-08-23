<?php
/**
 * Template Name: Upcoming Exhibitions
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'upcoming_exhibitions'); ?>
<?php endwhile; ?>
