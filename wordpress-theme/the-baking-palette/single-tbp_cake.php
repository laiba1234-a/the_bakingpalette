<?php
/**
 * One cake. Photo, the story of the design, the spec table, and a way to order
 * the same thing.
 */
get_header();

while ( have_posts() ) :
	the_post();

	$image      = tbp_cake_image_url( get_the_ID() );
	$alt        = get_post_meta( get_the_ID(), '_tbp_alt', true );
	$categories = array_filter( explode( ' ', (string) get_post_meta( get_the_ID(), '_tbp_categories', true ) ) );
	$details    = array();

	foreach ( tbp_cake_detail_fields() as $key => $label ) {
		$value = get_post_meta( get_the_ID(), '_tbp_' . $key, true );
		if ( $value ) {
			$details[ $label ] = $value;
		}
	}
	?>

  <section class="section cake-single">
    <div class="container">
      <nav class="cake-breadcrumb" aria-label="Breadcrumb">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
        <span aria-hidden="true">&rsaquo;</span>
        <a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>">Gallery</a>
        <span aria-hidden="true">&rsaquo;</span>
        <span aria-current="page"><?php the_title(); ?></span>
      </nav>

      <div class="cake-layout">
        <div class="cake-photo reveal">
          <?php if ( $image ) : ?>
            <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $alt ? $alt : get_the_title() ); ?>" width="1200" height="1600">
          <?php endif; ?>
        </div>

        <div class="cake-info reveal">
          <span class="section-label">
            <?php echo esc_html( $categories ? ucfirst( $categories[0] ) . ' Cake' : 'Custom Cake' ); ?>
          </span>
          <h1 class="section-title"><?php the_title(); ?></h1>

          <div class="cake-description"><?php the_content(); ?></div>

          <?php if ( $details ) : ?>
            <dl class="cake-details">
              <?php foreach ( $details as $label => $value ) : ?>
                <div>
                  <dt><?php echo esc_html( $label ); ?></dt>
                  <dd><?php echo esc_html( $value ); ?></dd>
                </div>
              <?php endforeach; ?>
            </dl>
          <?php endif; ?>

          <p class="cake-note">Every cake is made to order, so this design can be remade in your colors, flavor and size. Prices follow our <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>">per-pound pricing</a>.</p>

          <?php $order_message = 'Hi! I would like to order a cake like "' . get_the_title() . '" from your gallery: ' . get_permalink(); ?>
          <div class="cake-actions">
            <a href="https://wa.me/923289480799?text=<?php echo rawurlencode( $order_message ); ?>" target="_blank" rel="noopener" class="btn btn--primary">Order via WhatsApp</a>
            <?php // Instagram has no public prefilled-message link like wa.me, so JS copies this cake's name and link to the clipboard on click and the customer pastes it into the DM. ?>
            <a href="https://ig.me/m/the_bakingpalette" target="_blank" rel="noopener" class="btn btn--primary" data-copy-text="<?php echo esc_attr( $order_message ); ?>">Order via Instagram DM</a>
            <a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="btn btn--outline">Back to Gallery</a>
          </div>
        </div>
      </div>

      <?php
      $related = get_posts( array(
        'post_type'      => 'tbp_cake',
        'posts_per_page' => 3,
        'post__not_in'   => array( get_the_ID() ),
        'orderby'        => 'rand',
        'meta_query'     => $categories ? array(
          array(
            'key'     => '_tbp_categories',
            'value'   => $categories[0],
            'compare' => 'LIKE',
          ),
        ) : array(),
      ) );

      if ( $related ) :
        ?>
        <div class="cake-related">
          <h2 class="section-title">More Like This</h2>
          <div class="gallery-grid">
            <?php foreach ( $related as $cake ) : ?>
              <a class="gallery-item reveal" href="<?php echo esc_url( get_permalink( $cake ) ); ?>">
                <img src="<?php echo esc_url( tbp_cake_image_url( $cake->ID ) ); ?>" alt="<?php echo esc_attr( get_post_meta( $cake->ID, '_tbp_alt', true ) ); ?>" loading="lazy">
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>

	<?php
endwhile;

get_footer();
