<?php
/**
 * Creates or updates tbp_cake posts from a JSON file produced by
 * wp-cake-export.php. Matches on post_name (slug), so it's safe to re-run:
 * existing cakes get updated in place rather than duplicated.
 *
 * Usage: copy the export JSON to /tmp/cakes_import.json on the target
 * server, then wp eval-file scripts/wp-cake-import.php --path=<wordpress-root>
 * The theme (which registers the tbp_cake post type) must already be active
 * on the target site, and the cake images must already exist under
 * wp-content/themes/the-baking-palette/images/gallery/.
 */
$data = json_decode( file_get_contents( '/tmp/cakes_import.json' ), true );

$created = 0;
$updated = 0;

foreach ( $data as $cake ) {
	$existing = get_page_by_path( $cake['post_name'], OBJECT, 'tbp_cake' );

	$postarr = array(
		'post_type'    => 'tbp_cake',
		'post_status'  => 'publish',
		'post_title'   => $cake['post_title'],
		'post_content' => $cake['post_content'],
		'post_name'    => $cake['post_name'],
		'menu_order'   => $cake['menu_order'],
	);

	if ( $existing ) {
		$postarr['ID'] = $existing->ID;
		$post_id = wp_update_post( $postarr, true );
		$updated++;
	} else {
		$post_id = wp_insert_post( $postarr, true );
		$created++;
	}

	if ( is_wp_error( $post_id ) ) {
		echo "ERROR on {$cake['post_name']}: " . $post_id->get_error_message() . "\n";
		continue;
	}

	foreach ( $cake['meta'] as $key => $value ) {
		update_post_meta( $post_id, $key, $value );
	}
}

echo "Created: $created, Updated: $updated\n";
