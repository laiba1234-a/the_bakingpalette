<?php
/**
 * Generic fallback template for any Page that isn't Home, Gallery, Menu,
 * Testimonials, or About (those use their own page-{slug}.php template).
 */
get_header();
?>

  <section class="page-header">
    <div class="container">
      <h1 class="section-title"><?php the_title(); ?></h1>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <?php
      if ( have_posts() ) :
        while ( have_posts() ) :
          the_post();
          the_content();
        endwhile;
      endif;
      ?>
    </div>
  </section>

<?php get_footer(); ?>
