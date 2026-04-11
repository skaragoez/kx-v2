<?php
/**
 * Register portfolio-related block patterns (Stitch-style layout classes).
 *
 * @package kx
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/portfolio-pattern-markup.php';

/**
 * Register KX pattern category and portfolio patterns.
 */
function kx_register_portfolio_block_patterns() {
	if ( ! function_exists( 'register_block_pattern' ) ) {
		return;
	}

	register_block_pattern_category(
		'kx',
		array(
			'label' => __( 'KX', 'kx' ),
		)
	);

	$shell_meta = __( 'Portfolio-Raster', 'kx' );
	$item_meta  = __( 'Portfolio-Projektzelle', 'kx' );
	$start_meta = __( 'Portfolio-Starter', 'kx' );

	register_block_pattern(
		'kx/portfolio-grid-shell',
		array(
			'title'       => __( 'Portfolio: Raster (nur Außen-Grid)', 'kx' ),
			'description' => __( 'Äußeres Grid mit Klassen für das Portfolio-Layout. Danach die Projektzelle einfügen oder duplizieren.', 'kx' ),
			'categories'  => array( 'kx', 'gallery' ),
			'keywords'    => array( 'portfolio', 'grid', 'kx', 'Projekt' ),
			'content'     => kx_portfolio_pattern_shell_markup( $shell_meta ),
		)
	);

	register_block_pattern(
		'kx/portfolio-project-item',
		array(
			'title'       => __( 'Portfolio: Projektzelle', 'kx' ),
			'description' => __( 'Eine Karte mit Bild, Titel und Text — beliebig oft einfügen oder duplizieren.', 'kx' ),
			'categories'  => array( 'kx', 'gallery' ),
			'keywords'    => array( 'portfolio', 'project', 'kx', 'Karte' ),
			'content'     => kx_portfolio_pattern_item_markup( $item_meta ),
		)
	);

	register_block_pattern(
		'kx/portfolio-grid-starter',
		array(
			'title'       => __( 'Portfolio: Raster mit Platzhalter-Zellen', 'kx' ),
			'description' => __( 'Grid plus mehrere Zellen aus derselben Vorlage — Struktur zentral im Theme gepflegt.', 'kx' ),
			'categories'  => array( 'kx', 'gallery' ),
			'keywords'    => array( 'portfolio', 'grid', 'starter', 'kx' ),
			'content'     => kx_portfolio_pattern_starter_markup( $start_meta, $item_meta ),
		)
	);
}
add_action( 'init', 'kx_register_portfolio_block_patterns' );
