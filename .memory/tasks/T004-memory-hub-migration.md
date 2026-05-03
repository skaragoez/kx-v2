# T004 — Memory / documentation hub migration

## Status

- [x] completed

## Goal

Make `.memory/` the single canonical documentation and task-tracking hub for AI agents and humans. Migrate content from `.context/`, update all repository references, deprecate `.context/`.

## Acceptance criteria

- [x] `.memory/` contains migrated `STATUS`, `ARCHITECTURE`, `DECISIONS`, `CONVENTIONS`, `TASKS`, `tasks/`, `prds/`, `plans/`.
- [x] [AGENTS.md](../../AGENTS.md) and [CLAUDE.md](../../CLAUDE.md) point at `.memory/` paths (not `.context/`).
- [x] No broken internal references to `.context/` for documentation (grep clean for intentional deprecation stub only).
- [x] `.context/` removed or replaced by a deprecation notice pointing to `.memory/`.

## Notes

Executed as part of the post–Grill-Me implementation plan (A1). Further substantive edits should update `.memory/` per `AGENTS.md`.
