<?php
/**
 * Template Name: Gallery
 * (Auto-selected for the Page whose slug is "gallery".)
 */
get_header();
$img = get_template_directory_uri() . '/images/gallery/';
?>

  <section class="page-header">
    <div class="container">
      <span class="section-label">Our Creations</span>
      <h1 class="section-title">Cake Gallery</h1>
      <p class="section-subtitle" style="margin:0 auto;">Every cake below was designed and baked for a real celebration in Sialkot &mdash; two-tier and multi-tier cakes, weddings and engagements, birthdays, baby celebrations and themed designs.</p>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="gallery-filters reveal">
        <button class="filter-btn active" data-filter="all">All</button>
        <button class="filter-btn" data-filter="birthday">Birthday</button>
        <button class="filter-btn" data-filter="wedding">Wedding</button>
        <button class="filter-btn" data-filter="tiered">Tiered</button>
        <button class="filter-btn" data-filter="cupcakes">Cupcakes</button>
        <button class="filter-btn" data-filter="themed">Themed</button>
      </div>

      <div class="gallery-grid">
        <?php
        $cakes = get_posts( array(
          'post_type'      => 'tbp_cake',
          'posts_per_page' => -1,
          'orderby'        => 'menu_order',
          'order'          => 'ASC',
        ) );

        foreach ( $cakes as $cake ) :
          $categories = get_post_meta( $cake->ID, '_tbp_categories', true );
          $alt        = get_post_meta( $cake->ID, '_tbp_alt', true );
          ?>
          <a class="gallery-item reveal" href="<?php echo esc_url( get_permalink( $cake ) ); ?>" data-category="<?php echo esc_attr( $categories ); ?>">
            <img src="<?php echo esc_url( tbp_cake_image_url( $cake->ID ) ); ?>" alt="<?php echo esc_attr( $alt ? $alt : get_the_title( $cake ) ); ?>" loading="lazy">
            <span class="gallery-item-label"><?php echo esc_html( get_the_title( $cake ) ); ?></span>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="cta-banner reveal">
    <h2>Love What You See?</h2>
    <p>Send us your favorite design and we'll bring it to life for your event &mdash; on Instagram or WhatsApp.</p>
    <div class="cta-actions">
      <a href="https://www.instagram.com/the_bakingpalette/" target="_blank" rel="noopener" class="btn btn--light">Message Us on Instagram</a>
      <a href="https://wa.me/923289480799" target="_blank" rel="noopener" class="btn btn--light">WhatsApp 0328 9480799</a>
    </div>
  </section>

  <div class="lightbox">
    <button class="lightbox-close" aria-label="Close">&times;</button>
    <div class="lightbox-content"></div>
  </div>

<?php get_footer(); ?>
