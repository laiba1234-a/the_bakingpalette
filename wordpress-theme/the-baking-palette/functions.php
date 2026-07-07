<?php
/**
 * The Baking Palette theme setup.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function tbp_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 58,
		'width'       => 58,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'the-baking-palette' ),
	) );
}
add_action( 'after_setup_theme', 'tbp_setup' );

function tbp_assets() {
	wp_enqueue_style(
		'tbp-google-fonts',
		'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'tbp-style',
		get_template_directory_uri() . '/css/style.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_script(
		'tbp-main',
		get_template_directory_uri() . '/js/main.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'tbp_assets' );

/**
 * Fallback menu output if no "primary" menu has been created yet in
 * Appearance -> Menus, so the header never renders empty.
 */
function tbp_fallback_menu() {
	$pages = array(
		'Home'         => home_url( '/' ),
		'Gallery'      => home_url( '/gallery/' ),
		'Menu & Pricing' => home_url( '/menu/' ),
		'Testimonials' => home_url( '/testimonials/' ),
		'About'        => home_url( '/about/' ),
	);
	echo '<ul class="nav-links-list">';
	foreach ( $pages as $label => $url ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}
