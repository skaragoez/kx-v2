<?php
/**
 * The template for displaying the blog posts page
 *
 * This template is used when the "Posts page" is set in Settings > Reading
 * and displays the blog posts with the page content above.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		// First, display the page content (Cover Block, etc.)
		$page_for_posts = get_option( 'page_for_posts' );
		if ( $page_for_posts ) {
			$page_query = new WP_Query( array(
				'post_type' => 'page',
				'p' => $page_for_posts,
			) );
			
			if ( $page_query->have_posts() ) {
				while ( $page_query->have_posts() ) {
					$page_query->the_post();
					get_template_part( 'template-parts/content', 'page' );
				}
				wp_reset_postdata();
			}
		}
		
		// Then display blog posts
		$blog_posts = new WP_Query( array(
			'post_type' => 'post',
			'posts_per_page' => get_option( 'posts_per_page', 10 ),
			'paged' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
		) );

		if ( $blog_posts->have_posts() ) :
			?>
			<div class="blog-posts-section">
				<?php
				while ( $blog_posts->have_posts() ) :
					$blog_posts->the_post();
					// Use excerpt view instead of full content
					get_template_part( 'template-parts/content', 'excerpt' );
				endwhile;
				?>
			</div>
			<?php
			
			// Pagination
			the_posts_navigation( array(
				'prev_text' => __( 'Older posts', 'kx' ),
				'next_text' => __( 'Newer posts', 'kx' ),
			) );
			
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;

		wp_reset_postdata();
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
