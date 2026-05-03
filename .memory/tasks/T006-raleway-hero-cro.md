# T006 — Raleway for headings + CRO-focused Hero

## Status

- [x] completed

## Goal

1. **Typography:** Replace **Poppins** with **Raleway** for heading stacks across the theme (including any hard-coded fallbacks).
2. **Hero / CRO:** Redesign the hero experience to be **more conversion-oriented**: prominent **customer benefits** (e.g. checklist or bullet row) and **trust elements** (e.g. logo strip, badges, short social proof — exact composition to finalize during implementation).

## Technical starting points

- Heading token: [`wp-content/themes/kx/css/_variables.scss`](../../wp-content/themes/kx/css/_variables.scss) — `$font-family-heading`
- ~~Hardcoded Poppins~~: [`wp-content/themes/kx/css/components/_header.scss`](../../wp-content/themes/kx/css/components/_header.scss) — aligned with `$font-family-heading`.
- Font loading: [`wp-content/themes/kx/media/fonts/fonts.php`](../../wp-content/themes/kx/media/fonts/fonts.php) — Google Fonts stylesheet for **Raleway** (front + editor); optional Typekit still supported via filter.
- Hero / CRO copy: [`.hero .hero-copy` in `_content.scss`](../../wp-content/themes/kx/css/components/_content.scss)
- Pattern registration: [`inc/register-hero-copy-pattern.php`](../../wp-content/themes/kx/inc/register-hero-copy-pattern.php) — **`kx/hero-copy`**; markup [`inc/hero-copy-pattern-markup.php`](../../wp-content/themes/kx/inc/hero-copy-pattern-markup.php).
- Editor: [`theme.json`](../../wp-content/themes/kx/theme.json) `fontFamilies` (Raleway) + palette `cro-orange` / `cro-navy`; `_editor-style.scss` imports **`content`** partial for hero parity.

## Acceptance criteria

- [x] All heading typography uses Raleway (or documented stack with Raleway first); no stray Poppins for headings.
- [x] Font loads on front and in the block editor (Google Fonts enqueue + `add_editor_style`).
- [x] Hero copy pattern (`kx/hero-copy`): benefits + trust; in editor usable inside existing `.hero` column layout.
- [x] `npm run build` (theme) run after SCSS/JS changes.
- [x] `.memory/STATUS.md` and `ARCHITECTURE.md` updated after ship.

## Post-ship polish (same track, 2026-05)

- Constrained-layout flush-left overrides; hero top padding; CRO headline fluid + SCSS fallback size.
- Benefit icons → `media/icons/lucide-hero-benefits/`; `$kx-theme-asset-base` for editor stylesheet paths.
- Testimonial card toned down for a subtler hero band.
- Mobile: testimonial order above CTAs; CTA breakpoints (full-width stack vs two equal columns).

## References

- Grill-Me decisions: CRO hero (benefits + trust), Poppins → Raleway
