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
      <p class="section-subtitle" style="margin:0 auto;">A custom cake studio in Sialkot, known for two-tier and multi-tier cakes designed around your event, theme and colors.</p>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="about-grid">
        <div class="reveal">
          <div class="placeholder-tile" style="padding:0;border:none;">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/gallery/tiered-vintage-pastel-three-tier.webp" alt="Three-tier vintage buttercream cake with pastel piped swags and flowers by The Baking Palette" style="width:100%;height:100%;object-fit:cover;border-radius:inherit;">
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
            <p>Tiered cakes are what we are known for. Two-tier and three-tier designs for weddings, walima, nikkah and engagements, vintage piped buttercream with pastel swags and flowers, floral and pearl finishes, and tall milestone birthday cakes &mdash; each one built around the theme, colors and flowers of your event rather than picked off a catalogue.</p>
            <p>Alongside tiered cakes we bake themed and character birthday cakes, heart and number cakes, welcome baby and baby shower cakes, graduation and congratulations cakes, Eid and festive dessert boxes, cupcake boxes and fondant-decorated butter cookies.</p>
            <p>Every order starts with a conversation on Instagram or WhatsApp &mdash; tell us your event, your theme, and your flavor, and we design a cake around it. Orders are made fresh to order, so we ask for a 2&ndash;3 day pre-order window &mdash; 5 days for larger orders &mdash; to make sure every detail is right. Urgent orders are welcome whenever a slot is available.</p>
            <p>Once it's ready, choose pickup or delivery within Sialkot &mdash; either way, your cake arrives fresh and ready for your special day.</p>
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
              <div class="icon">🍫</div>
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

  <section class="section section--tight" style="background:var(--color-white);">
    <div class="container">
      <div class="section-header reveal">
        <span class="section-label">What We Make</span>
        <h2 class="section-title">Cakes, Cupcakes &amp; Treats</h2>
        <p class="section-subtitle" style="margin-left:auto;margin-right:auto;">Everything is baked to order in Sialkot, with fresh cream or buttercream and your choice of flavor.</p>
      </div>
      <div class="highlights-grid">
        <div class="highlight-card reveal">
          <div class="icon">👰</div>
          <h3>Tiered &amp; Wedding Cakes</h3>
          <p>Two-tier and three-tier cakes for weddings, walima, nikkah and engagements &mdash; piped buttercream, florals, pearls, monograms and custom toppers. <a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>">See the gallery</a>.</p>
        </div>
        <div class="highlight-card reveal">
          <div class="icon">🎂</div>
          <h3>Birthday &amp; Themed Cakes</h3>
          <p>Character and cartoon themes, heart cakes, number cakes, first birthdays, welcome baby, graduation and congratulations cakes. <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>">See flavors and pricing</a>.</p>
        </div>
        <div class="highlight-card reveal">
          <div class="icon">🧁</div>
          <h3>Cupcakes &amp; Cookies</h3>
          <p>Cupcake boxes of 6, 9 or 12 and fondant-decorated butter cookies &mdash; ideal for Eid, giveaways, favors and dessert tables. <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>">See the menu</a>.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="cta-banner reveal">
    <h2>Let's Bake Something Special</h2>
    <p>Reach out and let's start designing your custom cake &mdash; on Instagram or WhatsApp.</p>
    <div class="cta-actions">
      <a href="https://www.instagram.com/the_bakingpalette/" target="_blank" rel="noopener" class="btn btn--light">Message Us on Instagram</a>
      <a href="https://wa.me/923289480799" target="_blank" rel="noopener" class="btn btn--light">WhatsApp 0328 9480799</a>
    </div>
  </section>

<?php get_footer(); ?>
