# Task: Portfolio — SCSS (Stitch-nah, KX-Tokens, Editor-Parität)

## Status

- [x] completed

## What to build

Liefer die **gesamte Präsentationsschicht** für die Portfolio-Section gemäß PRD („Solution“ Punkt 2, „Design-Tokens“, „Barrierefreiheit / Motion“) und Plan-Abschnitt „SCSS: Stitch-inspiriertes Layout, KX-Tokens“.

End-to-end-Verhalten: Sobald ein Block die Klassen `kx-portfolio-grid` (äußerer Grid-Container) und `kx-portfolio-cell` (innere Zellen) trägt — egal ob durch Pattern oder manuelle Klassen (PRD „Migration“, Plan „Migration bestehender Seite“) — sehen **Frontend und Block-Editor-Canvas** gleichwertig aus: Raster mit explizitem Zeilenabstand (`row-gap: 5rem`; `c-gap-5` bleibt für Spaltenabstand), Zellen bewusst **ohne** Karten-Chrome (kein Hintergrund/Schatten/Innenpadding, kein Hover), Bilder beschnitten und abgerundet; **Fokus** über `:focus-within`-Outline. **Keine** neuen Schriftarten.

Styles hängen **nur** an den expliziten Selektoren für äußeres Grid und direkte Kind-Zellen — keine Stilierung beliebiger anderer Groups im Grid (PRD „explizite Klassen“, Plan Selektoren).

## Acceptance criteria

- [x] Dedizierte SCSS-Komponente ist eingebunden über die **Block-Styles-Pipeline**, die bereits vom Editor-Stylesheet geladen wird (PRD „Styles“, Plan „Import über Block-Komponenten-Pipeline“).
- [x] Nach Theme-SCSS-Build sind kompilierte Frontend- **und** Editor-Styles aktualisiert; visueller Abgleich Editor vs. Live-Seite für dieselbe Struktur (PRD „Testing Decisions“, Plan „Build & Verifikation“).
- [x] Umbrüche schmal/breit sind geprüft; Touch und Tastaturfokus wirken nicht kaputt (Plan „Checks“).
- [x] Keine Hover-Transition mehr auf den Zellen; Motion-Thema damit erledigt (`prefers-reduced-motion` entfällt für Hover).
- [x] Eine Referenzseite **ohne** `kx-portfolio-grid` / `kx-portfolio-cell` zeigt **keine** optischen Regressionen (PRD Regression).
