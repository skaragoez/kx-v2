## Status

[x] completed

## What to build

Dashicons werden aktuell für **alle** Besucher geladen (34 KiB, 100% ungenutzt). Zwei Stellen müssen gefixt werden:

1. `utilities/inc/post-edit-link/post-edit-link.php` Zeile 6-8: `wp_enqueue_scripts` lädt Dashicons-abhängiges CSS ohne Capability-Check. Fix: `if ( ! current_user_can( 'edit_posts' ) ) return;` Guard.

2. `functions.php` Zeile 138: `kx-style` hat `['dashicons']` als Dependency. Das Theme-CSS nutzt keine Dashicons-Icons. Fix: Dependency-Array auf `[]` leeren.

Referenz: Plan-Abschnitt „Fix B" in `.claude/plans/hier-ist-die-precious-scone.md`.

## Acceptance criteria

- [x] `post-edit-link.php`: `current_user_can('edit_posts')` Guard gesetzt
- [x] `functions.php:138`: `['dashicons']` → `[]`
- [ ] Als nicht-eingeloggter Besucher: DevTools → Network → `dashicons` fehlt komplett
- [ ] Als eingeloggter Editor: Dashicons lädt weiterhin (Edit-Link-Icons funktionieren)
