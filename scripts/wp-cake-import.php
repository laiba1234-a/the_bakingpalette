<?php
/**
 * Creates or updates tbp_cake posts from a JSON file produced by
 * wp-cake-export.php. Matches existing posts by a stable `_tbp_import_slug`
 * meta value (set from the export's post_name) rather than by post_name
 * itself, because WordPress silently suffixes post_name (e.g. "-2") on
 * insert/update when that slug is already taken by any other post on the
 * site — matching on the raw slug would miss that and create a duplicate
 * on every re-run instead of updating the original.
 *
 * Usage: copy the export JSON to /tmp/cakes_import.json on the target
 * server, then wp eval-file scripts/wp-cake-import.php --path=<wordpress-root>
 * The theme (which registers the tbp_cake post type) must already be active
 * on the target site, and the cake images must already exist under
 * wp-content/themes/the-baking-palette/images/gallery/.
 */
$json = file_get_contents( '/tmp/cakes_import.json' );
if ( false === $json ) {
	echo "ERROR: could not read /tmp/cakes_import.json — did you scp the export there first?\n";
	exit( 1 );
}

$data = json_decode( $json, true );
if ( ! is_array( $data ) ) {
	echo "ERROR: /tmp/cakes_import.json is not valid JSON (" . json_last_error_msg() . ")\n";
	exit( 1 );
}

$created = 0;
$updated = 0;
$errors  = 0;

foreach ( $data as $cake ) {
	$existing = get_posts( array(
		'post_type'      => 'tbp_cake',
		'post_status'    => 'any',
		'posts_per_page' => 1,
		'meta_key'       => '_tbp_import_slug',
		'meta_value'     => $cake['post_name'],
	) );

	$postarr = array(
		'post_type'    => 'tbp_cake',
		'post_status'  => isset( $cake['post_status'] ) ? $cake['post_status'] : 'publish',
		'post_title'   => $cake['post_title'],
		'post_content' => $cake['post_content'],
		'post_name'    => $cake['post_name'],
		'menu_order'   => $cake['menu_order'],
	);

	$is_update = ! empty( $existing );
	if ( $is_update ) {
		$postarr['ID'] = $existing[0]->ID;
		$post_id = wp_update_post( $postarr, true );
	} else {
		$post_id = wp_insert_post( $postarr, true );
	}

	if ( is_wp_error( $post_id ) ) {
		echo "ERROR on {$cake['post_name']}: " . $post_id->get_error_message() . "\n";
		$errors++;
		continue;
	}

	update_post_meta( $post_id, '_tbp_import_slug', $cake['post_name'] );
	foreach ( $cake['meta'] as $key => $value ) {
		update_post_meta( $post_id, $key, $value );
	}

	if ( $is_update ) {
		$updated++;
	} else {
		$created++;
	}
}

echo "Created: $created, Updated: $updated, Errors: $errors\n";
