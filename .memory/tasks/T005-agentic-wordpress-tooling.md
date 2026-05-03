# T005 — Agentic WordPress tooling system

## Status

- [ ] open

## Goal

Build a **modular, reusable** system to change **WordPress code and content** quickly with **minimal use of wp-admin** (including typical content edits). This is **WordPress runtime / DX tooling**, not the project-memory documentation hub (see T004 / `.memory/` markdown).

Target stack: **local DDEV** + **WP-CLI** (`ddev wp`) as the default path; optional **REST** (application passwords); optional **MCP** layer that wraps CLI or REST with clear read/write boundaries.

## Non-goals

- Replacing or re-implementing the project-memory / AGENTS hub.
- Storing production secrets in the repository.

## Architecture direction

1. **CLI-first:** posts, options, terms, menus, rewrite, meta, block export/import where needed — all scriptable.
2. **Modular layout:** small commands under something like `tools/agentic-wp/` or `scripts/wp/` with idempotent operations and predictable naming.
3. **Content without admin:** document concrete flows (e.g. `wp post update` with block markup, file-based sync, or REST).
4. **Security:** environment profiles (local vs staging); no credentials in git; document required caps and risks.

## Phases (suggested)

- **Phase 1:** WP-CLI wrapper scripts + short `.memory/` doc (or README section) listing MVP operations: hero text update, option set, theme asset workflow.
- **Phase 2 (optional):** MCP server exposing a narrow tool surface (read-only first, then gated writes).

## Acceptance criteria

- [ ] Documented **non–admin** path for at least three MVP operations (e.g. update a defined page title/body, set one theme option or `theme_mod`, list/find posts by slug).
- [ ] At least **two** independent modules or scripts demonstrate reusability (not one monolithic file).
- [ ] `.memory/DECISIONS.md` or `ARCHITECTURE.md` updated with where tooling lives and how agents should invoke it.

## References

- DDEV WP-CLI: `ddev wp --info` / project README
- [AGENTS.md](../../AGENTS.md) — stack and rules
