  <!-- Footer -->
  <footer class="site-footer">
    <div class="container">
      <div class="footer-grid">
        <div>
          <div class="footer-logo" style="display:flex;align-items:center;gap:12px;">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo/logo.jpg" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> logo" style="height:48px;width:48px;object-fit:cover;border-radius:50%;">
            <?php bloginfo( 'name' ); ?>
          </div>
          <p style="font-size:0.9rem;color:rgba(255,255,255,0.65);max-width:280px;">Custom premium cakes and cupcakes for birthdays, weddings, and every celebration in Sialkot.</p>
          <div class="footer-social">
            <a href="https://www.instagram.com/the_bakingpalette/" target="_blank" rel="noopener" aria-label="Instagram">📷</a>
          </div>
        </div>
        <div class="footer-col">
          <h4>Explore</h4>
          <ul>
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
            <li><a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>">Gallery</a></li>
            <li><a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>">Menu &amp; Pricing</a></li>
            <li><a href="<?php echo esc_url( home_url( '/testimonials/' ) ); ?>">Testimonials</a></li>
            <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Occasions</h4>
          <ul>
            <li><a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>">Birthday Cakes</a></li>
            <li><a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>">Wedding Cakes</a></li>
            <li><a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>">Cupcakes</a></li>
            <li><a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>">Custom Themes</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Find Us</h4>
          <ul>
            <li><a href="https://maps.app.goo.gl/SYh3LS19zjtz57ar5" target="_blank" rel="noopener">📍 Sialkot, Pakistan</a></li>
            <li><a href="https://www.instagram.com/the_bakingpalette/" target="_blank" rel="noopener">@the_bakingpalette</a></li>
            <li><a href="https://wa.me/923289480799" target="_blank" rel="noopener">💬 WhatsApp 0328 9480799</a></li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <span>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</span>
        <span>Made with 🎂 in Sialkot</span>
      </div>
    </div>
  </footer>

  <?php wp_footer(); ?>
</body>
</html>
