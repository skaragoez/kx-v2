# Project Status

> Last updated: 2026-05-11

## Current Work

**PSI-Performance-Sprint (T008–T011, abgeschlossen 2026-05-11):** Ausgangspunkt war PSI-Score 80 (Desktop) auf komoxti.com. Vier Code-Tasks umgesetzt:

- **T008 — Dashicons dequeuen:** `current_user_can('edit_posts')` Guard in `post-edit-link.php`; `['dashicons']`-Dependency aus `kx-style` entfernt → 34 KiB für Nicht-eingeloggte gespart.
- **T009 — Script defer:** Neue Datei `utilities/inc/performance/inc/script-defer.php` — `script_loader_tag` Filter mit `defer` für `complianz`, `googlesitekit`, `googlesitekit-base`; Doppel-defer-Guard via `str_contains`.
- **T010 — `.htaccess`:** Neue Datei im WP-Root — WordPress Rewrite Rules (vom Liveserver übernommen) + `mod_expires`/`mod_headers` 1 Jahr Cache für CSS, JS, Fonts, Bilder + Security-Header (`X-Frame-Options`, `X-Content-Type-Options`, HSTS, `Referrer-Policy`).
- **T011 — srcset reaktivieren:** `max_srcset_image_width`-Filter entfernt; `medium_large` (768px) wieder aktiv; `1536x1536`/`2048x2048` weiterhin deaktiviert. **Manuell nach Deploy:** „Regenerate Thumbnails" Plugin im WP-Admin ausführen.

Deploy-Paket `kx-full-deploy.zip` erstellt (komplettes Theme + `.htaccess`, ohne `node_modules`).

**Offener Code-Task:** T012 — `app.js` Newsticker DOM-Reads per `requestAnimationFrame` batchen (noch nicht umgesetzt).

Zum Kontext — zuvor abgeschlossen: **T007** (LCP-Bild `loading="eager"` + `fetchpriority`), **T006** (Raleway + CRO-Hero), Portfolio-Patterns, T005 Agentic WordPress.

## Open Items

- **T012** — `app.js` Newsticker: DOM-Reads per `requestAnimationFrame` batchen (Total Blocking Time)
- **Nach Deploy:** „Regenerate Thumbnails" Plugin ausführen (T011 — `medium_large`-Thumbnails fehlen für bestehende Bilder)

## Next Steps

1. Deploy `kx-full-deploy.zip` auf den Server
2. „Regenerate Thumbnails" im WP-Admin ausführen
3. T012 umsetzen (`app.js` DOM-Batching)
4. Manuelle externe Schritte (kein Code):
   - GTM-Tags konsolidieren (4 parallele Scripts → 1)
   - `sener-corporate-id.png` (927 KiB) → WebP neu hochladen
   - CF7 Radio/Checkbox Labels in CF7-Admin ergänzen
   - Farbkontrast Orange-Akzent gegen WCAG AA prüfen

## Known Issues

None documented in this pass.
