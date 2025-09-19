<?php
declare(strict_types=1);

// [kx_reading_time format="%d min read"]
add_shortcode( 'kx_reading_time', function( $atts = [] ) {
    $atts = shortcode_atts( [
        'format' => '%d min read',
    ], $atts, 'kx_reading_time' );

    global $post;
    if ( ! $post instanceof WP_Post ) return '';

    $content = (string) $post->post_content;
    // Count words on stripped content; block rendering not necessary for estimation
    $words = str_word_count( wp_strip_all_tags( $content ) );
    $minutes = max( 1, (int) ceil( $words / 220 ) );

    $text = sprintf( (string) $atts['format'], $minutes );
    return '<span class="reading-time has-small-font-size">' . esc_html( $text ) . '</span>';
} );


