# AGENTS.md — KX (kx-v2)

## Project Overview

KX is a premium, conversion-focused WordPress theme (Underscores-based) for professional business sites. The repository contains a full WordPress install; active product work lives under `wp-content/themes/kx/` and selected plugins. Primary business goal: strong lead generation and a polished marketing presence (social → site → lead).

## Tech Stack

| Layer | Technology |
|-------|------------|
| CMS | WordPress (full codebase in repo) |
| Theme | KX (`wp-content/themes/kx/`), based on [_s](https://underscores.me/) |
| Language (server) | PHP 7.4+ |
| Styling | SCSS (Dart Sass), fluid typography, BEM-like nesting |
| Client JS | ES6+ → Babel (`@babel/preset-env`, minify in production) |
| Icons | Fantasticon (SVG → icon font in `media/fonts/Icont/`) |
| Local dev (only) | `.ddev/config.yaml` — environment/service settings for developers; not documented in depth in AGENTS |
| Database | MySQL 8.0+ or MariaDB 10.5+ |
| Build / DX | npm scripts, Browser-Sync, PostCSS/Autoprefixer where configured |
| Deployment | Not specified in-repo; infer from your hosting pipeline |

## Project Structure

```
kx-v2/                          # WordPress root
├── .ddev/
│   └── config.yaml             # Dev-only: important local environment setup (see file; no DDEV deep-dive here)
├── wp-admin/                   # Core — do not customize
├── wp-includes/                # Core — do not customize
├── wp-content/
│   ├── themes/kx/              # Main theme (KX): SCSS, JS, templates, utilities
│   └── plugins/                # Site plugins (CF7, slider, etc.)
├── wp-config.php               # Environment config (never commit secrets)
└── README.md                   # Setup, commands, conventions
```

→ Details: [.context/ARCHITECTURE.md](.context/ARCHITECTURE.md)

## Architecture Principles

- Treat WordPress core as read-only; extend via theme, child theme patterns, and plugins.
- Central theme bootstrap: `functions.php` loads `utilities/utilities.php`, which auto-includes PHP under `utilities/inc/`, theme `inc/`, and related paths.
- Front-end assets for the theme are built from `css/` and `js/` via npm; ship minified `.min.js` and compiled `style.css`.
- Prefer WordPress hooks, sanitization, and APIs over ad-hoc queries or raw output.
- Third-party plugin behavior is integrated via theme/utility code and enqueue order — coordinate changes with plugin expectations (e.g. Contact Form 7, Swiper/slider).
- Developer machines: local stack tuning belongs in `.ddev/config.yaml` (development only; production is separate).

→ Details: [.context/ARCHITECTURE.md](.context/ARCHITECTURE.md)

## Coding Conventions

- PHP: WordPress Coding Standards; theme text domain `kx`; prefixed functions like `kx_*` where established.
- SCSS: entry `css/style.scss` → compiled `style.css`; shared tokens in `css/_variables.scss`.
- JS: source in `js/`; Babel outputs `*.min.js` beside sources; keep breakpoints aligned with SCSS where duplicated (e.g. Swiper).
- i18n: POT/PO/MO via `wp i18n` scripts in theme `package.json`; master catalog `languages/kx.pot`.
- Project Cursor rules: `.cursor/rules/wordpress.mdc`, `development.mdc`, `underscores.mdc`, `backup-process.mdc`.

→ Details: [.context/CONVENTIONS.md](.context/CONVENTIONS.md)

## Critical Rules

- **DO NOT** commit database dumps, full `backup/` trees, or secrets; keep `wp-config.php` credentials out of version control if applicable.
- **DO NOT** edit files under `wp-admin/` or `wp-includes/` for feature work — use theme/plugins/hooks.
- **DO** run theme build (`npm run build` or `watch`) after SCSS/JS changes intended for production.
- **DO** follow **README** and `.cursor/rules/backup-process.mdc` for backups and DB work on your local machine.
- Align Swiper/breakpoint numbers in JS with SCSS breakpoints to avoid layout drift.

## Scripts & Commands

| Command | Purpose |
|---------|---------|
| `cd wp-content/themes/kx && npm install` | Install theme Node dependencies |
| `npm run watch` | SCSS + JS watch + Browser-Sync (see theme `package.json`) |
| `npm run build` | Production CSS + JS |
| `npm run theme:build:scss` / `theme:build:js` | Build CSS or JS only |
| `npm run icont:generate` | Regenerate icon font from SVGs |
| `npm run theme:i18n:pot` (etc.) | i18n POT/PO/MO generation |

Local stack commands (e.g. WP-CLI, snapshots): **README** — not duplicated here.

## Documentation Sync

After any substantive change, update all affected files:

| File | Update when... |
|------|----------------|
| `.context/STATUS.md` | Always — current work, open items, next steps |
| `.context/ARCHITECTURE.md` | New components, changed structure, new patterns |
| `.context/DECISIONS.md` | Architectural choices with trade-offs |
| `.context/CONVENTIONS.md` | New coding rules, pitfalls discovered |
| `.context/TASKS.md` | Task tracking/doc updates when task overview or statuses change |
| `AGENTS.md` | Tech stack changes, new critical rules |

A change is NOT complete until all affected documentation is in sync.

## Source of Truth

When documentation conflicts with code, the **code is the source of truth**. Inspect the actual codebase when in doubt.

Hierarchy: Code > AGENTS.md > .context/ files

## Key References

| Document | Purpose |
|----------|---------|
| `.context/STATUS.md` | Current work state, open items, next steps |
| `.context/ARCHITECTURE.md` | Detailed architecture, patterns, data flow |
| `.context/DECISIONS.md` | Architectural decision log |
| `.context/CONVENTIONS.md` | Coding standards, examples, pitfalls |
