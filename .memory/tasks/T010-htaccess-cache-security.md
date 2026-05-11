## Status

[ ] open

## What to build

Neue Datei `.htaccess` im WordPress-Root anlegen. Aktuell fehlt jede `.htaccess` — daher keine Browser-Cache-TTL für statische Assets und keine Security-Header.

Enthält drei Blöcke:
1. WordPress Standard Rewrite Rules
2. `mod_expires` + `mod_headers` — Browser-Cache 1 Jahr für CSS, JS, Fonts, Bilder
3. Security-Headers: `X-Frame-Options SAMEORIGIN`, `X-Content-Type-Options nosniff`, `Strict-Transport-Security`, `Referrer-Policy`

Referenz: Plan-Abschnitt „Fix D" in `.claude/plans/hier-ist-die-precious-scone.md`.

## Acceptance criteria

- [ ] `.htaccess` existiert im WordPress-Root
- [ ] WordPress-Routing funktioniert weiterhin (alle Seiten erreichbar)
- [ ] DevTools → Network → `style.css` Response-Header enthält `Cache-Control: public, max-age=31536000`
- [ ] DevTools → Network → Response-Header enthält `X-Frame-Options: SAMEORIGIN`
- [ ] HSTS-Header gesetzt: `Strict-Transport-Security: max-age=31536000; includeSubDomains`
