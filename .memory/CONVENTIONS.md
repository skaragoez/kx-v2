# Coding Conventions

## Naming

- **Theme functions**: Prefix with `kx_` for setup and customize callbacks (e.g. `kx_setup`, `kx_customize_register`).
- **Text domain**: `kx` for theme strings (`load_theme_textdomain( 'kx', … )`).
- **Utilities**: Separate text domain `utilities` for utilities package strings.
- **Files**: WordPress norms — lowercase PHP templates, theme partials under `template-parts/` and `inc/`.

## Imports

- **PHP**: `require_once get_template_directory() . '/…'` for theme paths; utilities use `UTILITIES_DIRECTORY` constants.
- **JS/CSS**: Registered and enqueued via `wp_enqueue_script` / `wp_enqueue_style` with dependency arrays; theme `package.json` drives build, not ES modules in the browser for the main theme bundle.

## Code Style

- **PHP**: Follow WordPress Coding Standards; project rules suggest `declare(strict_types=1);` where appropriate (see `.cursor/rules/wordpress.mdc`).
- **SCSS**: Variables in `_variables.scss`; component partials under `css/components/`; BEM-like nesting per README.
- **JavaScript**: ES6+ in source files; Babel targets environments via `@babel/preset-env`; production build minifies with `babel-preset-minify`.

## Patterns & Examples

**Customizer**: Footer, social URLs, secondary logo, and related fields are registered in `functions.php` via `kx_customize_register` with `sanitize_text_field`, `esc_url_raw`, etc.

**Auto-include** (conceptual):

```php
// From utilities/utilities.php — modules loaded by convention
auto_include_files( UTILITIES_DIRECTORY . '/inc' );
auto_include_files( get_template_directory() . '/inc' );
```

**Breakpoint alignment**: Swiper breakpoint objects in `js/app.js` mirror SCSS `$breakpoints` (e.g. 782, 1030, 1230) — change both when adjusting responsive behavior.

## Pitfalls & Gotchas

- **`.ddev/config.yaml`**: Applies to **local development only**. Adjust PHP/services there when needed for dev; production hosting has its own configuration.
- **i18n**: Theme POT is `languages/kx.pot`; nested packages subtract it to avoid duplicate strings. After changing translatable strings, run `theme:i18n:pot` (and update POs as needed).
- **Compiled assets**: Edits to `css/` or `js/` require `npm run watch` or `npm run build` for changes to appear if the server serves compiled `style.css` and `*.min.js`.
- **Core directories**: Avoid patching `wp-admin` / `wp-includes`; updates will overwrite them.
- **Secrets**: Never commit real `wp-config.php` credentials or `.env` equivalents.
