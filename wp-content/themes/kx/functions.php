<?php
/**
 * _s functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _s
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function kx_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on _s, use a find and replace
		* to change '_s' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'kx', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in multiple locations.
	register_nav_menus(
		array(
			'navigation' => esc_html__( 'Navigation', 'kx' ),
			'footer' => esc_html__( 'Footer', 'kx' ),
			'footer-legal' => esc_html__( 'Footer Legal', 'kx' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'kx_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'kx_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function kx_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kx_content_width', 640 );
}
add_action( 'after_setup_theme', 'kx_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function kx_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'kx' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'kx' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'kx_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function kx_scripts() {
	wp_enqueue_style( 'kx-style', get_stylesheet_uri(), ['dashicons'] );

	wp_enqueue_script( 'kx-app', get_template_directory_uri() . '/js/app.js', ['behaviours'], false, true );
	wp_enqueue_script( 'kx-navigation', get_template_directory_uri() . '/js/navigation.js', ['behaviours'], false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'kx_scripts' );

/**
 * Get available languages for multilingual footer support.
 */
function kx_get_available_languages() {
	$languages = array();
	
	// Check for Bogo
	if ( function_exists( 'bogo_get_available_languages' ) ) {
		$bogo_languages = bogo_get_available_languages();
		foreach ( $bogo_languages as $lang_code ) {
			$locale_data = bogo_get_language( $lang_code );
			if ( $locale_data ) {
				$languages[ $lang_code ] = $locale_data['native_name'];
			}
		}
	}
	// Fallback to default languages
	else {
		$languages = array(
			'tr' => 'Türkçe',
			'de' => 'Deutsch',
			'en' => 'English',
		);
	}
	
	return $languages;
}

/**
 * Get current language for footer content.
 */
function kx_get_current_language() {
	// Check for Bogo
	if ( function_exists( 'bogo_get_current_locale' ) ) {
		$locale = bogo_get_current_locale();
		return substr( $locale, 0, 2 ); // Get first 2 characters (language code)
	}
	// Fallback to WordPress locale
	else {
		$locale = get_locale();
		return substr( $locale, 0, 2 ); // Get first 2 characters (language code)
	}
}

/**
 * Get multilingual footer content.
 */
function kx_get_footer_content( $field, $default = '' ) {
	$current_lang = kx_get_current_language();
	$setting_name = "footer_{$field}_{$current_lang}";
	
	// Try language-specific setting first
	$content = get_theme_mod( $setting_name );
	
	// Fallback to default field
	if ( empty( $content ) ) {
		$content = get_theme_mod( "footer_{$field}", $default );
	}
	
	return $content;
}

/**
 * Customize the WordPress Customizer for footer settings.
 */
function kx_customize_register( $wp_customize ) {
	$languages = kx_get_available_languages();
	
	// Add Footer Section
	$wp_customize->add_section( 'footer_settings', array(
		'title'    => __( 'Footer Settings', 'kx' ),
		'priority' => 120,
	) );

	// Create language-specific fields
	foreach ( $languages as $lang_code => $lang_name ) {
		// Language separator
		$wp_customize->add_setting( "footer_separator_{$lang_code}", array(
			'sanitize_callback' => 'sanitize_text_field',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, "footer_separator_{$lang_code}", array(
			'label'       => sprintf( __( '— %s Footer Content —', 'kx' ), $lang_name ),
			'section'     => 'footer_settings',
			'type'        => 'hidden',
		) ) );

		// Footer Description per language
		$default_desc = '';
		if ( $lang_code === 'tr' ) {
			$default_desc = 'Ajans hakkında kısa bir metin. Bizi daha iyi anlamanıza yardımcı olacak küçük bir açıklama.';
		} elseif ( $lang_code === 'de' ) {
			$default_desc = 'Ein kurzer Text über die Agentur. Nur eine kleine Beschreibung, um Ihnen zu helfen, uns besser zu verstehen.';
		} else {
			$default_desc = 'Some footer text about the Agency. Just a little description to help people understand you better';
		}

		$wp_customize->add_setting( "footer_description_{$lang_code}", array(
			'default'           => $default_desc,
			'sanitize_callback' => 'sanitize_textarea_field',
		) );

		$wp_customize->add_control( "footer_description_{$lang_code}", array(
			'label'       => sprintf( __( 'Footer Description (%s)', 'kx' ), $lang_name ),
			'section'     => 'footer_settings',
			'type'        => 'textarea',
		) );

		// Footer Phone per language
		$default_phone = '';
		if ( $lang_code === 'tr' ) {
			$default_phone = '+90 212 123 4567';
		} elseif ( $lang_code === 'de' ) {
			$default_phone = '+49 123 456 789';
		} else {
			$default_phone = '+1 555 123 4567';
		}
		
		$wp_customize->add_setting( "footer_phone_{$lang_code}", array(
			'default'           => $default_phone,
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( "footer_phone_{$lang_code}", array(
			'label'   => sprintf( __( 'Phone Number (%s)', 'kx' ), $lang_name ),
			'section' => 'footer_settings',
			'type'    => 'text',
		) );

		// Footer Email per language
		$default_email = '';
		if ( $lang_code === 'tr' ) {
			$default_email = 'info@komoxti.com.tr';
		} elseif ( $lang_code === 'de' ) {
			$default_email = 'info@komoxti.de';
		} else {
			$default_email = 'info@komoxti.com';
		}
		
		$wp_customize->add_setting( "footer_email_{$lang_code}", array(
			'default'           => $default_email,
			'sanitize_callback' => 'sanitize_email',
		) );

		$wp_customize->add_control( "footer_email_{$lang_code}", array(
			'label'   => sprintf( __( 'Email Address (%s)', 'kx' ), $lang_name ),
			'section' => 'footer_settings',
			'type'    => 'email',
		) );

		// Footer Address per language
		$wp_customize->add_setting( "footer_address_{$lang_code}", array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_textarea_field',
		) );

		$wp_customize->add_control( "footer_address_{$lang_code}", array(
			'label'   => sprintf( __( 'Address (%s)', 'kx' ), $lang_name ),
			'section' => 'footer_settings',
			'type'    => 'textarea',
		) );
	}

	// Footer Copyright (shared)
	$wp_customize->add_setting( 'footer_copyright', array(
		/* translators: 1: site name, 2: current year */
		'default'           => sprintf( __( 'Copyright %1$s %2$d', 'kx' ), get_bloginfo( 'name' ), date( 'Y' ) ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'footer_copyright', array(
		'label'       => __( 'Copyright Text (All Languages)', 'kx' ),
		'description' => __( 'This text will be automatically translated.', 'kx' ),
		'section'     => 'footer_settings',
		'type'        => 'text',
	) );

	// Social Media Section
	$wp_customize->add_section( 'social_media', array(
		'title'    => __( 'Social Media Links', 'kx' ),
		'priority' => 121,
	) );

	// Social Media Links
	$social_platforms = array(
		'facebook'  => 'Facebook',
		'twitter'   => 'Twitter',
		'instagram' => 'Instagram',
		'linkedin'  => 'LinkedIn',
		'youtube'   => 'YouTube',
		'whatsapp'  => 'WhatsApp',
	);

	foreach ( $social_platforms as $platform => $label ) {
		$wp_customize->add_setting( "social_{$platform}", array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		) );

		$wp_customize->add_control( "social_{$platform}", array(
			/* translators: %s: social media platform name */
			'label'   => sprintf( __( '%s URL', 'kx' ), $label ),
			'section' => 'social_media',
			'type'    => 'url',
		) );
	}
}
add_action( 'customize_register', 'kx_customize_register' );

// auto-include theme's /inc/ files see utilities/auto-include-files.php
require_once get_template_directory() . '/utilities/utilities.php';
auto_include_files( get_template_directory() . '/media/fonts' );

// Globally enforce avatar dimensions to 60x60px
add_filter( 'get_avatar_data', function( array $args ) : array {
	$args['size'] = 60;
	$args['width'] = 60;
	$args['height'] = 60;
	return $args;
}, 10 );
