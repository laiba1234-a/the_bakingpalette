<?php
/**
 * Dumps every tbp_cake post (content + _tbp_* meta) to a JSON file, so the
 * cake catalog can be copied from one WordPress install to another (e.g.
 * local Docker -> live Hostinger site) without a full database migration.
 *
 * Usage: wp eval-file scripts/wp-cake-export.php --path=<wordpress-root>
 * Writes to /tmp/cakes_export.json. Pair with wp-cake-import.php.
 */
$posts = get_posts( array(
	'post_type'      => 'tbp_cake',
	'post_status'    => 'any',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
) );

$out = array();
foreach ( $posts as $p ) {
	$meta_raw = get_post_meta( $p->ID );
	$meta = array();
	foreach ( $meta_raw as $k => $v ) {
		if ( strpos( $k, '_tbp_' ) === 0 ) {
			$meta[ $k ] = $v[0];
		}
	}
	$out[] = array(
		'post_title'   => $p->post_title,
		'post_content' => $p->post_content,
		'post_name'    => $p->post_name,
		'post_status'  => $p->post_status,
		'menu_order'   => (int) $p->menu_order,
		'meta'         => $meta,
	);
}

file_put_contents( '/tmp/cakes_export.json', json_encode( $out, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) );
echo 'Exported ' . count( $out ) . " cakes to /tmp/cakes_export.json\n";
