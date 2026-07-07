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
      <p class="section-subtitle" style="margin:0 auto;">Every cake below was made for a real celebration &mdash; browse by occasion or see everything.</p>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="gallery-filters reveal">
        <button class="filter-btn active" data-filter="all">All</button>
        <button class="filter-btn" data-filter="birthday">Birthday</button>
        <button class="filter-btn" data-filter="wedding">Wedding</button>
        <button class="filter-btn" data-filter="cupcakes">Cupcakes</button>
        <button class="filter-btn" data-filter="themed">Themed</button>
      </div>

      <div class="gallery-grid">
        <div class="gallery-item reveal" data-category="wedding">
          <img src="<?php echo esc_url( $img ); ?>wedding-tiered-rings.jpg" alt="Two-tier ivory wedding cake with rose gold ring topper">
        </div>
        <div class="gallery-item reveal" data-category="birthday">
          <img src="<?php echo esc_url( $img ); ?>birthday-teddy-candle.jpg" alt="Birthday cake with a lit candle and floral piping">
        </div>
        <div class="gallery-item reveal" data-category="cupcakes">
          <img src="<?php echo esc_url( $img ); ?>themed-eid-cookies.jpg" alt="Box of pink and gold Eid-themed cookies and mini cupcakes">
        </div>
        <div class="gallery-item reveal" data-category="wedding">
          <img src="<?php echo esc_url( $img ); ?>wedding-floral-tiered.jpg" alt="Three-tier white floral wedding cake">
        </div>
        <div class="gallery-item reveal" data-category="birthday">
          <img src="<?php echo esc_url( $img ); ?>birthday-black-drip.jpg" alt="Black drip cake towers with happy birthday message">
        </div>
        <div class="gallery-item reveal" data-category="themed">
          <img src="<?php echo esc_url( $img ); ?>themed-sunflower-bouquet.jpg" alt="Cake designed as a sunflower bouquet">
        </div>
        <div class="gallery-item reveal" data-category="birthday">
          <img src="<?php echo esc_url( $img ); ?>birthday-red-velvet-ribbon.jpg" alt="Dark red velvet cake with black ribbon detailing">
        </div>
        <div class="gallery-item reveal" data-category="birthday">
          <img src="<?php echo esc_url( $img ); ?>birthday-floral-candles.jpg" alt="White birthday cake with fresh flowers and lit candles">
        </div>
        <div class="gallery-item reveal" data-category="birthday">
          <img src="<?php echo esc_url( $img ); ?>birthday-heart-pink-floral.jpg" alt="Heart-shaped pink and yellow floral birthday cake">
        </div>
        <div class="gallery-item reveal" data-category="birthday">
          <img src="<?php echo esc_url( $img ); ?>birthday-heart-red-candle.jpg" alt="Heart-shaped cake with red piping and a lit candle">
        </div>
      </div>
    </div>
  </section>

  <section class="cta-banner reveal">
    <h2>Love What You See?</h2>
    <p>Send us your favorite design and we'll bring it to life for your event.</p>
    <a href="https://www.instagram.com/the_bakingpalette/" target="_blank" rel="noopener" class="btn btn--light">Message Us on Instagram</a>
  </section>

  <div class="lightbox">
    <button class="lightbox-close" aria-label="Close">&times;</button>
    <div class="lightbox-content"></div>
  </div>

<?php get_footer(); ?>
