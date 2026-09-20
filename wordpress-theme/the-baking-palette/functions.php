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

/**
 * Version assets by file modification time so edits reach visitors
 * who already have the old file cached.
 */
function tbp_asset_version( $relative_path ) {
	$file = get_template_directory() . $relative_path;

	return file_exists( $file ) ? (string) filemtime( $file ) : wp_get_theme()->get( 'Version' );
}

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
		tbp_asset_version( '/css/style.css' )
	);

	wp_enqueue_script(
		'tbp-main',
		get_template_directory_uri() . '/js/main.js',
		array(),
		tbp_asset_version( '/js/main.js' ),
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

/**
 * Keep the XML sitemap to the pages that matter. A five-page brochure site has
 * no author archives or categories worth crawling.
 */
function tbp_trim_sitemap( $provider, $name ) {
	if ( in_array( $name, array( 'users', 'taxonomies' ), true ) ) {
		return false;
	}

	return $provider;
}
add_filter( 'wp_sitemaps_add_provider', 'tbp_trim_sitemap', 10, 2 );

/**
 * SEO tags: meta description, Open Graph / Twitter cards and JSON-LD
 * structured data for search engines and AI answer engines.
 *
 * Skipped when a dedicated SEO plugin is active, so tags are never doubled.
 * Templates are covered one at a time as each page is updated.
 */
function tbp_seo_head() {
	if ( defined( 'WPSEO_VERSION' ) || class_exists( 'RankMath' ) || defined( 'AIOSEO_VERSION' ) ) {
		return;
	}

	if ( is_front_page() ) {
		tbp_seo_front_page();
	} elseif ( is_page( 'about' ) ) {
		tbp_seo_about_page();
	} elseif ( is_page( 'menu' ) ) {
		tbp_seo_menu_page();
	} elseif ( is_page( 'gallery' ) ) {
		tbp_seo_gallery_page();
	} elseif ( is_page( 'testimonials' ) ) {
		tbp_seo_testimonials_page();
	}
}
add_action( 'wp_head', 'tbp_seo_head', 5 );

/**
 * The search-result title for each page, used both for the <title> element
 * (via pre_get_document_title) and for the Open Graph / Twitter tags, so the
 * two can never drift apart.
 */
function tbp_seo_title() {
	if ( is_front_page() ) {
		return 'The Baking Palette | Custom Tiered, Wedding & Birthday Cakes in Sialkot';
	}
	if ( is_page( 'about' ) ) {
		return 'About Us | The Baking Palette — Custom Tiered Cake Studio in Sialkot';
	}
	if ( is_page( 'menu' ) ) {
		return 'Cake Menu & Prices in Sialkot | The Baking Palette';
	}
	if ( is_page( 'gallery' ) ) {
		return 'Cake Gallery | Tiered, Wedding & Birthday Cakes in Sialkot';
	}
	if ( is_page( 'testimonials' ) ) {
		return 'Customer Reviews | The Baking Palette, Sialkot';
	}

	return '';
}

/**
 * Use those titles for the <title> element. Without this WordPress falls back
 * to "<page name> – <site name>", which wastes the strongest on-page signal.
 */
function tbp_seo_document_title( $title ) {
	$seo_title = tbp_seo_title();

	return $seo_title ? $seo_title : $title;
}
add_filter( 'pre_get_document_title', 'tbp_seo_document_title' );

/**
 * Print the shared meta description, Open Graph and Twitter tags for a page.
 *
 * The canonical link is left to WordPress core (rel_canonical), so the page
 * carries exactly one.
 */
function tbp_seo_meta_tags( $title, $description, $social_desc, $url, $image ) {
	printf( '<meta name="description" content="%s" />' . "\n", esc_attr( $description ) );

	printf( '<meta property="og:type" content="website" />' . "\n" );
	printf( '<meta property="og:site_name" content="%s" />' . "\n", esc_attr( get_bloginfo( 'name' ) ) );
	printf( '<meta property="og:locale" content="en_PK" />' . "\n" );
	printf( '<meta property="og:title" content="%s" />' . "\n", esc_attr( $title ) );
	printf( '<meta property="og:description" content="%s" />' . "\n", esc_attr( $social_desc ) );
	printf( '<meta property="og:url" content="%s" />' . "\n", esc_url( $url ) );
	printf( '<meta property="og:image" content="%s" />' . "\n", esc_url( $image ) );
	printf( '<meta name="twitter:card" content="summary_large_image" />' . "\n" );
	printf( '<meta name="twitter:title" content="%s" />' . "\n", esc_attr( $title ) );
	printf( '<meta name="twitter:description" content="%s" />' . "\n", esc_attr( $social_desc ) );
	printf( '<meta name="twitter:image" content="%s" />' . "\n", esc_url( $image ) );
}

/**
 * Print one or more schema.org graphs as JSON-LD.
 */
function tbp_seo_print_schema( $schemas ) {
	foreach ( $schemas as $schema ) {
		echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
	}
}

/**
 * The Bakery entity every page points at, so the business is described once.
 */
function tbp_bakery_schema( $image = '' ) {
	$home      = home_url( '/' );
	$theme_uri = get_template_directory_uri();

	if ( ! $image ) {
		$image = $theme_uri . '/images/gallery/wedding-three-tier-ivory-floral.jpg';
	}

	return array(
		'@type'           => 'Bakery',
		'@id'             => $home . '#the-baking-palette',
		'name'            => 'The Baking Palette',
		'url'             => $home,
		'description'     => 'Custom cake studio in Sialkot specialising in two-tier and multi-tier cakes, wedding and engagement cakes, themed birthday cakes, cupcakes and fondant cookies.',
		'image'           => $image,
		'logo'            => $theme_uri . '/images/logo/logo.jpg',
		'telephone'       => '+92 328 9480799',
		'priceRange'      => 'Rs. 1,800 - Rs. 2,000 per lb',
		'servesCuisine'   => 'Cakes, cupcakes and desserts',
		'address'         => array(
			'@type'           => 'PostalAddress',
			'addressLocality' => 'Sialkot',
			'addressRegion'   => 'Punjab',
			'addressCountry'  => 'PK',
		),
		'areaServed'      => array(
			'@type' => 'City',
			'name'  => 'Sialkot',
		),
		'hasMap'          => 'https://maps.app.goo.gl/SYh3LS19zjtz57ar5',
		'sameAs'          => array(
			'https://www.instagram.com/the_bakingpalette/',
			'https://wa.me/923289480799',
		),
		'hasOfferCatalog' => array(
			'@type'           => 'OfferCatalog',
			'name'            => 'Custom cakes and treats',
			'itemListElement' => array_map(
				function ( $product ) {
					return array(
						'@type'       => 'Offer',
						'itemOffered' => array(
							'@type' => 'Product',
							'name'  => $product,
						),
					);
				},
				array(
					'Two-tier and multi-tier cakes',
					'Wedding and engagement cakes',
					'Custom birthday and themed cakes',
					'Cupcake boxes',
					'Fondant decorated cookies',
				)
			),
		),
	);
}

/**
 * About page: meta tags plus an AboutPage graph around the Bakery entity.
 */
function tbp_seo_about_page() {
	$theme_uri   = get_template_directory_uri();
	$image       = $theme_uri . '/images/gallery/tiered-vintage-pastel-three-tier.jpg';
	$title       = tbp_seo_title();
	$description = 'The Baking Palette is a custom cake studio in Sialkot, specialising in two-tier and multi-tier cakes for weddings, engagements and birthdays.';
	$social_desc = 'A custom cake studio in Sialkot specialising in two-tier and multi-tier cakes for weddings, engagements, birthdays and baby celebrations.';

	tbp_seo_meta_tags( $title, $description, $social_desc, get_permalink(), $image );

	$about = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'AboutPage',
		'name'        => 'About The Baking Palette',
		'url'         => get_permalink(),
		'description' => 'The story behind The Baking Palette, a custom cake studio in Sialkot specialising in two-tier and multi-tier cakes for weddings, engagements, birthdays and baby celebrations.',
		'mainEntity'  => tbp_bakery_schema( $image ),
	);

	tbp_seo_print_schema( array( $about ) );
}

/**
 * Front page: meta tags plus Bakery and FAQPage graphs.
 */
function tbp_seo_front_page() {
	$home        = home_url( '/' );
	$image       = get_template_directory_uri() . '/images/gallery/wedding-three-tier-ivory-floral.jpg';
	$title       = tbp_seo_title();
	$description = 'Custom premium cakes in Sialkot — two-tier and multi-tier wedding cakes, engagement, birthday and themed cakes, plus cupcakes. Order on Instagram or WhatsApp.';
	$social_desc = 'Two-tier and multi-tier wedding cakes, engagement, birthday and themed cakes, cupcakes and fondant cookies — handcrafted to order in Sialkot.';

	tbp_seo_meta_tags( $title, $description, $social_desc, $home, $image );

	$bakery             = tbp_bakery_schema( $image );
	$bakery['@context'] = 'https://schema.org';

	$faqs = array(
		'Do you make two-tier and multi-tier cakes?' => 'Yes — tiered cakes are one of our specialities. We make two-tier and three-tier cakes for weddings, walima, nikkah and engagements, vintage piped buttercream designs, and tall birthday cakes. Tiered cakes are quoted on request, based on the number of tiers, the total weight and the design.',
		'How much does a custom cake cost in Sialkot?' => 'Customised cakes start at Rs. 1,800 per pound with fresh cream and Rs. 2,000 per pound with buttercream, from a 1.5 lb minimum. Premium flavors such as Lotus, Nutella or KitKat carry an extra charge per pound, and tiered or sculpted cakes are quoted on request.',
		'How far in advance should I order a cake?' => 'Standard orders need 2 to 3 days\' notice, and larger or tiered orders about 5 days. Urgent orders are welcome whenever a slot is available. A 50% advance payment confirms the booking.',
		'How do I place an order?' => 'Message us on Instagram at @the_bakingpalette or on WhatsApp at 0328 9480799 with your event date, theme, flavor and serving size. We reply with design options, flavors and a quote.',
		'Do you deliver cakes?' => 'We deliver within Sialkot only, and pickup is always available. We do not deliver to other cities.',
		'What cake flavors do you offer?' => 'Best-sellers include Chocolate Fudge, Vanilla Caramel, Pineapple and Vanilla, and Vanilla with Strawberry. Premium flavors include KitKat, Lotus, Cadbury, Nutty Snickers, Nutella and Red Velvet. Cupcake boxes and fondant decorated butter cookies are also available.',
	);

	$faq_page = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => array(),
	);

	foreach ( $faqs as $question => $answer ) {
		$faq_page['mainEntity'][] = array(
			'@type'          => 'Question',
			'name'           => $question,
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => $answer,
			),
		);
	}

	tbp_seo_print_schema( array( $bakery, $faq_page ) );
}

/**
 * Menu page: meta tags plus an ItemList of products with their per-pound
 * rates, so search and AI engines can answer "how much is a cake" directly.
 */
function tbp_seo_menu_page() {
	$image       = get_template_directory_uri() . '/images/gallery/birthday-chocolate-candles.jpg';
	$title       = tbp_seo_title();
	$description = 'Cake prices in Sialkot: fresh cream from Rs. 1,800/lb, buttercream from Rs. 2,000/lb, premium flavors, cupcake boxes, and tiered cakes quoted on request.';
	$social_desc = 'Cake flavors, cupcake boxes and pricing for custom and tiered cakes in Sialkot, with fresh cream and buttercream rates.';

	tbp_seo_meta_tags( $title, $description, $social_desc, get_permalink(), $image );

	$per_lb = array(
		array( 'Fresh Cream Custom Cake', 'Our standard finish, light and soft. Best-seller flavors are priced at this rate, from a 1.5 lb minimum.', '1800' ),
		array( 'Buttercream Custom Cake', 'Firmer finish that holds piping, sharp edges and detailed decoration, from a 1.5 lb minimum.', '2000' ),
		array( 'Chocolate Fudge Cake', 'Best-seller flavor at the standard fresh cream rate, priced per pound.', '1800' ),
		array( 'Vanilla Caramel Cake', 'Best-seller flavor at the standard fresh cream rate, priced per pound.', '1800' ),
		array( 'Pineapple and Vanilla Cake', 'Best-seller flavor at the standard fresh cream rate, priced per pound.', '1800' ),
		array( 'Vanilla with Strawberry Cake', 'Best-seller flavor at the standard fresh cream rate, priced per pound.', '1800' ),
		array( 'KitKat Cake', 'Premium flavor made with premium fillings and toppings, priced per pound.', '2000' ),
		array( 'Lotus Cake', 'Premium flavor made with premium fillings and toppings, priced per pound.', '2000' ),
		array( 'Cadbury Cake', 'Premium flavor made with premium fillings and toppings, priced per pound.', '2000' ),
		array( 'Nutty Snickers Cake', 'Premium flavor made with premium fillings and toppings, priced per pound.', '2000' ),
		array( 'Nutella Cake', 'Premium flavor made with premium fillings and toppings, priced per pound.', '2000' ),
		array( 'Red Velvet Cake', 'Premium flavor made with premium fillings and toppings, priced per pound.', '2000' ),
	);

	$fixed = array(
		array( 'Cupcake Box of 6', 'Six decorated cupcakes, iced to match your theme.', '1800' ),
		array( 'Cupcake Box of 9', 'Nine decorated cupcakes, iced to match your theme.', '2600' ),
		array( 'Cupcake Box of 12', 'Twelve decorated cupcakes, iced to match your theme.', '3500' ),
		array( 'Butter Cookie with Fondant Decor', 'Butter cookies finished with fondant decor — a favorite for favors and giveaways.', '220' ),
	);

	$on_request = array(
		array( '2-Tier Wedding Cake', 'Two-tier cake designed around your theme and colors, priced by pounds and design.' ),
		array( '3+ Tier Custom Cake', 'Three or more tiers designed around your theme and colors, priced by pounds and design.' ),
		array( 'Character or Sculpted Cake', 'Fully sculpted and character cakes built to your idea.' ),
		array( 'Corporate or Logo Cake', 'Branded cakes for company events and launches.' ),
	);

	$items    = array();
	$position = 1;

	foreach ( $per_lb as $product ) {
		$items[] = tbp_seo_product_list_item(
			$position++,
			$product[0],
			$product[1],
			array(
				'@type'            => 'Offer',
				'price'            => $product[2],
				'priceCurrency'    => 'PKR',
				'eligibleQuantity' => array(
					'@type'    => 'QuantitativeValue',
					'unitText' => 'lb',
					'minValue' => 1.5,
				),
				'availability'     => 'https://schema.org/InStock',
				'areaServed'       => 'Sialkot',
			)
		);
	}

	foreach ( $fixed as $product ) {
		$items[] = tbp_seo_product_list_item(
			$position++,
			$product[0],
			$product[1],
			array(
				'@type'         => 'Offer',
				'price'         => $product[2],
				'priceCurrency' => 'PKR',
				'availability'  => 'https://schema.org/InStock',
				'areaServed'    => 'Sialkot',
			)
		);
	}

	foreach ( $on_request as $product ) {
		$items[] = tbp_seo_product_list_item(
			$position++,
			$product[0],
			$product[1],
			array(
				'@type'         => 'Offer',
				'priceCurrency' => 'PKR',
				'availability'  => 'https://schema.org/InStock',
				'areaServed'    => 'Sialkot',
				'description'   => 'Quote on request',
			)
		);
	}

	tbp_seo_print_schema(
		array(
			array(
				'@context'        => 'https://schema.org',
				'@type'           => 'ItemList',
				'name'            => 'Cake menu and pricing — The Baking Palette, Sialkot',
				'description'     => 'Flavors, packages and rates for custom cakes, cupcakes and cookies. Cakes start at 1.5 lb; tiered and sculpted cakes are quoted on request.',
				'url'             => get_permalink(),
				'itemListElement' => $items,
			),
		)
	);
}

/**
 * One Product entry for the menu's ItemList.
 */
function tbp_seo_product_list_item( $position, $name, $description, $offer ) {
	return array(
		'@type'    => 'ListItem',
		'position' => $position,
		'item'     => array(
			'@type'       => 'Product',
			'name'        => $name,
			'description' => $description,
			'offers'      => $offer,
		),
	);
}

/**
 * Gallery page: meta tags plus an ImageGallery graph built from the images
 * the template actually renders, so the list never drifts from the page.
 */
function tbp_seo_gallery_page() {
	$theme_uri   = get_template_directory_uri();
	$image       = $theme_uri . '/images/gallery/tiered-vintage-pastel-three-tier.jpg';
	$title       = tbp_seo_title();
	$description = 'Real cakes by The Baking Palette in Sialkot — two-tier and multi-tier wedding, engagement, birthday, themed and festive designs, plus cupcakes.';
	$social_desc = 'Real tiered, wedding, birthday and themed cakes handcrafted by The Baking Palette in Sialkot.';

	tbp_seo_meta_tags( $title, $description, $social_desc, get_permalink(), $image );

	$images = tbp_template_images( 'page-gallery.php' );
	$items  = array();

	foreach ( $images as $index => $item ) {
		$items[] = array(
			'@type'    => 'ListItem',
			'position' => $index + 1,
			'item'     => array(
				'@type'      => 'ImageObject',
				'contentUrl' => $theme_uri . '/images/gallery/' . $item['file'],
				'name'       => $item['alt'],
				'caption'    => $item['alt'],
				'creator'    => array(
					'@type' => 'Bakery',
					'name'  => 'The Baking Palette',
				),
			),
		);
	}

	tbp_seo_print_schema(
		array(
			array(
				'@context'    => 'https://schema.org',
				'@type'       => 'ImageGallery',
				'name'        => 'Cake gallery — The Baking Palette, Sialkot',
				'description' => 'Custom cakes designed and baked by The Baking Palette for real celebrations in Sialkot: tiered and wedding cakes, engagement, birthday, themed, baby and festive designs.',
				'url'         => get_permalink(),
				'about'       => tbp_bakery_schema( $image ),
				'mainEntity'  => array(
					'@type'           => 'ItemList',
					'numberOfItems'   => count( $items ),
					'itemListElement' => $items,
				),
			),
		)
	);
}

/**
 * Testimonials page: meta tags plus the reviews the template renders,
 * marked up as Review items with their real star ratings.
 */
function tbp_seo_testimonials_page() {
	$image       = get_template_directory_uri() . '/images/gallery/wedding-two-tier-pearls-roses.jpg';
	$title       = tbp_seo_title();
	$description = 'Real Google reviews and Instagram messages from customers of The Baking Palette, a custom cake studio in Sialkot making tiered and themed cakes.';
	$social_desc = 'Real Google and Instagram reviews from customers of The Baking Palette in Sialkot.';

	tbp_seo_meta_tags( $title, $description, $social_desc, get_permalink(), $image );

	$reviews = tbp_template_reviews( 'page-testimonials.php' );
	$items   = array();

	foreach ( $reviews as $index => $review ) {
		$entry = array(
			'@type'      => 'Review',
			'reviewBody' => $review['body'],
			'author'     => array(
				'@type' => 'Person',
				'name'  => $review['author'],
			),
			'publisher'  => array(
				'@type' => 'Organization',
				'name'  => $review['publisher'],
			),
		);

		if ( $review['rating'] ) {
			$entry['reviewRating'] = array(
				'@type'       => 'Rating',
				'ratingValue' => $review['rating'],
				'bestRating'  => 5,
				'worstRating' => 1,
			);
		}

		$items[] = array(
			'@type'    => 'ListItem',
			'position' => $index + 1,
			'item'     => $entry,
		);
	}

	tbp_seo_print_schema(
		array(
			array(
				'@context'        => 'https://schema.org',
				'@type'           => 'ItemList',
				'name'            => 'Customer reviews of The Baking Palette',
				'description'     => 'Reviews from the Google Business Profile and Instagram messages of The Baking Palette, a custom cake studio in Sialkot.',
				'url'             => get_permalink(),
				'about'           => tbp_bakery_schema( $image ),
				'numberOfItems'   => count( $items ),
				'itemListElement' => $items,
			),
		)
	);
}

/**
 * Read the gallery images straight out of a template file, so the structured
 * data matches what visitors see even after the template is edited.
 */
function tbp_template_images( $template ) {
	$markup = tbp_template_markup( $template );

	if ( ! $markup || ! preg_match_all( '/images\/gallery\/([^"\']+)"\s+alt="([^"]+)"/', $markup, $matches, PREG_SET_ORDER ) ) {
		return array();
	}

	$images = array();

	foreach ( $matches as $match ) {
		$images[] = array(
			'file' => $match[1],
			'alt'  => html_entity_decode( $match[2], ENT_QUOTES, 'UTF-8' ),
		);
	}

	return $images;
}

/**
 * Read the testimonial cards out of a template file, with their star count,
 * quote, author and source.
 */
function tbp_template_reviews( $template ) {
	$markup = tbp_template_markup( $template );
	$found  = preg_match_all(
		'/data-source="(\w+)">\s*<div class="stars">(.*?)<\/div>\s*<p class="quote">"(.*?)"<\/p>.*?<strong>(.*?)<\/strong>/s',
		(string) $markup,
		$matches,
		PREG_SET_ORDER
	);

	if ( ! $markup || ! $found ) {
		return array();
	}

	$reviews = array();

	foreach ( $matches as $match ) {
		$reviews[] = array(
			'publisher' => 'google' === $match[1] ? 'Google' : 'Instagram',
			'rating'    => substr_count( $match[2], '★' ),
			'body'      => html_entity_decode( trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( $match[3] ) ) ), ENT_QUOTES, 'UTF-8' ),
			'author'    => html_entity_decode( trim( wp_strip_all_tags( $match[4] ) ), ENT_QUOTES, 'UTF-8' ),
		);
	}

	return $reviews;
}

/**
 * Cached read of a template file's raw markup.
 */
function tbp_template_markup( $template ) {
	static $cache = array();

	if ( ! isset( $cache[ $template ] ) ) {
		$path              = get_template_directory() . '/' . $template;
		$cache[ $template ] = file_exists( $path ) ? file_get_contents( $path ) : '';
	}

	return $cache[ $template ];
}

/**
 * Serve /llms.txt from the theme — a plain-language summary of the business
 * for AI answer engines, which read that file the way crawlers read robots.txt.
 */
function tbp_serve_llms_txt() {
	$path = isset( $_SERVER['REQUEST_URI'] ) ? wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ), PHP_URL_PATH ) : '';

	if ( '/llms.txt' !== untrailingslashit( (string) $path ) ) {
		return;
	}

	$file = get_template_directory() . '/llms.txt';

	if ( ! file_exists( $file ) ) {
		return;
	}

	header( 'Content-Type: text/plain; charset=utf-8' );
	header( 'X-Robots-Tag: noindex' );
	echo file_get_contents( $file ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- plain text file shipped with the theme.
	exit;
}
add_action( 'template_redirect', 'tbp_serve_llms_txt' );
