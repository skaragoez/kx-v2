<?php
/**
 * Serialized block markup for the hero copy pattern (left column CRO stack only).
 *
 * @package kx
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Left-column hero copy: trust pill, headline, benefits, CTAs, logos, testimonial.
 * Insert inside an existing `.hero` row (e.g. first column next to image + `works-ticker`).
 *
 * @param string $pattern_meta Editor list label for the wrapper group.
 * @param string $trust_meta   Metadata name for trust pill row.
 * @return string
 */
function kx_hero_copy_pattern_markup( string $pattern_meta, string $trust_meta ): string {
	$wrapper_attrs = wp_json_encode(
		array(
			'className' => 'hero-copy hero-cro__inner',
			'layout'    => array( 'type' => 'default' ),
			'metadata'  => array(
				'name' => $pattern_meta,
			),
		),
		JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
	);

	$trust_row_attrs = wp_json_encode(
		array(
			'className' => 'hero-cro__trust',
			'metadata'  => array( 'name' => $trust_meta ),
			'layout'    => array(
				'type'                => 'flex',
				'flexWrap'            => 'nowrap',
				'verticalAlignment'   => 'center',
			),
		),
		JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
	);

	$avatars_attrs = wp_json_encode(
		array(
			'className' => 'hero-cro__trust-avatars',
			'layout'    => array(
				'type'              => 'flex',
				'flexWrap'          => 'nowrap',
				'verticalAlignment' => 'center',
			),
		),
		JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
	);

	$benefits_outer_attrs = wp_json_encode(
		array(
			'className' => 'hero-cro__benefits',
			'layout'    => array(
				'type'               => 'flex',
				'orientation'        => 'vertical',
				'flexWrap'           => 'nowrap',
				'justifyContent'     => 'flex-start',
				'verticalAlignment'  => 'center',
			),
		),
		JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
	);

	$benefit_row_attrs_fn = static function ( string $mod ): string {
		return wp_json_encode(
			array(
				'className' => 'hero-cro__benefit hero-cro__benefit--' . $mod,
				'layout'    => array(
					'type'              => 'flex',
					'flexWrap'          => 'nowrap',
					'verticalAlignment' => 'center',
				),
			),
			JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
		);
	};

	$buttons_attrs = wp_json_encode(
		array(
			'className' => 'hero-cro__ctas',
			'layout'    => array(
				'type'               => 'flex',
				'flexWrap'           => 'wrap',
				'justifyContent'     => 'left',
				'verticalAlignment'  => 'center',
			),
		),
		JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
	);

	$logos_row_attrs = wp_json_encode(
		array(
			'className' => 'hero-cro__logos-row',
			'layout'    => array(
				'type'               => 'flex',
				'flexWrap'           => 'wrap',
				'justifyContent'     => 'flex-start',
				'verticalAlignment'  => 'center',
			),
		),
		JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
	);

	$logo_card_attrs = wp_json_encode(
		array(
			'className' => 'hero-cro__logo-card',
			'layout'    => array(
				'type'              => 'flex',
				'flexWrap'          => 'nowrap',
				'verticalAlignment' => 'center',
			),
		),
		JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
	);

	$testimonial_footer_attrs = wp_json_encode(
		array(
			'className' => 'hero-cro__testimonial-footer',
			'layout'    => array(
				'type'               => 'flex',
				'flexWrap'           => 'wrap',
				'justifyContent'     => 'space-between',
				'verticalAlignment'  => 'bottom',
			),
		),
		JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
	);

	$author_row_attrs = wp_json_encode(
		array(
			'className' => 'hero-cro__testimonial-meta',
			'layout'    => array(
				'type'              => 'flex',
				'flexWrap'          => 'nowrap',
				'verticalAlignment' => 'center',
			),
		),
		JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
	);

	/* translators: CRO hero — trust badge line after star rating */
	$trust_label = esc_html__( 'Trusted by 50+ Unternehmen', 'kx' );
	/* translators: CRO hero — lead paragraph */
	$lead        = esc_html__( 'Social Media bringt den Traffic — deine Website macht daraus echte Leads.', 'kx' );
	/* translators: CRO hero — benefit 1 */
	$b1          = esc_html__( 'Mehr Leads aus deinem Social-Media-Traffic', 'kx' );
	/* translators: CRO hero — benefit 2 */
	$b2          = esc_html__( 'Schnelle Lieferzeit — Go-Live in 2 Wochen', 'kx' );
	/* translators: CRO hero — benefit 3 */
	$b3          = esc_html__( 'Conversion-optimiert — A/B getestet, nicht geraten', 'kx' );
	/* translators: CRO hero — benefit 4 */
	$b4          = esc_html__( 'Persönlicher Ansprechpartner, kein Ticket-System', 'kx' );
	/* translators: CRO hero — primary CTA */
	$cta1        = esc_html__( 'Kostenlose Beratung', 'kx' );
	/* translators: CRO hero — secondary CTA */
	$cta2        = esc_html__( 'Portfolio ansehen', 'kx' );
	/* translators: CRO hero — logos section label */
	$logos_h     = esc_html__( 'KUNDEN VERTRAUEN UNS', 'kx' );
	/* translators: CRO hero — testimonial quote */
	$quote       = esc_html__( 'Seit dem Relaunch haben sich unsere Anfragen verdreifacht. Endlich eine Website, die wirklich verkauft.', 'kx' );

	$name = esc_html( 'Mehmet Yılmaz' );

	/* translators: CRO hero — testimonial role line */
	$role = esc_html__( 'CEO, Premium Immo', 'kx' );

	$aria_stars = esc_attr__( '5 von 5 Sternen', 'kx' );

	return <<<MARKUP
<!-- wp:group {$wrapper_attrs} -->
<div class="wp-block-group hero-copy hero-cro__inner is-layout-flow wp-block-group-is-layout-flow">
<!-- wp:group {$trust_row_attrs} -->
<div class="wp-block-group hero-cro__trust is-horizontal is-layout-flex is-nowrap is-vertical-align-center wp-block-group-is-layout-flex">
<!-- wp:group {$avatars_attrs} -->
<div class="wp-block-group hero-cro__trust-avatars is-horizontal is-layout-flex wp-block-group-is-layout-flex">
<!-- wp:paragraph {"className":"hero-cro__avatar hero-cro__avatar--navy"} -->
<p class="hero-cro__avatar hero-cro__avatar--navy">MY</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"hero-cro__avatar hero-cro__avatar--orange"} -->
<p class="hero-cro__avatar hero-cro__avatar--orange">AK</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"hero-cro__avatar hero-cro__avatar--navy"} -->
<p class="hero-cro__avatar hero-cro__avatar--navy">SB</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"hero-cro__trust-meta"} -->
<p class="hero-cro__trust-meta"><span class="hero-cro__stars" aria-hidden="true">★★★★★</span><span class="hero-cro__trust-label">{$trust_label}</span></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:heading {"level":1,"fontSize":"hero","className":"hero-cro__title"} -->
<h1 class="wp-block-heading hero-cro__title has-hero-font-size"><span class="hero-cro__title-line hero-cro__title-line--primary">WEBSITES</span><span class="hero-cro__title-line hero-cro__title-line--accent">THAT CONVERT.</span></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"body","className":"hero-cro__lead"} -->
<p class="hero-cro__lead has-body-font-size">{$lead}</p>
<!-- /wp:paragraph -->

<!-- wp:group {$benefits_outer_attrs} -->
<div class="wp-block-group hero-cro__benefits is-layout-flex wp-block-group-is-layout-flex">
<!-- wp:group {$benefit_row_attrs_fn( 'trend' )} -->
<div class="wp-block-group hero-cro__benefit hero-cro__benefit--trend is-horizontal is-layout-flex is-nowrap is-vertical-align-center wp-block-group-is-layout-flex">
<!-- wp:paragraph -->
<p>{$b1}</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {$benefit_row_attrs_fn( 'bolt' )} -->
<div class="wp-block-group hero-cro__benefit hero-cro__benefit--bolt is-horizontal is-layout-flex is-nowrap is-vertical-align-center wp-block-group-is-layout-flex">
<!-- wp:paragraph -->
<p>{$b2}</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {$benefit_row_attrs_fn( 'shield' )} -->
<div class="wp-block-group hero-cro__benefit hero-cro__benefit--shield is-horizontal is-layout-flex is-nowrap is-vertical-align-center wp-block-group-is-layout-flex">
<!-- wp:paragraph -->
<p>{$b3}</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {$benefit_row_attrs_fn( 'support' )} -->
<div class="wp-block-group hero-cro__benefit hero-cro__benefit--support is-horizontal is-layout-flex is-nowrap is-vertical-align-center wp-block-group-is-layout-flex">
<!-- wp:paragraph -->
<p>{$b4}</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:buttons {$buttons_attrs} -->
<div class="wp-block-buttons hero-cro__ctas is-layout-flex is-content-justification-left is-vertical-align-center is-wrap wp-block-buttons-is-layout-flex">
<!-- wp:button {"className":"hero-cro__cta hero-cro__cta--solid"} -->
<div class="wp-block-button hero-cro__cta hero-cro__cta--solid"><a class="wp-block-button__link wp-element-button">{$cta1}</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"hero-cro__cta hero-cro__cta--outline"} -->
<div class="wp-block-button hero-cro__cta hero-cro__cta--outline"><a class="wp-block-button__link wp-element-button">{$cta2}</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"className":"hero-cro__logos-heading"} -->
<p class="hero-cro__logos-heading">{$logos_h}</p>
<!-- /wp:paragraph -->

<!-- wp:group {$logos_row_attrs} -->
<div class="wp-block-group hero-cro__logos-row is-horizontal is-layout-flex is-wrap is-vertical-align-center wp-block-group-is-layout-flex">
<!-- wp:group {$logo_card_attrs} -->
<div class="wp-block-group hero-cro__logo-card is-horizontal is-layout-flex is-nowrap is-vertical-align-center wp-block-group-is-layout-flex">
<!-- wp:paragraph {"className":"hero-cro__logo-initials hero-cro__logo-initials--navy"} -->
<p class="hero-cro__logo-initials hero-cro__logo-initials--navy">NE</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"hero-cro__logo-name"} -->
<p class="hero-cro__logo-name">NESA</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {$logo_card_attrs} -->
<div class="wp-block-group hero-cro__logo-card is-horizontal is-layout-flex is-nowrap is-vertical-align-center wp-block-group-is-layout-flex">
<!-- wp:paragraph {"className":"hero-cro__logo-initials hero-cro__logo-initials--orange"} -->
<p class="hero-cro__logo-initials hero-cro__logo-initials--orange">PI</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"hero-cro__logo-name"} -->
<p class="hero-cro__logo-name">Premium Immo</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {$logo_card_attrs} -->
<div class="wp-block-group hero-cro__logo-card is-horizontal is-layout-flex is-nowrap is-vertical-align-center wp-block-group-is-layout-flex">
<!-- wp:paragraph {"className":"hero-cro__logo-initials hero-cro__logo-initials--navy"} -->
<p class="hero-cro__logo-initials hero-cro__logo-initials--navy">BH</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"hero-cro__logo-name"} -->
<p class="hero-cro__logo-name">Bafra Hakkani</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {$logo_card_attrs} -->
<div class="wp-block-group hero-cro__logo-card is-horizontal is-layout-flex is-nowrap is-vertical-align-center wp-block-group-is-layout-flex">
<!-- wp:paragraph {"className":"hero-cro__logo-initials hero-cro__logo-initials--orange"} -->
<p class="hero-cro__logo-initials hero-cro__logo-initials--orange">LB</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"hero-cro__logo-name"} -->
<p class="hero-cro__logo-name">Lono Business</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {$logo_card_attrs} -->
<div class="wp-block-group hero-cro__logo-card is-horizontal is-layout-flex is-nowrap is-vertical-align-center wp-block-group-is-layout-flex">
<!-- wp:paragraph {"className":"hero-cro__logo-initials hero-cro__logo-initials--navy"} -->
<p class="hero-cro__logo-initials hero-cro__logo-initials--navy">TS</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"hero-cro__logo-name"} -->
<p class="hero-cro__logo-name">Tech Synergy</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"hero-cro__testimonial","layout":{"type":"constrained"}} -->
<div class="wp-block-group hero-cro__testimonial is-layout-constrained wp-block-group-is-layout-constrained">
<!-- wp:paragraph {"fontSize":"body","className":"hero-cro__quote"} -->
<p class="hero-cro__quote has-body-font-size">{$quote}</p>
<!-- /wp:paragraph -->

<!-- wp:group {$testimonial_footer_attrs} -->
<div class="wp-block-group hero-cro__testimonial-footer is-horizontal is-layout-flex is-wrap is-content-justification-space-between is-vertical-align-bottom wp-block-group-is-layout-flex">
<!-- wp:group {$author_row_attrs} -->
<div class="wp-block-group hero-cro__testimonial-meta is-horizontal is-layout-flex is-nowrap is-vertical-align-center wp-block-group-is-layout-flex">
<!-- wp:paragraph {"className":"hero-cro__testimonial-avatar"} -->
<p class="hero-cro__testimonial-avatar">MY</p>
<!-- /wp:paragraph -->

<!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group is-layout-flow wp-block-group-is-layout-flow">
<!-- wp:paragraph {"className":"hero-cro__testimonial-name"} -->
<p class="hero-cro__testimonial-name">{$name}</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"hero-cro__testimonial-role"} -->
<p class="hero-cro__testimonial-role">{$role}</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:paragraph {"align":"right","className":"hero-cro__testimonial-stars"} -->
<p class="hero-cro__testimonial-stars has-text-align-right"><span class="hero-cro__stars" aria-label="{$aria_stars}">★★★★★</span></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

MARKUP;
}
