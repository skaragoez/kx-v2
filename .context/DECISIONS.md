# Decision Log

Architectural decisions and their rationale. Newest first.

| Date | Decision | Rationale |
|------|----------|-----------|
| 2026-04-10 | Portfolio cells: flat presentation (no card padding/background/shadow, no hover animation); grid `row-gap: 5rem` | Editorial preference for a cleaner grid; `!important` on a few properties overrides Gutenberg inline spacing/shadow when classes `kx-portfolio-grid` / `kx-portfolio-cell` are used. |
| 2026-04-07 | Align npm metadata and i18n scripts with `kx`; master POT `languages/kx.pot`; fix subtract paths for deep Gutenberg packages | Removes leftover `_s` naming; single source for theme strings; corrected `../../../../` paths to theme `languages/`. |
| 2026-04-07 | Point agents at `.ddev/config.yaml` for dev env; no DDEV deep-dive in AGENTS | Keeps documentation thin; important local setup stays in one YAML file; README retains commands. |
| 2026-04-07 | Document Underscores-style theme + separate `utilities/` layer | Codebase uses `_s`-derived theme layout with an additional `utilities/` package for shared enqueue, auto-includes, and cross-cutting PHP/JS — centralizes extension without bloating `functions.php`. |
| 2026-04-07 | SCSS + Babel + Browser-Sync for theme assets | `package.json` uses Dart Sass, Babel with env + minify presets, and Browser-Sync — fits classic WordPress theme workflow without a heavy JS framework. |
| 2026-04-07 | Fantasticon for icons | README and `icont:generate` script indicate SVG → icon font workflow for consistent iconography. |
