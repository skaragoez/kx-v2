<?php
/**
 * Template for displaying Tag archives
 *
 * Mirrors the blog archive layout: header with tag title/description,
 * then a list of post excerpts and pagination.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

get_header();
?>

	<main id="primary" class="site-main">

		<article class="archive">
			<section class="wp-block-group pb-0 is-layout-constrained wp-block-group-is-layout-constrained">
				<div class="wp-block-group is-nowrap is-layout-flex wp-container-core-group-is-layout-ad2f72ca wp-block-group-is-layout-flex">
					<?php 
						$secondary_logo = get_theme_mod( 'secondary_logo' );
						if ( ! empty( $secondary_logo ) ) : ?>
							<figure class="wp-block-image size-full is-resized ratio-square" style="width:100px">
								<img src="<?php echo esc_url( $secondary_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="secondary-logo ratio-square" style="aspect-ratio:1;object-fit:cover;width:100px" />
							</figure>
						<?php elseif ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
							<figure class="wp-block-image size-full is-resized ratio-square" style="width:100px">
								<?php the_custom_logo(); ?>
							</figure>
						<?php endif; ?>
					<h1 class="wp-block-post-title"><?php printf( esc_html__( 'Articles on %s', 'kx' ), esc_html( single_tag_title( '', false ) ) ); ?></h1>
				</div>
				<?php
					$tag_description = tag_description();
					if ( $tag_description ) :
						echo '<p>' . wp_kses_post( $tag_description ) . '</p>';
					endif;
				?>
			</section>
			<div class="entry-content">
				<section class="wp-block-group">
					<div class="kx-posts-grid">
		<?php if ( have_posts() ) : ?>
			<div class="kx-posts-grid__items">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'card' );
				endwhile;
				?>
			</div>

			<?php
				the_posts_navigation( array(
					'prev_text' => __( 'Older posts', 'kx' ),
					'next_text' => __( 'Newer posts', 'kx' ),
				) );
			?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
					</div>
				</section>
			</div>
		</article>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?>


