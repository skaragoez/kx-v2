<?php
/**
 * Serialized block markup for portfolio grid patterns (single source of truth).
 *
 * No WordPress action/filter hooks in this file except optional `apply_filters`
 * for layout constants documented in the plan.
 *
 * @package kx
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Grid column count for shell and starter patterns (1–12).
 *
 * @return int
 */
function kx_portfolio_pattern_grid_column_count() {
	$columns = (int) apply_filters( 'kx_portfolio_grid_column_count', 3 );

	return max( 1, min( 12, $columns ) );
}

/**
 * Number of placeholder cells in the starter pattern (1–12).
 *
 * @return int
 */
function kx_portfolio_pattern_starter_cell_count() {
	$count = (int) apply_filters( 'kx_portfolio_pattern_starter_cell_count', 3 );

	return max( 1, min( 12, $count ) );
}

/**
 * Outer grid group attributes (shared by shell and starter).
 *
 * @param string $metadata_name Editor list label (translated at call site).
 * @return array<string, mixed>
 */
function kx_portfolio_pattern_grid_block_attrs( $metadata_name ) {
	return array(
		'className' => 'kx-portfolio-grid c-gap-5',
		'layout'    => array(
			'type'        => 'grid',
			'columnCount' => kx_portfolio_pattern_grid_column_count(),
		),
		'metadata'  => array(
			'name' => $metadata_name,
		),
	);
}

/**
 * Opening serialized group for the portfolio grid shell / starter.
 *
 * @param string $metadata_name Editor list label.
 * @return string
 */
function kx_portfolio_pattern_grid_open( $metadata_name ) {
	$attrs = wp_json_encode(
		kx_portfolio_pattern_grid_block_attrs( $metadata_name ),
		JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
	);

	return sprintf(
		"<!-- wp:group %s -->\n<div class=\"wp-block-group kx-portfolio-grid c-gap-5 is-layout-grid wp-block-group-is-layout-grid\">",
		$attrs
	);
}

/**
 * Closing markup for the portfolio grid group.
 *
 * @return string
 */
function kx_portfolio_pattern_grid_close() {
	return "</div>\n<!-- /wp:group -->";
}

/**
 * One portfolio cell: constrained group + image + title + body (translatable placeholders).
 *
 * @param string $metadata_name Editor list label for the inner group.
 * @return string
 */
function kx_portfolio_pattern_item_markup( $metadata_name ) {
	$group_attrs = wp_json_encode(
		array(
			'className' => 'kx-portfolio-cell',
			'layout'    => array( 'type' => 'constrained' ),
			'metadata'  => array( 'name' => $metadata_name ),
		),
		JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
	);

	/* translators: Default portfolio card title in block pattern. */
	$title = esc_html__( 'Projekttitel', 'kx' );
	/* translators: Default portfolio card body in block pattern. */
	$body  = esc_html__( 'Kurzer Projekttext — Bild und Text im Editor anpassen.', 'kx' );

	return <<<MARKUP
<!-- wp:group {$group_attrs} -->
<div class="wp-block-group kx-portfolio-cell is-layout-constrained wp-block-group-is-layout-constrained">
<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} /-->

<!-- wp:paragraph {"fontSize":"h4","style":{"spacing":{"margin":{"top":"1rem","bottom":"0.5rem"}}}} -->
<p class="has-h-4-font-size" style="margin-top:1rem;margin-bottom:0.5rem">{$title}</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"body"} -->
<p class="has-body-font-size">{$body}</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

MARKUP;
}

/**
 * Shell only: empty grid container for manually inserted or duplicated cells.
 *
 * @param string $metadata_name Editor list label for the outer group.
 * @return string
 */
function kx_portfolio_pattern_shell_markup( $metadata_name ) {
	return kx_portfolio_pattern_grid_open( $metadata_name ) . kx_portfolio_pattern_grid_close();
}

/**
 * Starter: shell wrapping N item blocks (same markup as single item pattern).
 *
 * @param string $shell_metadata_name   Outer group editor label.
 * @param string $item_metadata_name    Inner group editor label.
 * @return string
 */
function kx_portfolio_pattern_starter_markup( $shell_metadata_name, $item_metadata_name ) {
	$cells = '';
	$count = kx_portfolio_pattern_starter_cell_count();

	for ( $i = 0; $i < $count; $i++ ) {
		$cells .= "\n" . kx_portfolio_pattern_item_markup( $item_metadata_name );
	}

	return kx_portfolio_pattern_grid_open( $shell_metadata_name ) . $cells . "\n" . kx_portfolio_pattern_grid_close();
}
