# Task: Portfolio — Doku, QA-Checkliste, Migration

## Status

- [ ] open

## What to build

Schließe die Lieferung ab mit **Nachweisbarkeit für das Team** und **Redaktions-Hinweisen**, wie im PRD „Further Notes“ und Plan „Dokumentation“ / „Migration bestehender Seite“ / „Risiken“.

End-to-end-Verhalten: Entwickler und Redakteure finden an **einer** Stelle in der Projektdokumentation die **Pattern-Slugs** und **CSS-Klassennamen** sowie kurz, wann Shell, Item oder Starter zu nutzen ist. Es gibt eine **manuelle QA-Checkliste** (aus PRD „Testing Decisions“ und „Visuelle QA“), die nach Abschluss der vorherigen Tasks abgehakt werden kann. Für die **bestehende Live-Grid-Seite** ist der Migrationspfad klar: Klassen setzen oder Patterns nutzen — **ohne** automatische DB-Migration (PRD „Out of Scope“).

## Acceptance criteria

- [ ] STATUS und/oder ARCHITECTURE nennen die drei Pattern-Slugs und die Klassen `kx-portfolio-grid` sowie `kx-portfolio-cell` (PRD „Further Notes“, Plan „Dokumentation“).
- [ ] Kurze Redaktionsanleitung: Shell + mehrere Items vs. Starter; wie bestehende Group-Blöcke per Zusatzklassen ans Styling anbinden (PRD „Migration“, Plan „Migration bestehender Seite“).
- [ ] QA-Checkliste ausgeführt oder dokumentiert: alle drei Patterns eingefügt, Zellen dupliziert, Breakpoints, Stitch-nahe Kriterien (Flächen, Lesbarkeit, Bildbeschnitt), Regression auf neutraler Seite (PRD „Testing Decisions“).
- [ ] Out-of-Scope-Punkte sind für Stakeholder klar (keine Stitch-Webfonts, keine Floating-Chips ohne neue Blöcke) — PRD „Out of Scope“, Plan „Risiken / Abgrenzung“.
