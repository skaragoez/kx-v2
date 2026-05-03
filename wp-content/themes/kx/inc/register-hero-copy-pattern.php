<?php
/**
 * Register hero-copy block pattern (CRO stack for left column).
 *
 * @package kx
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/hero-copy-pattern-markup.php';

/**
 * Register KX hero copy pattern — no columns, images, or works-ticker.
 */
function kx_register_hero_copy_pattern() {
	if ( ! function_exists( 'register_block_pattern' ) ) {
		return;
	}

	$pattern_meta = __( 'KX Hero Copy', 'kx' );
	$trust_meta   = __( 'Hero Copy — Vertrauenszeile', 'kx' );

	register_block_pattern(
		'kx/hero-copy',
		array(
			'title'       => __( 'Hero Copy (links)', 'kx' ),
			'description' => __( 'Nur linker Hero-Teil: Trust-Pill, Titel, Nutzen, zwei CTAs, Logo-Zeile, Testimonial. In die bestehende Hero-Spalte neben Bild und works-ticker einfügen.', 'kx' ),
			'categories'  => array( 'kx' ),
			'keywords'    => array( 'hero', 'cro', 'copy', 'kx', 'landing', 'conversion' ),
			'content'     => kx_hero_copy_pattern_markup( $pattern_meta, $trust_meta ),
		)
	);
}
add_action( 'init', 'kx_register_hero_copy_pattern' );
