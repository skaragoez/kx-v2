# Architecture

> Auto-generated from codebase scan. Source of truth is the code itself.

## Directory Structure

```
kx-v2/                              # WordPress document root
├── .ddev/
│   └── config.yaml                 # Dev-only: local environment / services (authoritative for dev tuning)
├── wp-admin/                       # WordPress core (admin)
├── wp-includes/                    # WordPress core (runtime, blocks, etc.)
├── wp-content/
│   ├── themes/
│   │   └── kx/                   # KX theme
│   │       ├── css/              # SCSS sources; `style.scss` → root `style.css`
│   │       ├── js/               # ES6+ sources; Babel emits `*.min.js`
│   │       ├── inc/              # Theme PHP partials (auto-included)
│   │       ├── utilities/        # Shared theme framework: enqueue, Gutenberg helpers, libs
│   │       │   ├── utilities.php # Boot: defines constants, auto_include_files for inc/, libs
│   │       │   ├── inc/          # Feature modules (security, dev tools, Gutenberg, etc.)
│   │       │   └── js/           # behaviours, helpers, vendor libs
│   │       ├── media/fonts/      # Icon font pipeline (Icont + Fantasticon)
│   │       ├── languages/        # Translation artifacts
│   │       ├── template-parts/   # Partial templates
│   │       └── functions.php     # Theme setup, customizer, requires utilities
│   ├── plugins/                  # Installed plugins (CF7, slider/Swiper, etc.)
│   ├── uploads/                  # Media (typically not in git)
│   └── upgrade/                  # WP upgrade scratch space
├── wp-config.php                 # DB credentials, salts (environment-specific)
└── index.php                     # Front controller
```

## Data Flow

1. **Page request** → WordPress bootstrap → theme (`kx`) templates.
2. **Theme setup** → `functions.php` registers supports, menus, customizer settings; loads `utilities/utilities.php`.
3. **Utilities** → `auto_include_files()` pulls in PHP from `utilities/inc/`, theme `inc/`, and plugin bridges; scripts/styles enqueued on `wp_enqueue_scripts` / `admin_enqueue_scripts`.
4. **Front end** → Compiled `style.css` and `*.min.js` handle layout, sliders (Swiper events from plugin/theme), forms (CF7 DOM enhancements in `app.js`), newsticker/CTA behavior as implemented in theme JS.
5. **Content** → Posts/pages and Gutenberg blocks; theme SCSS under `css/components/` maps to block and section styling.

### Portfolio grid (block patterns)

- **Markup (single source):** `inc/portfolio-pattern-markup.php` builds serialized block strings for the outer grid (`kx-portfolio-grid` + `c-gap-5`) and inner cells (`kx-portfolio-cell`).
- **Registration:** `inc/register-portfolio-patterns.php` hooks `init`, registers pattern category `kx`, and three patterns: `kx/portfolio-grid-shell`, `kx/portfolio-project-item`, `kx/portfolio-grid-starter`.
- **Styles:** `css/components/_portfolio-grid.scss`, pulled in through `css/components/_blocks.scss` (same partial is imported by `utilities/inc/gutenberg/_editor-style.scss` for editor parity).
- **Layout / look (as implemented):** `.kx-portfolio-grid` grid uses `row-gap: 5rem` (explicit vertical rhythm); horizontal gap remains the `c-gap-5` utility on the outer group. `.kx-portfolio-grid > .wp-block-group.kx-portfolio-cell` is intentionally minimal: transparent background, no box-shadow, `padding: 0` (with `!important` where needed to beat block inline spacing), no hover animation or hover background; `:focus-within` outline for accessibility. Inner `.wp-block-image` gets border-radius, overflow clip, and square `aspect-ratio` + `object-fit: cover` on `img`. Below the `sm` breakpoint the grid is forced to one column.

## State Management

No SPA framework: state is **server-rendered WordPress** plus **DOM-oriented JavaScript** (event listeners, observers, CF7 hooks). Admin/session state is WordPress core. Customizer options persist in the database via WordPress APIs.

## Key Patterns

- **Auto-include pattern**: `utilities/auto-include-files.php` loads PHP modules from convention-based directories — new features often add a file under `utilities/inc/` or `inc/` rather than a single giant `functions.php`.
- **Asset pipeline**: Sass compiles from `css/style.scss`; Babel transpiles `js/*.js` to co-located `*.min.js` (watch mode keeps source maps).
- **Plugin integration**: e.g. Contact Form 7 — theme JS enhances `.wpcf7` markup; Slider plugin provides Swiper — theme listens for `swiper:afterInit` to adjust breakpoints.

## API / Backend Integration

WordPress REST API and admin-ajax may be used by plugins/utilities where present; primary “API” for the theme is **WordPress APIs (template hierarchy, `WP_Query`, Customizer, hooks)**. No separate Node backend in-repo.

## Infrastructure & Deployment

- **Local (development)**: `.ddev/config.yaml` is where project-specific dev environment settings live. This file is the reference for developers; AGENTS does not reproduce or explain the tooling in detail. Operational commands (CLI, backups) stay in **README** and `.cursor/rules/backup-process.mdc`.
- **Production**: Not defined in repository files scanned; deployment is environment-specific — do not assume production matches `.ddev/config.yaml`.
