<?php
/**
 * 404 page. Without this, a mistyped URL falls through to index.php and
 * renders a bare post list instead of pointing the visitor back at the cakes.
 */
get_header();
?>

  <section class="page-header">
    <div class="container">
      <span class="section-label">Page Not Found</span>
      <h1 class="section-title">This page has been eaten</h1>
      <p class="section-subtitle" style="margin:0 auto;">The link you followed doesn&rsquo;t exist &mdash; but the cakes certainly do. Try one of these instead.</p>
    </div>
  </section>

  <section class="section">
    <div class="container" style="text-align:center;">
      <div class="nav-cta" style="justify-content:center;gap:14px;flex-wrap:wrap;">
        <a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="btn btn--primary">View the Gallery</a>
        <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="btn btn--outline">Menu &amp; Pricing</a>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--outline">Back to Home</a>
      </div>
    </div>
  </section>

  <section class="cta-banner reveal">
    <h2>Looking for something specific?</h2>
    <p>Message us with your event date and design idea &mdash; we&rsquo;ll take it from there.</p>
    <a href="https://www.instagram.com/the_bakingpalette/" target="_blank" rel="noopener" class="btn btn--light">Message Us on Instagram</a>
  </section>

<?php get_footer(); ?>
