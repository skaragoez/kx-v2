# Task Tracking

Tasks are stored as individual Markdown files in `/.memory/tasks/`.

## Folder & naming

- Files are named like `T001-some-title.md`, `T002-some-title.md`, etc.
- Each task file contains a `## Status` section (e.g. `[x] completed` or `[ ] open`) plus details and acceptance criteria.

## How to update status

When a task is finished, set the `## Status` section to `[x] completed` inside the corresponding task file.

## Current overview

| ID | Title | Status |
|----|-------|--------|
| PG-1 | [portfolio-grid-01-php-patterns.md](tasks/portfolio-grid-01-php-patterns.md) — Block-Patterns (PHP) | completed |
| PG-2 | [portfolio-grid-02-scss-editor-parity.md](tasks/portfolio-grid-02-scss-editor-parity.md) — SCSS + Editor-Parität | completed |
| PG-3 | [portfolio-grid-03-docs-qa-migration.md](tasks/portfolio-grid-03-docs-qa-migration.md) — Doku, QA, Migration | completed |
| T004 | [T004-memory-hub-migration.md](tasks/T004-memory-hub-migration.md) — Hub `.context` → `.memory` | completed |
| T005 | [T005-agentic-wordpress-tooling.md](tasks/T005-agentic-wordpress-tooling.md) — Agentic WordPress (CLI/MCP, modular) | completed |
| T006 | [T006-raleway-hero-cro.md](tasks/T006-raleway-hero-cro.md) — Raleway headings + CRO Hero | completed |

Parent specs: [portfolio-grid-stitch-style-PRD.md](prds/portfolio-grid-stitch-style-PRD.md), [plans/portfolio-grid-stitch-style.md](plans/portfolio-grid-stitch-style.md).

**PRDs** live under `.memory/prds/`. **Plans** under `.memory/plans/`. Add task files under `.memory/tasks/` when work is tracked in this format.
