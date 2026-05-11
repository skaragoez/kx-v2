## Status

[ ] open

## What to build

In `js/app.js` den `calculateDimensions()`-Aufruf nach `duplicateContent()` im Newsticker in ein `requestAnimationFrame` wrappen. Aktuell werden `offsetWidth` und `scrollWidth` unmittelbar nach DOM-Writes (appendChild) gelesen — das erzwingt einen synchronen Layout-Reflow von ~143 ms.

Nach der Änderung Theme-Build ausführen: `cd wp-content/themes/kx && npm run build`

Referenz: Plan-Abschnitt „Fix F" in `.claude/plans/hier-ist-die-precious-scone.md`.

## Acceptance criteria

- [ ] `calculateDimensions()`-Aufruf nach `duplicateContent()` in `requestAnimationFrame` gewrappt
- [ ] `npm run build` läuft ohne Fehler durch
- [ ] Newsticker/Ticker auf der Seite läuft weiterhin korrekt (keine visuellen Rückschritte)
- [ ] DevTools → Performance-Tab: Kein „Forced reflow" im Zusammenhang mit `calculateDimensions`
