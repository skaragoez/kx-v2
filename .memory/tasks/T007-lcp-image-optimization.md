## Status

[x] completed

## What to build

Neue PHP-Datei `utilities/inc/performance/inc/lcp-image.php` anlegen, die via `render_block` Filter den ersten `core/image` Block auf der Seite von `loading="lazy"` auf `loading="eager"` umstellt und `fetchpriority="high"` ergänzt.

Das Hero-Bild (hero-2.webp) wird im Block-Editor eingefügt und bekommt von WordPress automatisch `loading="lazy"` — das verzögert den LCP um ~1.030 ms. Da der Auto-Include-Mechanismus alle PHP-Dateien unter `utilities/inc/` lädt, ist keine weitere Registrierung notwendig.

Referenz: Plan-Abschnitt „Fix A" in `.claude/plans/hier-ist-die-precious-scone.md`.

## Acceptance criteria

- [ ] Datei `utilities/inc/performance/inc/lcp-image.php` existiert
- [ ] Filter zählt per `static $count` — nur der erste `core/image` Block wird modifiziert
- [ ] Filter greift nicht im Admin (`is_admin()` Guard)
- [ ] DevTools → Elements → Hero-`<img>` trägt `loading="eager"` und `fetchpriority="high"`
- [ ] Andere Bilder auf der Seite behalten `loading="lazy"`
