<?php
/**
 * Template Name: About
 * (Auto-selected for the Page whose slug is "about".)
 *
 * The three story paragraphs below come from the Page content, so they can
 * be edited from wp-admin (Pages -> About -> Edit) without touching this file.
 */
get_header();
?>

  <section class="page-header">
    <div class="container">
      <span class="section-label">Our Story</span>
      <h1 class="section-title">About The Baking Palette</h1>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="about-grid">
        <div class="reveal">
          <div class="placeholder-tile" style="padding:0;border:none;">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/gallery/birthday-black-drip.jpg" alt="Black drip cake towers handcrafted by The Baking Palette" style="width:100%;height:100%;object-fit:cover;border-radius:inherit;">
          </div>
        </div>
        <div class="about-content reveal">
          <h2>Baking Celebrations, One Cake at a Time</h2>
          <?php
          if ( have_posts() ) :
            while ( have_posts() ) :
              the_post();
              the_content();
            endwhile;
          else :
            ?>
            <p>The Baking Palette is a custom cake studio based in Sialkot, Pakistan, creating premium customized cakes and cupcakes for birthdays, weddings, and every celebration in between.</p>
            <p>Every order starts with a conversation on Instagram &mdash; tell us your event, your theme, and your flavor, and we design a cake around it. Orders are made fresh to order, so we ask for a 2&ndash;3 day pre-order window to make sure every detail is right.</p>
            <p>Once it's ready, choose pickup or delivery &mdash; either way, your cake arrives fresh and ready for your special day.</p>
            <?php
          endif;
          ?>

          <div class="values-grid">
            <div class="value-item">
              <div class="icon">🎨</div>
              <h4>Custom Design</h4>
              <p>Every cake built around your vision</p>
            </div>
            <div class="value-item">
              <div class="icon">🌿</div>
              <h4>Premium Quality</h4>
              <p>Only the best ingredients used</p>
            </div>
            <div class="value-item">
              <div class="icon">❤️</div>
              <h4>Made with Care</h4>
              <p>Every order handled personally</p>
            </div>
            <div class="value-item">
              <div class="icon">⏰</div>
              <h4>On-Time Delivery</h4>
              <p>Ready for your special day</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="cta-banner reveal">
    <h2>Let's Bake Something Special</h2>
    <p>Reach out and let's start designing your custom cake.</p>
    <a href="https://www.instagram.com/the_bakingpalette/" target="_blank" rel="noopener" class="btn btn--light">Message Us on Instagram</a>
  </section>

<?php get_footer(); ?>
