<?php
declare(strict_types=1);

// [kx_posts_grid per_page="9" tag=""]
add_shortcode('kx_posts_grid', function(array $atts = []): string {
    $atts = shortcode_atts([
        'per_page' => '9',
        'tag'      => '', // slug or ID
    ], $atts, 'kx_posts_grid');

    $per_page = max(1, (int) $atts['per_page']);
    $active_tag = trim((string) $atts['tag']);
    $nonce = wp_create_nonce('kx_posts_grid');
    $instance_id = uniqid('kxpg_');

    // Build initial query (page 1)
    $query_args = [
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $per_page,
        'paged'          => 1,
    ];

    if ($active_tag !== '') {
        // accept ID or slug
        if (ctype_digit($active_tag)) {
            $query_args['tag_id'] = (int) $active_tag;
        } else {
            $query_args['tag'] = $active_tag;
        }
    }

    $posts_q = new WP_Query($query_args);

    // Tags filter (all tags with at least one post)
    $tags = get_tags(['hide_empty' => true]);

    ob_start();
    ?>
    <div id="<?php echo esc_attr($instance_id); ?>" class="kx-posts-grid" data-per-page="<?php echo esc_attr((string) $per_page); ?>" data-nonce="<?php echo esc_attr($nonce); ?>" data-ajax-url="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
        <?php if ($tags) : ?>
            <div class="kx-posts-grid__filters">
                <a href="javascript:void(0)" rel="tag" role="button" tabindex="0" aria-pressed="<?php echo $active_tag === '' ? 'true' : 'false'; ?>" class="kx-tag <?php echo $active_tag === '' ? 'is-active' : ''; ?>" data-tag="">
                    <?php echo esc_html__('All', 'kx'); ?>
                </a>
                <?php foreach ($tags as $tag) : ?>
                    <a href="javascript:void(0)" rel="tag" role="button" tabindex="0" aria-pressed="<?php echo ((string) $tag->slug === $active_tag || (string) $tag->term_id === $active_tag) ? 'true' : 'false'; ?>" class="kx-tag <?php echo ((string) $tag->slug === $active_tag || (string) $tag->term_id === $active_tag) ? 'is-active' : ''; ?>" data-tag="<?php echo esc_attr($tag->slug); ?>">
                        <?php echo esc_html($tag->name); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="kx-posts-grid__items" data-page="1" data-tag="<?php echo esc_attr($active_tag); ?>">
            <?php echo kx_render_posts_grid_items($posts_q); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        </div>

        <?php if ($posts_q->max_num_pages > 1) : ?>
            <div class="kx-posts-grid__actions">
                <button type="button" class="kx-posts-grid__load-more"><?php echo esc_html__('Load more', 'kx'); ?></button>
            </div>
        <?php endif; ?>
    </div>

    <script>(function(){
        function boot(){ if (window.kxPostsGridInit) { window.kxPostsGridInit(); } }
        if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', boot); else boot();
    })();</script>

    <?php // Behavior is initialized in app.js via kxPostsGridInit() ?>
    <?php
    return ob_get_clean();
});

// AJAX: fetch grid page
add_action('wp_ajax_kx_posts_grid_fetch', 'kx_posts_grid_fetch');
add_action('wp_ajax_nopriv_kx_posts_grid_fetch', 'kx_posts_grid_fetch');
function kx_posts_grid_fetch(): void {
    // Start clean output buffering to avoid stray warnings breaking JSON
    if (!ob_get_level()) { ob_start(); } else { ob_clean(); }
    // Make nonce optional to avoid breaking on cache/mixed contexts
    $nonce_valid = isset($_POST['_ajax_nonce']) && wp_verify_nonce(sanitize_text_field((string) $_POST['_ajax_nonce']), 'kx_posts_grid');

    $paged = isset($_POST['paged']) ? max(1, (int) $_POST['paged']) : 1;
    $per_page = isset($_POST['per_page']) ? max(1, (int) $_POST['per_page']) : 9;
    $tag = isset($_POST['tag']) ? sanitize_text_field((string) $_POST['tag']) : '';

    $args = [
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $per_page,
        'paged'          => $paged,
    ];

    if ($tag !== '') {
        if (ctype_digit($tag)) {
            $args['tag_id'] = (int) $tag;
        } else {
            $args['tag'] = $tag;
        }
    }

    $q = new WP_Query($args);

    // Ensure no stray output
    if (ob_get_length()) { ob_clean(); }
    nocache_headers();
    wp_send_json_success([
        'html' => kx_render_posts_grid_items($q),
        'page' => $paged,
        'has_more' => $q->max_num_pages > $paged,
        'nonce_ok' => $nonce_valid,
    ]);
    wp_die();
}

// Render helper
function kx_render_posts_grid_items(WP_Query $q): string {
    ob_start();
    if ($q->have_posts()) :
        while ($q->have_posts()) : $q->the_post();
            $permalink = get_permalink();
            ?>
            <article class="kx-post-card">
                <a class="kx-post-card__thumb" href="<?php echo esc_url($permalink); ?>">
                    <?php if (has_post_thumbnail()) {
                        the_post_thumbnail('medium_large', ['loading' => 'lazy']);
                    } ?>
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
            </article>
            <?php
        endwhile;
        wp_reset_postdata();
    endif;
    return (string) ob_get_clean();
}


