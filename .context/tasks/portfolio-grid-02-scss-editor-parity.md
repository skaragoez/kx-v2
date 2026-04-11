# Task: Portfolio — SCSS (Stitch-nah, KX-Tokens, Editor-Parität)

## Status

- [ ] open

## What to build

Liefer die **gesamte Präsentationsschicht** für die Portfolio-Section gemäß PRD („Solution“ Punkt 2, „Design-Tokens“, „Barrierefreiheit / Motion“) und Plan-Abschnitt „SCSS: Stitch-inspiriertes Layout, KX-Tokens“.

End-to-end-Verhalten: Sobald ein Block die Klassen `kx-portfolio-grid` (äußerer Grid-Container) und `kx-portfolio-cell` (innere Zellen) trägt — egal ob durch Pattern oder manuelle Klassen (PRD „Migration“, Plan „Migration bestehender Seite“) — sehen **Frontend und Block-Editor-Canvas** gleichwertig aus: Raster mit explizitem Zeilenabstand (Plan: `row-gap` vs. `c-gap-5` nur für Spalten), Karten über **Flächen** statt harte 1px-Ränder, Bilder beschnitten und abgerundet kompatibel zur bestehenden quadratischen Bildlogik, dezente Hover-/Fokus-Effekte mit Rücksicht auf `prefers-reduced-motion`. **Keine** neuen Schriftarten; nur Abstände bei Überschrift/Fließtext.

Styles hängen **nur** an den expliziten Selektoren für äußeres Grid und direkte Kind-Zellen — keine Stilierung beliebiger anderer Groups im Grid (PRD „explizite Klassen“, Plan Selektoren).

## Acceptance criteria

- [ ] Dedizierte SCSS-Komponente ist eingebunden über die **Block-Styles-Pipeline**, die bereits vom Editor-Stylesheet geladen wird (PRD „Styles“, Plan „Import über Block-Komponenten-Pipeline“).
- [ ] Nach Theme-SCSS-Build sind kompilierte Frontend- **und** Editor-Styles aktualisiert; visueller Abgleich Editor vs. Live-Seite für dieselbe Struktur (PRD „Testing Decisions“, Plan „Build & Verifikation“).
- [ ] Umbrüche schmal/breit sind geprüft; Touch und Tastaturfokus wirken nicht kaputt (Plan „Checks“).
- [ ] `prefers-reduced-motion: reduce` reduziert oder entfernt problematische Animation/Transition (PRD „Barrierefreiheit / Motion“).
- [ ] Eine Referenzseite **ohne** `kx-portfolio-grid` / `kx-portfolio-cell` zeigt **keine** optischen Regressionen (PRD Regression).
