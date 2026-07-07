<?php
/**
 * Required fallback template (WordPress mandates an index.php in every theme).
 * Everything on this site is a Page with its own template, so this only
 * renders if something is requested outside that (e.g. a post or search result).
 */
get_header();
?>

  <section class="section">
    <div class="container">
      <?php
      if ( have_posts() ) :
        while ( have_posts() ) :
          the_post();
          ?>
          <article <?php post_class(); ?>>
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
          </article>
          <?php
        endwhile;
      else :
        ?>
        <p>Nothing found.</p>
        <?php
      endif;
      ?>
    </div>
  </section>

<?php get_footer(); ?>
