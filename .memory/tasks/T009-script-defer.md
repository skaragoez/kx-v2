## Status

[ ] open

## What to build

Neue PHP-Datei `utilities/inc/performance/inc/script-defer.php` anlegen, die via `script_loader_tag` Filter schwere Plugin-Scripts (Complianz, Google Site Kit) mit `defer` ausstattet, damit sie den Hauptthread nicht blockieren.

Total Blocking Time aktuell: **410 ms** (ROT). Complianz und Google Site Kit tragen erheblich dazu bei.

Referenz: Plan-Abschnitt „Fix C" in `.claude/plans/hier-ist-die-precious-scone.md`.

## Acceptance criteria

- [ ] Datei `utilities/inc/performance/inc/script-defer.php` existiert
- [ ] Filter prüft per `str_contains( $tag, 'defer' )` auf Doppel-Attribute
- [ ] Initial-Handles: `complianz`, `googlesitekit`, `googlesitekit-base`
- [ ] DevTools → Sources → `complianz.min.js` Script-Tag enthält `defer`
- [ ] Seite lädt korrekt (kein JS-Fehler durch falsches Defer-Timing)
