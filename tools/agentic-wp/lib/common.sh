#!/usr/bin/env bash
# Shared helpers for agentic-wp tools. Source from scripts: source "$SCRIPT_DIR/lib/common.sh"
set -euo pipefail

_AGENTIC_LIB_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
export AGENTIC_WP_ROOT="$(cd "$_AGENTIC_LIB_DIR/.." && pwd)"
# lib → agentic-wp → tools → WordPress repo root
export REPO_ROOT="$(cd "$_AGENTIC_LIB_DIR/../../.." && pwd)"

require_repo_root() {
	if [[ ! -f "$REPO_ROOT/wp-config.php" ]] || [[ ! -d "$REPO_ROOT/.ddev" ]]; then
		echo "error: REPO_ROOT does not look like kx-v2 with DDEV (missing wp-config.php or .ddev): $REPO_ROOT" >&2
		exit 1
	fi
}

require_ddev() {
	if ! command -v ddev >/dev/null 2>&1; then
		echo "error: ddev not found in PATH" >&2
		exit 1
	fi
}

# Run WP-CLI inside the project web container (cwd = WordPress root).
ddev_wp() {
	(
		cd "$REPO_ROOT"
		ddev wp "$@"
	)
}

ensure_ddev_project_running() {
	(
		cd "$REPO_ROOT"
		if ! ddev describe >/dev/null 2>&1; then
			echo "error: 'ddev describe' failed — run: cd \"$REPO_ROOT\" && ddev start" >&2
			exit 1
		fi
		local raw
		raw="$(ddev describe -j 2>/dev/null || true)"
		if [[ -z "$raw" ]]; then
			return 0
		fi
		if echo "$raw" | grep -q '"router_status":"healthy"' 2>/dev/null || echo "$raw" | grep -q '"status":"running"' 2>/dev/null; then
			return 0
		fi
		echo "warn: DDEV may not be running — if wp fails, run: ddev start" >&2
	)
}

usage_exit() {
	echo "usage: $*" >&2
	exit 2
}
