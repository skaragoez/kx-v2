# Project Status

> Last updated: 2026-04-10

## Current Work

**Portfolio grid (Stitch-style, modular patterns):** Implemented — PHP markup in `inc/portfolio-pattern-markup.php`, registration in `inc/register-portfolio-patterns.php`, styles in `css/components/_portfolio-grid.scss` (imported via `css/components/_blocks.scss`, therefore also in the block editor). Patterns: `kx/portfolio-grid-shell`, `kx/portfolio-project-item`, `kx/portfolio-grid-starter`. CSS hooks: `kx-portfolio-grid`, `kx-portfolio-cell`. Optional filters: `kx_portfolio_grid_column_count`, `kx_portfolio_pattern_starter_cell_count`.

Hero benefit icon strip **removed** from theme (no `inc/block-patterns.php`, no related SCSS/PHP). **Content:** Remove the old block row from affected pages in the block editor if it is still stored in the database.

Previously — theme cleanup: `package.json` → **kx**, repo URL `skaragoez/kx-v2`; i18n scripts use `languages/kx.pot`; `--subtract` paths updated (incl. fixes for `accordion`, `data-href`, `bodyclass`). Theme header in `css/style.scss` → **KX**; `style.css` rebuilt. `kx.pot` regenerated; removed stale `languages/_s.pot` and duplicate `tr_TR.pot`. PO headers aligned (`theme:i18n:po` + manual `Project-Id-Version` where needed).

## Open Items

None.

## Next Steps

Ready for development: use theme `npm run watch` under `wp-content/themes/kx/` and follow `.context/` sync rule after substantive edits.

## Known Issues

None documented in this initialization pass.
