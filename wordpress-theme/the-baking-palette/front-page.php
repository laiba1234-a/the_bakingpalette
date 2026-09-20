<?php get_header(); ?>

  <!-- Hero -->
  <section class="hero">
    <div class="container">
      <div class="hero-text">
        <span class="hero-eyebrow">Sialkot's Custom &amp; Tiered Cake Studio</span>
        <h1>Cakes made to <span class="script">celebrate</span> your story</h1>
        <p>Premium two-tier and multi-tier cakes, wedding and engagement cakes, themed birthday cakes and cupcakes &mdash; handcrafted in Sialkot and designed around your event, theme and colors.</p>
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
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/gallery/wedding-three-tier-ivory-floral.jpg" alt="Three-tier ivory wedding cake with piped blossoms and fresh roses" style="width:100%;height:100%;object-fit:cover;border-radius:inherit;">
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
        <p class="section-subtitle" style="margin-left:auto;margin-right:auto;">Every cake is designed around your event, your theme, and your taste &mdash; not a catalogue. From single-tier birthday cakes to three-tier wedding centrepieces, each one is baked to order in Sialkot.</p>
      </div>
      <div class="highlights-grid">
        <div class="highlight-card reveal">
          <div class="icon">🎨</div>
          <h3>Fully Customized</h3>
          <p>Choose your flavor, filling, and design &mdash; each cake is built from scratch for your event.</p>
        </div>
        <div class="highlight-card reveal">
          <div class="icon">💍</div>
          <h3>Two-Tier &amp; Multi-Tier Cakes</h3>
          <p>Tiered cakes are our speciality &mdash; two and three-tier designs for weddings, walima, nikkah, engagements and milestone birthdays, finished in piped buttercream, florals or pearls.</p>
        </div>
        <div class="highlight-card reveal">
          <div class="icon">🍫</div>
          <h3>Premium Ingredients</h3>
          <p>Only quality ingredients go into every bake, so it looks as good as it tastes.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Occasions -->
  <section class="section" style="background:var(--color-white);">
    <div class="container">
      <div class="section-header reveal">
        <span class="section-label">Occasions We Bake For</span>
        <h2 class="section-title">Cakes for Every Event</h2>
        <p class="section-subtitle" style="margin-left:auto;margin-right:auto;">Weddings, engagements, birthdays, baby celebrations and festive orders &mdash; tiered or single-tier, every cake is customised for the occasion.</p>
      </div>
      <div class="occasion-grid">
        <article class="occasion-card reveal">
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/gallery/tiered-vintage-pastel-three-tier.jpg" alt="Three-tier vintage buttercream cake with pastel piped swags and flowers" loading="lazy">
          <div class="occasion-body">
            <h3>Wedding &amp; Walima Cakes</h3>
            <p>Two and three-tier wedding cakes in ivory, blush or maroon, dressed with piped pearls, roses and fresh florals.</p>
          </div>
        </article>
        <article class="occasion-card reveal">
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/gallery/wedding-two-tier-veil-portrait.jpg" alt="Two-tier wedding cake with a fondant veil drape, hand-painted couple portrait and name topper" loading="lazy">
          <div class="occasion-body">
            <h3>Engagement &amp; Nikkah</h3>
            <p>Ring toppers, monograms, hand-painted portraits and name plaques for the day the story starts.</p>
          </div>
        </article>
        <article class="occasion-card reveal">
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/gallery/tiered-sun-daisy-first-birthday.jpg" alt="Two-tier first birthday cake with daisies, pearls and a fondant sun topper" loading="lazy">
          <div class="occasion-body">
            <h3>Birthdays &amp; First Birthdays</h3>
            <p>Heart cakes, number cakes, character themes and tiered first-birthday cakes built around the party theme.</p>
          </div>
        </article>
        <article class="occasion-card reveal">
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/gallery/themed-welcome-baby-girl-teddy.jpg" alt="Pink welcome baby cake with a fondant teddy bear, ladder and name blocks" loading="lazy">
          <div class="occasion-body">
            <h3>Baby Showers &amp; Welcome Baby</h3>
            <p>Soft pastel cakes with fondant teddies, blocks and name toppers to welcome the newest arrival.</p>
          </div>
        </article>
        <article class="occasion-card reveal">
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/gallery/themed-eid-dessert-box.jpg" alt="Eid dessert box of decorated cookies and mini cupcakes in pink and gold" loading="lazy">
          <div class="occasion-body">
            <h3>Eid &amp; Festive Boxes</h3>
            <p>Dessert boxes of cupcakes and fondant-decorated cookies, perfect for gifting and giveaways.</p>
          </div>
        </article>
        <article class="occasion-card reveal">
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/gallery/themed-graduation-sunflower.jpg" alt="Graduation cake with sunflowers and a fondant graduation cap" loading="lazy">
          <div class="occasion-body">
            <h3>Graduation &amp; Congratulations</h3>
            <p>Celebration cakes for results, promotions and farewells &mdash; finished with florals, caps and custom messages.</p>
          </div>
        </article>
      </div>
    </div>
  </section>

  <!-- Gallery preview -->
  <section class="section section--tight">
    <div class="container">
      <div class="section-header reveal">
        <span class="section-label">Our Creations</span>
        <h2 class="section-title">A Peek Into Our Gallery</h2>
        <p class="section-subtitle" style="margin-left:auto;margin-right:auto;">A few of the tiered and premium cakes we have handcrafted for our customers in Sialkot.</p>
      </div>
      <div class="gallery-grid gallery-grid--home">
        <div class="gallery-item reveal">
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/gallery/wedding-two-tier-pearls-roses.jpg" alt="Two-tier white wedding cake with piped pearls, white roses and baby's breath" loading="lazy">
        </div>
        <div class="gallery-item reveal">
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/gallery/tiered-vintage-pink-bows.jpg" alt="Two-tier pink vintage cake with piped roses, bows and lace detailing" loading="lazy">
        </div>
        <div class="gallery-item reveal">
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/gallery/wedding-two-tier-rings-monogram.jpg" alt="Two-tier engagement cake with monogram and ring topper" loading="lazy">
        </div>
        <div class="gallery-item reveal">
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/gallery/wedding-two-tier-maroon-roses.jpg" alt="Two-tier maroon and cream cake with piped roses" loading="lazy">
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

  <!-- FAQ -->
  <section class="section" style="background:var(--color-white);">
    <div class="container">
      <div class="section-header reveal">
        <span class="section-label">Good to Know</span>
        <h2 class="section-title">Frequently Asked Questions</h2>
      </div>
      <div class="faq-list">
        <details class="faq-item reveal">
          <summary>Do you make two-tier and multi-tier cakes?</summary>
          <p>Yes &mdash; tiered cakes are one of our specialities. We make two-tier and three-tier cakes for weddings, walima, nikkah and engagements, vintage piped buttercream designs, and tall birthday cakes. Tiered cakes are quoted on request, based on the number of tiers, the total weight and the design.</p>
        </details>
        <details class="faq-item reveal">
          <summary>How much does a custom cake cost in Sialkot?</summary>
          <p>Customised cakes start at Rs. 1,800 per pound with fresh cream and Rs. 2,000 per pound with buttercream, from a 1.5 lb minimum. Premium flavors such as Lotus, Nutella or KitKat carry an extra charge per pound, and tiered or sculpted cakes are quoted on request. See the <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>">full menu and pricing</a>.</p>
        </details>
        <details class="faq-item reveal">
          <summary>How far in advance should I order a cake?</summary>
          <p>Standard orders need 2 to 3 days' notice, and larger or tiered orders about 5 days. Urgent orders are welcome whenever a slot is available. A 50% advance payment confirms the booking.</p>
        </details>
        <details class="faq-item reveal">
          <summary>How do I place an order?</summary>
          <p>Message us on Instagram at <a href="https://www.instagram.com/the_bakingpalette/" target="_blank" rel="noopener">@the_bakingpalette</a> or on WhatsApp at <a href="https://wa.me/923289480799" target="_blank" rel="noopener">0328 9480799</a> with your event date, theme, flavor and serving size. We reply with design options, flavors and a quote.</p>
        </details>
        <details class="faq-item reveal">
          <summary>Do you deliver cakes?</summary>
          <p>We deliver within Sialkot only, and pickup is always available. We do not deliver to other cities.</p>
        </details>
        <details class="faq-item reveal">
          <summary>What cake flavors do you offer?</summary>
          <p>Best-sellers include Chocolate Fudge, Vanilla Caramel, Pineapple and Vanilla, and Vanilla with Strawberry. Premium flavors include KitKat, Lotus, Cadbury, Nutty Snickers, Nutella and Red Velvet. Cupcake boxes and fondant decorated butter cookies are also available.</p>
        </details>
      </div>
    </div>
  </section>

  <!-- CTA Banner -->
  <section class="cta-banner reveal">
    <h2>Planning an Event?</h2>
    <p>Let's design a cake that matches your celebration perfectly. Tell us your date, theme and flavor &mdash; on Instagram or WhatsApp.</p>
    <div class="cta-actions">
      <a href="https://www.instagram.com/the_bakingpalette/" target="_blank" rel="noopener" class="btn btn--light">Message Us on Instagram</a>
      <a href="https://wa.me/923289480799" target="_blank" rel="noopener" class="btn btn--light">WhatsApp 0328 9480799</a>
    </div>
  </section>

<?php get_footer(); ?>
