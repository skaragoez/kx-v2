## Status

[x] completed

## What to build

`utilities/inc/performance/inc/srcset.php` anpassen: Der `max_srcset_image_width`-Filter (Zeilen 26-28), der srcset global deaktiviert, wird entfernt. Zusätzlich `medium_large` (768 px) in `intermediate_image_sizes_advanced` reaktivieren, da das die häufigste srcset-Zwischengröße ist.

PSI meldet Portfolio-Bilder als massiv übergroß (1920×1080 geladen, ~348×196 angezeigt). Srcset war explizit deaktiviert.

Nach dem Code-Fix müssen bestehende Bilder neu generiert werden:
`ddev wp media regenerate --yes`

Referenz: Plan-Abschnitt „Fix E" in `.claude/plans/hier-ist-die-precious-scone.md`.

## Acceptance criteria

- [x] `max_srcset_image_width` Filter entfernt
- [x] `medium_large` in `intermediate_image_sizes_advanced` nicht mehr entfernt
- [ ] `ddev wp media regenerate --yes` erfolgreich ausgeführt
- [ ] DevTools → Portfolio-Bild → `<img>`-Tag enthält `srcset` mit mehreren Größen
- [ ] Seite lädt korrekte Bildgröße je nach Viewport (Network-Tab → Bild-URL enthält `-348x` o.ä.)
