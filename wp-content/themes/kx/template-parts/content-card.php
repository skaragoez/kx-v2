<?php
/**
 * Template part for displaying a post in card layout
 *
 * Matches the layout used in the posts grid shortcode
 * (featured image, tags, title, author, date)
 *
 * @package _s
 */

$permalink = get_permalink();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('kx-post-card'); ?>>
    <a class="kx-post-card__thumb" href="<?php echo esc_url($permalink); ?>">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('medium_large', ['loading' => 'lazy']); ?>
        <?php endif; ?>
    </a>
    <div class="kx-post-card__meta">
        <div class="tags-links">
            <?php echo get_the_tag_list('', ''); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        </div>
    </div>
    <h3 class="kx-post-card__title">
        <a href="<?php echo esc_url($permalink); ?>"><?php the_title(); ?></a>
    </h3>
    <div class="kx-post-card__byline">
        <span class="kx-post-card__author"><?php echo esc_html(get_the_author()); ?></span>
        <span class="kx-post-card__date">&middot; <?php echo esc_html(get_the_date()); ?></span>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->


