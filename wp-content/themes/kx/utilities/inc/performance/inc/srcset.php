<?php

// 1536x1536 und 2048x2048 nicht generieren — zu groß für dieses Projekt
add_filter( 'intermediate_image_sizes_advanced', function( $sizes ) {
	unset( $sizes['1536x1536'] );
	unset( $sizes['2048x2048'] );

	return $sizes;
} );
