<?php

$kx_defer_handles = [
	'complianz',
	'googlesitekit',
	'googlesitekit-base',
];

add_filter( 'script_loader_tag', function( $tag, $handle ) use ( $kx_defer_handles ) {
	if ( ! in_array( $handle, $kx_defer_handles, true ) ) {
		return $tag;
	}

	if ( str_contains( $tag, 'defer' ) ) {
		return $tag;
	}

	return str_replace( ' src=', ' defer src=', $tag );
}, 10, 2 );
