# Project Status

> Last updated: 2026-04-10

## Current Work

**Portfolio grid (Stitch-style, modular patterns):** Shipped — same PHP/registration paths as above. **Theme CSS (current):** outer grid `row-gap: 5rem`; column rhythm still from helper `c-gap-5` on the outer group. Cells (`.kx-portfolio-cell`): no padding, background, or box-shadow (including overrides for editor block spacing); no hover motion or hover fill; `:focus-within` keeps an orange outline for keyboard users. Image block: square crop via `aspect-ratio`, rounded corners. Patterns: `kx/portfolio-grid-shell`, `kx/portfolio-project-item`, `kx/portfolio-grid-starter`. Hooks: `kx_portfolio_grid_column_count`, `kx_portfolio_pattern_starter_cell_count`.

Hero benefit icon strip **removed** from theme (no `inc/block-patterns.php`, no related SCSS/PHP). **Content:** Remove the old block row from affected pages in the block editor if it is still stored in the database.

Previously — theme cleanup: `package.json` → **kx**, repo URL `skaragoez/kx-v2`; i18n scripts use `languages/kx.pot`; `--subtract` paths updated (incl. fixes for `accordion`, `data-href`, `bodyclass`). Theme header in `css/style.scss` → **KX**; `style.css` rebuilt. `kx.pot` regenerated; removed stale `languages/_s.pot` and duplicate `tr_TR.pot`. PO headers aligned (`theme:i18n:po` + manual `Project-Id-Version` where needed).

## Open Items

None.

## Next Steps

Portfolio: optional manual QA on real content (breakpoints, editor vs. front). Further theme work: `npm run watch` under `wp-content/themes/kx/`; keep `.context/` in sync after substantive edits (see `AGENTS.md`).

## Known Issues

None documented in this initialization pass.
