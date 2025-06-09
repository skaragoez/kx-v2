<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-footer__inner">
			<div class="footer-content">
				<div class="footer-branding">
					<?php if ( has_custom_logo() ) : ?>
						<div class="footer-logo">
							<?php the_custom_logo(); ?>
						</div>
					<?php else : ?>
						<h2 class="footer-logo-text"><?php echo get_bloginfo( 'name' ); ?></h2>
					<?php endif; ?>
					
					<p class="footer-description">
						<?php 
						$footer_description = get_theme_mod( 'footer_description', 'Some footer text about the Agency. Just a little description to help people understand you better' );
						echo esc_html( $footer_description );
						?>
					</p>

					<div class="footer-social">
						<?php 
						// Social media icons - can be customized via theme customizer
						$social_links = array(
							'facebook' => array(
								'url' => get_theme_mod( 'social_facebook', '' ),
								'label' => 'Facebook'
							),
							'twitter' => array(
								'url' => get_theme_mod( 'social_twitter', '' ),
								'label' => 'Twitter'
							),
							'instagram' => array(
								'url' => get_theme_mod( 'social_instagram', '' ),
								'label' => 'Instagram'
							),
							'linkedin' => array(
								'url' => get_theme_mod( 'social_linkedin', '' ),
								'label' => 'LinkedIn'
							),
							'youtube' => array(
								'url' => get_theme_mod( 'social_youtube', '' ),
								'label' => 'YouTube'
							),
							'whatsapp' => array(
								'url' => get_theme_mod( 'social_whatsapp', '' ),
								'label' => 'WhatsApp'
							),
						);
						
						foreach ( $social_links as $platform => $data ) :
							if ( $data['url'] && $data['url'] !== '' ) :
						?>
							<a href="<?php echo esc_url( $data['url'] ); ?>" class="social-link social-<?php echo esc_attr( $platform ); ?>" target="_blank" rel="noopener">
								<span class="screen-reader-text"><?php echo esc_html( $data['label'] ); ?></span>
							</a>
						<?php 
							endif;
						endforeach; 
						?>
					</div>
				</div>

				<div class="footer-contact">
					<h3 class="footer-section-title"><?php _e( 'Kontakt', 'kx' ); ?></h3>
					<div class="footer-contact-info">
						<?php 
						$phone = get_theme_mod( 'footer_phone', '+49 123 456 789' );
						$email = get_theme_mod( 'footer_email', 'info@komoxti.com' );
						
						if ( $phone ) : ?>
							<div class="contact-item">
								<span class="contact-icon phone-icon"></span>
								<a href="tel:<?php echo esc_attr( str_replace( ' ', '', $phone ) ); ?>" class="contact-link">
									<?php echo esc_html( $phone ); ?>
								</a>
							</div>
						<?php endif;
						
						if ( $email ) : ?>
							<div class="contact-item">
								<span class="contact-icon email-icon"></span>
								<a href="mailto:<?php echo esc_attr( $email ); ?>" class="contact-link">
									<?php echo esc_html( $email ); ?>
								</a>
							</div>
						<?php endif; ?>
						
						<?php 
						$footer_address = get_theme_mod( 'footer_address', '' );
						if ( $footer_address ) : ?>
							<div class="contact-item address-item">
								<span class="contact-icon location-icon"></span>
								<div class="contact-text">
									<?php echo nl2br( esc_html( $footer_address ) ); ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<div class="footer-bottom">
				<div class="footer-copyright">
					<?php 
					$copyright_text = get_theme_mod( 'footer_copyright', sprintf( __( 'Copyright %s %d', 'kx' ), get_bloginfo( 'name' ), date( 'Y' ) ) );
					echo esc_html( $copyright_text );
					?>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
