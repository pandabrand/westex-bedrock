<article <?php post_class('my-4'); ?>>
  <div class="entry-summary">
    <div class="c-link h3">
      <?php if(get_field('publication_link')): ?>
        <a href="<?php the_field('publication_link'); ?>"><?php the_title(); ?></a>
      <?php else: ?>
        <?php the_title(); ?>
      <?php endif; ?>
    </div>
    <div class="">
      <div><?php the_field('article_description'); ?></div>
      <div class="u-smalltext"><?php the_field('author_names'); ?>, <?php the_field('article_date'); ?></div>
    </div>
  </div>
</article>
