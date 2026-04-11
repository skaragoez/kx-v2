# Task: Portfolio — Block-Patterns (PHP, modular)

## Status

- [ ] open

## What to build

Liefer die **komplette serverseitige Pattern-Schicht** aus PRD („Solution“ Punkt 1, „Implementation Decisions“: Deep Module Markup + schmale Registrierung + ein Include-Einstieg) und begleitendem Plan (Architektur-Diagramm, Modul-Schnitt-Tabelle, Datei-Vorschlag Markup + Registrierung).

End-to-end-Verhalten: Im Block-Editor erscheinen **drei** Patterns mit den vorgesehenen Slugs (`kx/portfolio-grid-shell`, `kx/portfolio-project-item`, `kx/portfolio-grid-starter`). **Shell** liefert nur den äußeren Grid-Container mit Klassen inkl. `kx-portfolio-grid` und Grid-Layout inkl. `c-gap-5`. **Item** liefert genau **eine** innere Zelle mit Klasse `kx-portfolio-cell` plus Bild- und Textblöcke wie im Plan beschrieben. **Starter** setzt sich aus derselben Item-Markup-Quelle **N-fach** zusammen (z. B. N=3) plus Shell — ohne dupliziertes Hand-Markup. Einbindung erfolgt über **einen** Theme-Einstieg (keine zerstreuten Registrierungen).

## Acceptance criteria

- [ ] Markup-Logik für Shell und Zelle liegt zentral (eine Quelle für die Zelle); Starter nutzt diese Quelle per Zusammensetzung (PRD „Solution“ 1, Plan „Wartbarkeit“).
- [ ] Auf `init` sind genau die drei Patterns registriert; Titel/Beschreibungen erklären Redakteuren Shell → Items einfügen vs. Starter (PRD „Pattern-Registrierung“, Plan „Registrierungs-Modul“).
- [ ] Eingefügte Patterns parsen im Editor ohne Block-Fehler; Frontend rendert dieselbe Struktur (PRD Testing: manuelles Einfügen).
- [ ] Keine PHP-Notices/Warnungen beim Laden der Seite mit eingefügtem Pattern (PRD Testing Decisions).
- [ ] Seiten **ohne** diese Patterns und **ohne** die neuen CSS-Klassen bleiben unverändert in ihrer Auszeichnung (PRD Regression).
