# PRD: Portfolio-Grid (Gutenberg) – Stitch-inspiriertes Layout, modular

## Problem Statement

Die Portfolio-Section auf der Marketing-Seite ist als einfaches **Gutenberg-Grid aus Group-Blöcken** umgesetzt (Bild, Überschrift, Text pro Zelle). Sie wirkt visuell nicht wie das referenzierte **Stitch-Design** („Architectural Curator“: editorial, klare Flächenhierarchie, weiche Tiefe, keine harten Trennlinien). Zugleich soll das bestehende **KX-Typo-Setup** erhalten bleiben.

Zusätzlich soll die Lösung **skalierbar und wartbar** sein: Redakteure sollen viele Projektzellen pflegen können, ohne dass sich wiederholendes Block-Markup an mehreren Stellen auseinanderentwickelt.

## Solution

1. **Drei Block-Patterns** (über eine gemeinsame PHP-Markup-Quelle registriert):
   - **Grid-Shell:** nur der äußere Grid-Container mit stabiler CSS-Klasse für das Layout.
   - **Einzelzelle:** ein wiederverwendbarer „Projekt“-Block (Bild + Überschrift + Text) mit eigener stabilen CSS-Klasse; beliebig oft einfügbar oder duplizierbar.
   - **Starter:** Shell plus eine konfigurierbare Anzahl Platzhalter-Zellen, zusammengesetzt aus derselben Zellen-Logik — damit bleibt die Struktur einer Zelle eine **Single Source of Truth**.

2. **Thema-Styles** (SCSS) koppeln ausschließlich an diese **expliziten Klassen** am äußeren Grid und an inneren Zellen, damit nicht jede beliebige Group im Grid unbeabsichtigt wie eine Portfolio-Karte aussieht.

3. **Migration:** Bestehende Inhalte bleiben im Editor erhalten; es genügt, die **CSS-Klassen** am äußeren bzw. inneren Group-Block zu setzen — oder Inhalte schrittweise durch die neuen Patterns zu ersetzen.

Ein detaillierter technischer Ablauf und Aufgabenliste liegen im begleitenden Plandokument im Ordner **plans** innerhalb des Projekt-Kontext-Verzeichnisses.

## Implementation Decisions

- **Deep module „Portfolio-Pattern-Markup“:** Kapselt die serialisierte Block-Markup-Erzeugung für Shell und Zelle hinter wenigen, klar benannten Funktionen (bzw. Konstanten für wiederkehrende Layout-Parameter). Keine WordPress-Hooks in diesem Modul — nur reine String-/Strukturlogik — damit es leicht zu testen und zu ändern ist.
- **Schmales Modul „Pattern-Registrierung“:** Registriert auf `init` genau die drei Patterns, mit verständlichen Titeln und Beschreibungen für Redakteure. Kennt nur die öffentliche Schnittstelle des Markup-Moduls.
- **Integration:** Ein einziger Einstiegspunkt im Theme (Setup oder Gutenberg-Bündel) lädt die beiden Module per Include; keine verstreute Registrierung.
- **Styles:** Eine dedizierte SCSS-Komponente für Grid + Zellen; Einbindung über die **bestehende Block-Styles-Pipeline**, die bereits vom Editor-Stylesheet mitgenommen wird — damit Editor und Frontend nicht auseinanderlaufen.
- **Design-Tokens:** Farben, Radien und Schatten aus dem **bestehenden KX-Variablensystem** ableiten; keine neuen Webfonts; Fokus auf Layout, Abstände, Flächen, dezente Interaktion.
- **Barrierefreiheit / Motion:** Hover- und Fokus-Styling so wählen, dass Kontrast und `prefers-reduced-motion` berücksichtigt werden.
- **Erweiterbarkeit (optional):** Filter oder Konstante für die Anzahl der Zellen im Starter-Pattern, ohne Markup-Kopien.

## Testing Decisions

- **Manuelle Akzeptanztests (primär):** Einfügen jedes der drei Patterns im Block-Editor; Duplizieren von Zellen; Prüfung von Umbrüchen (schmal/breit); visueller Abgleich Frontend vs. Editor-Canvas.
- **Regression:** Seiten ohne die neuen Klassen dürfen sich **nicht** verändern.
- **Kein Pflicht-Automatisierungstest** für serialisiertes Block-Markup, sofern im Projekt keine bestehende Infrastruktur für PHP-Unit-Tests um Block-Pattern-Strings existiert; falls später hinzugefügt, sollte das Markup-Modul mit **Golden-String**- oder Snapshot-Vergleichen gegen eine feste erwartete Serialisierung geprüft werden ( externes Verhalten: gültige Block-Struktur, keine PHP-Notices).
- **Visuelle QA:** Stitch-nahe Kriterien (Flächen statt harte Linien, Karten-Lesbarkeit, Bildbeschnitt) checklistenbasiert abhaken.

## Out of Scope

- Stitch-**Typografie** (andere Schriftfamilien als im KX-Theme vorgesehen).
- **Floating Tags / Chips** oder andere Elemente, die zusätzliche Blöcke oder Markup erfordern, das aktuell nicht in der Zelle vorkommt.
- Umstellung der Portfolio-Inhalte auf Custom Post Types, Shortcodes oder dynamische Loops.
- Automatische Migration bestehender Seiteninhalte ohne Redaktionsaktion.

## Further Notes

- Pattern-Slugs und CSS-Klassennamen sollten in der Projektdokumentation (STATUS / ARCHITECTURE) erwähnt werden, sobald die Umsetzung live geht.
- Wenn künftig echte „Tags“ auf Karten gewünscht sind, ist ein separates PRD für Block-Erweiterung oder zusätzliche innere Blöcke sinnvoll.
