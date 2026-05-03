# Architecture

> Auto-generated from codebase scan. Source of truth is the code itself.

## Directory Structure

```
kx-v2/                              # WordPress document root
├── .memory/                        # Canonical project docs for agents & humans (STATUS, tasks, PRDs, plans)
├── tools/
│   └── agentic-wp/                 # Bash + WP-CLI (DDEV) helpers — see README there
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
│   │       ├── media/            # Theme assets: icon font pipeline + SVGs referenced from SCSS (`icons/`…)
│   │       │   ├── fonts/        # Fantasticon / Icont → see AGENTS README
│   │       │   └── icons/        # e.g. `lucide-hero-benefits/` (hero copy benefit tiles)
│   │       ├── languages/        # Translation artifacts
│   │       ├── template-parts/   # Partial templates
│   │       └── functions.php     # Theme setup, customizer, requires utilities
│   ├── plugins/                  # Installed plugins (CF7, slider/Swiper, etc.)
│   ├── uploads/                  # Media (typically not in git)
│   └── upgrade/                  # WP upgrade scratch space
├── wp-config.php                 # DB credentials, salts (environment-specific)
└── index.php                     # Front controller
```

## Agentic WordPress tooling (local)

- **Location:** [tools/agentic-wp/README.md](../tools/agentic-wp/README.md).
- **Purpose:** List/update posts and theme mods via **`ddev wp`** without using wp-admin (agent- and script-friendly).
- **Modules:** `lib/common.sh` (repo root + `ddev wp` wrapper); `post-find.sh`; `post-update-content.sh`; `theme-mod.sh`.
- **Scope:** Local DDEV project only in v1; no credentials in repo; MCP may wrap these commands in a later phase.

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

### CRO hero (hero copy pattern)

- **Markup:** `inc/hero-copy-pattern-markup.php` — single constrained group **`hero-copy hero-cro__inner`**: trust pill, H1, benefits, CTAs, logos, testimonial (no columns, no **`hero hero--cro`** band, no media).
- **Registration:** `inc/register-hero-copy-pattern.php` hooks `init` → pattern **`kx/hero-copy`** in category `kx`. Use inside the existing **`.hero`** two-column row (left column); right column keeps image + **`works-ticker`** unchanged.
- **Styles:** `css/components/_content.scss` — **`.hero .hero-copy`** carries the former **`hero--cro`** CRO rules (spacing, trust pill, benefits-as-row with **`::before`** icon tiles, CTAs, logos, testimonial). Core **`is-layout-constrained`** overrides keep the copy column flush-left (no unintended centered narrow blocks).
- **Hero H1 size:** **`theme.json`** fluid preset **`hero`** feeds the editor; front end also sets **`font-size`** on **`.hero .hero-copy .hero-cro__title`** so it reliably beats global **`h1`** rules in `_elements.scss`.
- **Benefit icons:** Lucide-derived outline SVG files under **`media/icons/lucide-hero-benefits/`**, referenced via `background-image` on **`.hero-cro__benefit--*::before`** (Facts-like light tile + navy hairline frame). Sass variable **`$kx-theme-asset-base`** defaults to **`''`** for root **`style.css`**; **`utilities/inc/gutenberg/_editor-style.scss`** sets **`$kx-theme-asset-base: '../'`** before importing **`content`** so the same URLs resolve from **`css/editor-style.css`**.
- **Mobile (`max-width` below `sm` / 782px):** **`display: flex; flex-direction: column`** + explicit **`order`** on direct children of **`.hero-copy.hero-cro__inner`** places **testimonial before CTAs** while keeping logos after the buttons. Extra **`<p>`** nodes that are neither **`.hero-cro__lead`** nor **`.hero-cro__logos-heading`** (e.g. CTA micro-copy) get **`order: 16`** so they stay **below the buttons** (default flex **`order: 0`** would sort them above **`order: 10–15`** blocks). **CTAs:** ≤376px full-width stacked; 377–781px two equal-width buttons in one row (**`flex: 1 1 0`**).
- **`.hero`** band: **`padding-block-start`** for breathing room below the site header.
- **Visual column (unchanged):** `.hero > .wp-block-columns > .wp-block-column.hero__visual-column` still positions the first featured image; **`.works-ticker`** rules + `app.js` duplication unchanged under **`.hero`**.
- **Typography / loading:** Raleway via **`theme.json`** + enqueue; **`_editor-style.scss`** imports **`content`** for editor parity with the hero copy rules above.

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
