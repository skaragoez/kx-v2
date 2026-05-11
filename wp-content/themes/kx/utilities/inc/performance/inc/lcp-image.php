<?php

// Set the first above-the-fold image block as LCP candidate.
// WordPress adds loading="lazy" to all images by default, which delays the LCP.
// Skip thumbnails, rounded avatars, and editor-resized images (is-resized) — the
// first remaining size-full image is the hero image.
add_filter( 'render_block', function( $block_content, $block ) {
	static $count = 0;

	if ( 'core/image' !== $block['blockName'] || $count > 0 || is_admin() ) {
		return $block_content;
	}

	if (
		str_contains( $block_content, 'size-thumbnail' ) ||
		str_contains( $block_content, 'is-resized' ) ||
		str_contains( $block_content, 'is-style-rounded' )
	) {
		return $block_content;
	}

	$count++;
	$block_content = str_replace( ' loading="lazy"', '', $block_content );
	$block_content = preg_replace( '/<img\b/', '<img fetchpriority="high" loading="eager"', $block_content, 1 );

	return $block_content;
}, 10, 2 );
