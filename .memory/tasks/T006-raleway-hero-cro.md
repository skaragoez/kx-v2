# T006 — Raleway for headings + CRO-focused Hero

## Status

- [ ] open

## Goal

1. **Typography:** Replace **Poppins** with **Raleway** for heading stacks across the theme (including any hard-coded fallbacks).
2. **Hero / CRO:** Redesign the hero experience to be **more conversion-oriented**: prominent **customer benefits** (e.g. checklist or bullet row) and **trust elements** (e.g. logo strip, badges, short social proof — exact composition to finalize during implementation).

## Technical starting points

- Heading token: [`wp-content/themes/kx/css/_variables.scss`](../../wp-content/themes/kx/css/_variables.scss) — `$font-family-heading`
- Hardcoded Poppins: [`wp-content/themes/kx/css/components/_header.scss`](../../wp-content/themes/kx/css/components/_header.scss) (and grep for `Poppins`)
- Font loading: [`wp-content/themes/kx/media/fonts/fonts.php`](../../wp-content/themes/kx/media/fonts/fonts.php) (Typekit filter) — ensure Raleway is **actually loaded** (kit update or `wp_enqueue_style` for a self-hosted/Google subset, per license/performance).
- Hero band: [`.hero` in `_content.scss`](../../wp-content/themes/kx/css/components/_content.scss)
- Patterns reference: [`inc/register-portfolio-patterns.php`](../../wp-content/themes/kx/inc/register-portfolio-patterns.php) — mirror pattern for a **hero starter** if using block patterns.
- Editor: consider [`theme.json`](../../wp-content/themes/kx/theme.json) `fontFamilies` for parity (currently empty).

## Acceptance criteria

- [ ] All heading typography uses Raleway (or documented stack with Raleway first); no stray Poppins for headings.
- [ ] Font loads on front and in the block editor (no silent fallback to system sans only).
- [ ] Hero layout implements benefits + trust block structure; usable in editor; matches front within normal block parity expectations.
- [ ] `npm run build` (theme) run after SCSS/JS changes; no major CLS or a11y regression (contrast, focus).
- [ ] `.memory/STATUS.md` (and `ARCHITECTURE.md` if new patterns) updated after ship.

## References

- Grill-Me decisions: CRO hero (benefits + trust), Poppins → Raleway
