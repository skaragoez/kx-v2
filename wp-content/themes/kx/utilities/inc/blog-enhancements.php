<?php
declare(strict_types=1);

// JSON-LD (Article, optional FAQ)
add_action( 'wp_head', function () {
    if ( !is_singular( 'post' ) ) return;
    $post = get_post();
    if ( !$post ) return;

    $author = get_the_author_meta( 'display_name', (int) $post->post_author );
    $logo = get_site_icon_url();
    $publisher = get_bloginfo( 'name' );

    $article = [
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'mainEntityOfPage' => get_permalink( $post ),
        'headline' => wp_strip_all_tags( get_the_title( $post ) ),
        'datePublished' => get_the_date( 'c', $post ),
        'dateModified' => get_the_modified_date( 'c', $post ),
        'author' => [ '@type' => 'Person', 'name' => $author ],
        'publisher' => [ '@type' => 'Organization', 'name' => $publisher, 'logo' => [ '@type' => 'ImageObject', 'url' => $logo ] ],
    ];

    $faq = null;
    // Avoid triggering heavy content filters that might hook back into head or redirects
    $content = $post->post_content;
    if ( function_exists( 'do_blocks' ) ) {
        $content = do_blocks( $content );
    }
    $content = do_shortcode( $content );
    if ( preg_match_all( '/<h[23][^>]*>(.*?)<\\/h[23]>\\s*<p>(.*?)<\\/p>/si', $content, $m ) ) {
        $items = [];
        for ( $i = 0; $i < count( $m[0] ); $i++ ) {
            $q = wp_strip_all_tags( $m[1][ $i ] );
            $a = wp_strip_all_tags( $m[2][ $i ] );
            if ( stripos( $q, 'faq' ) === 0 ) continue;
            if ( mb_strlen( $q ) < 10 || mb_strlen( $a ) < 20 ) continue;
            $items[] = [ '@type' => 'Question', 'name' => $q, 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => $a ] ];
            if ( count( $items ) >= 6 ) break;
        }
        if ( $items ) $faq = [ '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $items ];
    }

    echo '<script type="application/ld+json">' . wp_json_encode( $article, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>';
    if ( $faq ) echo '<script type="application/ld+json">' . wp_json_encode( $faq, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>';
}, 20 );

