# Decision Log

Architectural decisions and their rationale. Newest first.

| Date | Decision | Rationale |
|------|----------|-----------|
| 2026-05-03 | Hero copy benefits: bundled Lucide (ISC-style) SVGs + `$kx-theme-asset-base`; explicit H1 font-size in SCSS; mobile flex-order (testimonial above CTAs) + stacked vs equal-width CTAs by breakpoint | Reliable styling vs global `h1` and stylesheet order; Facts-like outline icons without npm; editor URL parity without duplicating rules; UX on small screens without reordering serialized block markup. |
| 2026-05-03 | Agentic WP v1: `tools/agentic-wp/` bash scripts wrapping `ddev wp` (post find/update, theme_mod get/set); local-only; MCP deferred | Matches T005 grill: modular CLI, no admin UI, no secrets in Git; MCP can wrap the same commands later. |
| 2026-05-03 | Canonical agent/human docs under `.memory/`; `.context/` deprecated | Aligns with project-memory style hub; single tree for STATUS, ARCHITECTURE, tasks, PRDs, plans; reduces split-brain between tooling docs and repo conventions. |
| 2026-04-10 | Portfolio cells: flat presentation (no card padding/background/shadow, no hover animation); grid `row-gap: 5rem` | Editorial preference for a cleaner grid; `!important` on a few properties overrides Gutenberg inline spacing/shadow when classes `kx-portfolio-grid` / `kx-portfolio-cell` are used. |
| 2026-04-07 | Align npm metadata and i18n scripts with `kx`; master POT `languages/kx.pot`; fix subtract paths for deep Gutenberg packages | Removes leftover `_s` naming; single source for theme strings; corrected `../../../../` paths to theme `languages/`. |
| 2026-04-07 | Point agents at `.ddev/config.yaml` for dev env; no DDEV deep-dive in AGENTS | Keeps documentation thin; important local setup stays in one YAML file; README retains commands. |
| 2026-04-07 | Document Underscores-style theme + separate `utilities/` layer | Codebase uses `_s`-derived theme layout with an additional `utilities/` package for shared enqueue, auto-includes, and cross-cutting PHP/JS — centralizes extension without bloating `functions.php`. |
| 2026-04-07 | SCSS + Babel + Browser-Sync for theme assets | `package.json` uses Dart Sass, Babel with env + minify presets, and Browser-Sync — fits classic WordPress theme workflow without a heavy JS framework. |
| 2026-04-07 | Fantasticon for icons | README and `icont:generate` script indicate SVG → icon font workflow for consistent iconography. |
