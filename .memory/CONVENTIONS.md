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

- **Plugin install blocked on production:** The theme used to force **`file_mod_allowed`** off outside local; that hook is gone. If installs still fail, check in order: (1) Latest theme deployed on the server (`utilities/inc/security/inc/file-mods.php` must not contain the old “return false” filter). (2) **`wp-config.php`** / hosting: **`DISALLOW_FILE_MODS`** — WordPress intends this to be lifted by config or deployment policy when dashboard installs should work; hosts that inject it may require SSH/Git deploy instead. (3) Multisite: install plugins often only via **network admin**. (4) Filesystem: **`wp-content/plugins`** writable by PHP; **`FS_METHOD`** / FTP dialogs point to permission or non-direct FS. **WP-CLI (SSH):** `wp eval 'var_export(["file_mod_allowed"=>wp_is_file_mod_allowed("capability_update_core"),"DISALLOW_FILE_MODS"=>defined("DISALLOW_FILE_MODS")&&DISALLOW_FILE_MODS]);'` shows core flags.
- **Hero CRO / `css/components/_content.scss` asset URLs:** The block editor stylesheet is **`css/editor-style.css`** (one directory deeper than root **`style.css`**). Icons or other **`url(...)`** files under **`themes/kx/media/`** must use Sass **`$kx-theme-asset-base`**: **`''`** for the front bundle (**default** at top of `_content.scss`), and **`../`** set in **`utilities/inc/gutenberg/_editor-style.scss`** immediately before **`@import`…`content`** so editor and frontend both resolve **`media/icons/...`** correctly.
- **`.ddev/config.yaml`**: Applies to **local development only**. Adjust PHP/services there when needed for dev; production hosting has its own configuration.
- **i18n**: Theme POT is `languages/kx.pot`; nested packages subtract it to avoid duplicate strings. After changing translatable strings, run `theme:i18n:pot` (and update POs as needed).
- **Compiled assets**: Edits to `css/` or `js/` require `npm run watch` (local) or **`npm run build`** (before shipping / when an agent completes a task). Prefer the **full** `npm run build` from `wp-content/themes/kx` so both compiled `style.css` and `*.min.js` stay in sync.
- **Core directories**: Avoid patching `wp-admin` / `wp-includes`; updates will overwrite them.
- **Secrets**: Never commit real `wp-config.php` credentials or `.env` equivalents.
