# Agentic WP tooling (local DDEV)

Small **bash** entrypoints so agents and developers can change **WordPress content and theme mods** without the wp-admin UI. **Scope:** local project with **DDEV**; see [AGENTS.md](../../AGENTS.md) for stack rules.

## Prerequisites

- Repo root: `kx-v2` (this WordPress install).
- `ddev start` from the repo root before running scripts.
- `ddev` and `docker` available on the host.

## Layout

| Path | Role |
|------|------|
| `lib/common.sh` | Resolves `REPO_ROOT`, validates tree, wraps `ddev wp` |
| `post-find.sh` | List or filter posts/pages by slug |
| `post-update-content.sh` | Set `post_content` (and optional title) from a file |
| `theme-mod.sh` | `get` / `set` one Customizer `theme_mod` on the active theme |

## Examples (run from anywhere)

```bash
# Find a page by slug
./tools/agentic-wp/post-find.sh --slug about --post-type page

# List latest 20 posts and pages (mixed)
./tools/agentic-wp/post-find.sh

# Update raw HTML/block markup for slug "home" from a file
./tools/agentic-wp/post-update-content.sh --slug home --file ./path/to/content.html --title "New title"

# Read / set footer copyright (KX Customizer — example only)
./tools/agentic-wp/theme-mod.sh get footer_copyright
./tools/agentic-wp/theme-mod.sh set footer_copyright "© 2026 Example"
```

## Safety notes

- **No secrets** are stored here; do not commit Application Passwords or production URLs.
- **`post-update-content`** replaces `post_content` as stored in the database. Prefer a **staging** or **local** database snapshot before bulk edits; invalid block serialization can confuse the block editor — verify in the editor when unsure.
- **Remote/staging:** these scripts call `ddev wp` only. For remote hosts, use the same WP-CLI commands over SSH or documented REST flows (out of scope for v1).

## MCP (phase 2)

A future MCP server can invoke these scripts or call `ddev wp` with the same arguments; v1 is CLI-only.
