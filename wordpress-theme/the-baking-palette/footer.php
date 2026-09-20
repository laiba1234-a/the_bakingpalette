  <!-- Footer -->

  </main>

  <footer class="site-footer">
    <div class="container">
      <div class="footer-grid">
        <div>
          <div class="footer-logo" style="display:flex;align-items:center;gap:12px;">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo/logo.jpg" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> logo" style="height:48px;width:48px;object-fit:cover;border-radius:50%;">
            <?php bloginfo( 'name' ); ?>
          </div>
          <p style="font-size:0.9rem;color:rgba(255,255,255,0.65);max-width:280px;">Custom premium cakes and cupcakes for birthdays, weddings, and every celebration in Sialkot.</p>
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
            <li><a href="https://www.instagram.com/the_bakingpalette/" target="_blank" rel="noopener"><span class="link-icon"><svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><rect x="3" y="3" width="18" height="18" rx="5.2" fill="none" stroke="currentColor" stroke-width="1.9"/><circle cx="12" cy="12" r="4.1" fill="none" stroke="currentColor" stroke-width="1.9"/><circle cx="17.3" cy="6.7" r="1.25" fill="currentColor"/></svg></span>@the_bakingpalette</a></li>
            <li><a href="https://wa.me/923289480799" target="_blank" rel="noopener"><span class="link-icon"><svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M12.04 2.01c-5.46 0-9.91 4.44-9.91 9.9 0 1.75.46 3.45 1.33 4.96L2 22.01l5.28-1.38a9.9 9.9 0 0 0 4.76 1.21h.01c5.46 0 9.9-4.44 9.9-9.9a9.83 9.83 0 0 0-2.9-7A9.82 9.82 0 0 0 12.04 2Zm0 18.14h-.01a8.22 8.22 0 0 1-4.19-1.15l-.3-.18-3.11.82.83-3.04-.2-.31a8.2 8.2 0 0 1-1.26-4.38c0-4.53 3.7-8.22 8.25-8.22 2.2 0 4.27.86 5.82 2.41a8.16 8.16 0 0 1 2.41 5.82c0 4.54-3.69 8.23-8.24 8.23Zm4.52-6.16c-.25-.12-1.46-.72-1.69-.8-.22-.09-.39-.13-.55.12-.17.25-.64.8-.78.97-.15.16-.29.18-.54.06-.25-.12-1.05-.39-1.99-1.23-.74-.66-1.23-1.47-1.38-1.72-.14-.25-.01-.38.11-.5.11-.11.25-.29.37-.43.12-.15.16-.25.25-.41.08-.17.04-.31-.02-.43-.06-.13-.55-1.34-.76-1.83-.2-.48-.4-.42-.55-.43h-.47c-.17 0-.43.06-.66.31-.22.25-.86.84-.86 2.03 0 1.19.88 2.34 1 2.5.12.17 1.72 2.62 4.16 3.67.58.25 1.03.4 1.38.51.58.19 1.11.16 1.53.1.46-.07 1.46-.6 1.67-1.18.2-.58.2-1.07.14-1.18-.06-.1-.22-.17-.47-.29Z"/></svg></span>WhatsApp 0328 9480799</a></li>
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
