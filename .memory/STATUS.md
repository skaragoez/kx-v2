# Project Status

> Last updated: 2026-05-04

## Current Work

**Admin Dateiänderungen (2026-05-04):** Keine theme-seitige **`file_mod_allowed`**-Sperre mehr in **`utilities/inc/security/inc/file-mods.php`**; Plugin-/Theme-Installation richtet sich nach WordPress und **`wp-config.php`**. Decision Log: **`.memory/DECISIONS.md`**; Pattern: **`ARCHITECTURE.md`** → Key Patterns; Troubleshooting: **`.memory/CONVENTIONS.md`** (Gotchas).

Zum Kontext — zuletzt abgeschlossen: **T006** (Hero-Copy) und Portfolio-Patterns; Details unten.

**T006 — Raleway + CRO-Hero (abgeschlossen):** **`kx/hero-copy`** — Registrierung/Markup wie zuvor. Zusätzlich umgesetzt (Stand 2026-05-03):

- **Layout / Core:** Overrides für **`is-layout-constrained`** auf **`.hero .hero-copy`** (kein „pseudo-zentrierter“ schmaler H1‑Block durch `margin-inline: auto`; Lead/Stack linksbündig).
- **Typo Hero-H1:** **`theme.json`** Preset Hero fluid (min/max); **Frontend** zusätzlich explizites **`font-size`** in SCSS (`!important`), weil globales `h1` in **`_elements.scss`** und Reihenfolge der Stylesheets das Preset sonst kaum sichtbar machen.
- **Spacing:** weniger Unterabstand Benefits/innen; **`margin-block-end: 0`** auf **`.hero-copy`**; **`padding-block-start`** auf **`.hero`** für Abstand unter Header.
- **Benefits-Icons:** statische **[Lucide](https://lucide.dev/)**-SVGs unter **`themes/kx/media/icons/lucide-hero-benefits/`**, Outline/Stil näher an Facts; Kachel **`$light-sky`** + dezenter Rahmen. **`$kx-theme-asset-base`** in **`_content.scss`** (`''`) / **`utilities/inc/gutenberg/_editor-style.scss`** (`../`) damit **`editor-style.css`** dieselben `url(...)` korrekt auflöst.
- **Testimonial:** dezentere Card (halbtransparent, leichter Schatten/Rahmen, kleineres Zitat‑Glyph, keine Kursiven auf dem Quote, gedämpfte Sterne/Avatar).
- **Mobile (< `sm`, 782px):** **Flex-`order`** auf **`.hero-copy.hero-cro__inner`** — Testimonial **über** CTAs; Logos weiter **unter** den Buttons. Zusätzliche **`<p>`** ohne **`.hero-cro__lead`** / **`.hero-cro__logos-heading`** (z. B. CTA-Micro-Copy) erhalten **`order: 16`**, damit sie nicht mit Standard-**`order: 0`** vor dem Trust-Pill landen. **CTAs:** ≤376px volle Breite gestapelt; 377–781px zwei **gleich breite** Buttons nebeneinander.

**Portfolio grid (Stitch-style, modular patterns):** Shipped — outer grid `row-gap: 5rem`; **`c-gap-5`** horizontal rhythm; cells **`.kx-portfolio-cell`** minimal (no hover fill); patterns `kx/portfolio-grid-shell`, `kx/portfolio-project-item`, `kx/portfolio-grid-starter`.

Previously — theme cleanup: `package.json` → **kx**, i18n `languages/kx.pot`; **Agentic WordPress (T005):** [`tools/agentic-wp/`](../tools/agentic-wp/).

## Open Items

_None._

## Next Steps

Optional: weitere QA (echte Geräte, Editor vs. Frontend, Cache/CDN nach Deploy). Bei neuen Icons im gleichen Pfad weiterhin **`npm run build`** unter **`wp-content/themes/kx/`**.

## Known Issues

None documented in this pass.
