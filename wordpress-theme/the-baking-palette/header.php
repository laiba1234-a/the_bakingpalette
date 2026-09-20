<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <a class="skip-link" href="#main">Skip to content</a>

  <!-- Navbar -->
  <header class="navbar">
    <div class="container">
      <?php if ( has_custom_logo() ) : ?>
        <div class="logo"><?php the_custom_logo(); ?></div>
      <?php else : ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo/logo.jpg" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> logo">
        </a>
      <?php endif; ?>
      <nav class="nav-links">
        <?php
        if ( has_nav_menu( 'primary' ) ) {
          wp_nav_menu( array(
            'theme_location' => 'primary',
            'container'      => false,
            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'menu_class'     => 'nav-links-list',
          ) );
        } else {
          tbp_fallback_menu();
        }
        ?>
      </nav>
      <div class="nav-cta">
        <a href="https://www.instagram.com/the_bakingpalette/" target="_blank" rel="noopener" class="btn btn--primary">
          <span class="btn-text">Order via</span> Instagram DM
        </a>
        <button class="nav-toggle" aria-label="Toggle navigation">
          <span></span><span></span><span></span>
        </button>
      </div>
    </div>
  </header>

  <main id="main">
