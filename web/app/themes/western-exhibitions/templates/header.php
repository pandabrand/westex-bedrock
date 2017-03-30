<header>
  <div class="container">
    <nav class="navbar navbar-toggleable-md navbar-light l-main-navbar">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#bs4navbar" aria-controls="bs4navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="brand" href="<?= esc_url(home_url('/')); ?>"><img src="<?php echo get_template_directory_uri() . '/dist/images/wx_logo2.jpg'; ?>" /></a>
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu([
          'theme_location' => 'primary_navigation',
          'menu_class' => 'nav navbar-nav',
          'walker' => new bs4navwalker(),
          'container' => 'div',
          'container_id' => 'bs4navbar',
          'container_class' => 'collapse navbar-collapse',
          'menu_id' => false,
          'menu_class' => 'navbar-nav mr-auto l-main-nav'
        ]);
      endif;
      ?>
    </nav>
  </div>
</header>
