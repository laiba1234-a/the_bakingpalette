<?php get_header(); ?>

  <!-- Hero -->
  <section class="hero">
    <div class="container">
      <div class="hero-text">
        <span class="hero-eyebrow">Sialkot's Custom Cake Studio</span>
        <h1>Cakes made to <span class="script">celebrate</span> your story</h1>
        <p>Handcrafted premium cakes and cupcakes, custom-designed for birthdays, weddings, and every milestone worth celebrating.</p>
        <div class="hero-actions">
          <a href="https://www.instagram.com/the_bakingpalette/" target="_blank" rel="noopener" class="btn btn--primary">Order via Instagram DM</a>
          <a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="btn btn--outline">View Gallery</a>
        </div>
        <div class="hero-stats">
          <div>
            <strong>100%</strong>
            <span>Custom Designs</span>
          </div>
          <div>
            <strong>1200+</strong>
            <span>Instagram Followers</span>
          </div>
          <div>
            <strong>On Time</strong>
            <span>Event Delivery</span>
          </div>
        </div>
      </div>
      <div class="hero-visual">
        <div class="placeholder-tile" style="padding:0;border:none;">
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/gallery/wedding-floral-tiered.jpg" alt="Three-tier white floral wedding cake by The Baking Palette" style="width:100%;height:100%;object-fit:cover;border-radius:inherit;">
        </div>
        <div class="floating-card">
          <div class="icon-badge">✨</div>
          <div>
            <strong>Made Fresh</strong>
            <span>For every order</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Highlights -->
  <section class="section">
    <div class="container">
      <div class="section-header reveal">
        <span class="section-label">Why Choose Us</span>
        <h2 class="section-title">Premium Cakes, Personally Crafted</h2>
        <p class="section-subtitle" style="margin-left:auto;margin-right:auto;">Every cake is designed around your event, your theme, and your taste &mdash; not a catalogue.</p>
      </div>
      <div class="highlights-grid">
        <div class="highlight-card reveal">
          <div class="icon">🎨</div>
          <h3>Fully Customized</h3>
          <p>Choose your flavor, filling, and design &mdash; each cake is built from scratch for your event.</p>
        </div>
        <div class="highlight-card reveal">
          <div class="icon">💍</div>
          <h3>Events &amp; Weddings</h3>
          <p>From intimate birthdays to full wedding cake setups, we design for every occasion.</p>
        </div>
        <div class="highlight-card reveal">
          <div class="icon">🌿</div>
          <h3>Premium Ingredients</h3>
          <p>Only quality ingredients go into every bake, so it looks as good as it tastes.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Gallery preview -->
  <section class="section section--tight" style="background:var(--color-white);">
    <div class="container">
      <div class="section-header reveal">
        <span class="section-label">Our Creations</span>
        <h2 class="section-title">A Peek Into Our Gallery</h2>
      </div>
      <div class="gallery-grid gallery-grid--home">
        <div class="gallery-item reveal">
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/gallery/birthday-heart-pink-floral.jpg" alt="Heart-shaped pink and yellow floral birthday cake">
        </div>
        <div class="gallery-item reveal">
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/gallery/wedding-tiered-rings.jpg" alt="Two-tier ivory wedding cake with rose gold ring topper">
        </div>
        <div class="gallery-item reveal">
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/gallery/themed-eid-cookies.jpg" alt="Box of pink and gold Eid-themed cookies and mini cupcakes">
        </div>
        <div class="gallery-item reveal">
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/gallery/themed-sunflower-bouquet.jpg" alt="Cake designed as a sunflower bouquet">
        </div>
      </div>
      <div style="text-align:center;margin-top:44px;">
        <a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="btn btn--outline">See Full Gallery</a>
      </div>
    </div>
  </section>

  <!-- Process -->
  <section class="section">
    <div class="container">
      <div class="section-header reveal">
        <span class="section-label">How It Works</span>
        <h2 class="section-title">From Idea to Celebration</h2>
      </div>
      <div class="process-grid">
        <div class="process-step reveal">
          <div class="step-number">1</div>
          <h4>Send Us a DM</h4>
          <p>Message us on Instagram with your event date and vision.</p>
        </div>
        <div class="process-step reveal">
          <div class="step-number">2</div>
          <h4>Design &amp; Quote</h4>
          <p>We share design options, flavors, and pricing for your cake.</p>
        </div>
        <div class="process-step reveal">
          <div class="step-number">3</div>
          <h4>We Bake</h4>
          <p>Your cake is handcrafted fresh, close to your event date.</p>
        </div>
        <div class="process-step reveal">
          <div class="step-number">4</div>
          <h4>Pickup / Delivery</h4>
          <p>Collect your cake or have it delivered, ready to celebrate.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Banner -->
  <section class="cta-banner reveal">
    <h2>Planning an Event?</h2>
    <p>Let's design a cake that matches your celebration perfectly. Reach out and tell us your vision.</p>
    <a href="https://www.instagram.com/the_bakingpalette/" target="_blank" rel="noopener" class="btn btn--light">Message Us on Instagram</a>
  </section>

<?php get_footer(); ?>
