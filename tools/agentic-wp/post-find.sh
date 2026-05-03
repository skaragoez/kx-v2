#!/usr/bin/env bash
# List or find WordPress posts/pages by slug (no wp-admin). Requires DDEV.
set -euo pipefail
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
# shellcheck source=lib/common.sh
source "$SCRIPT_DIR/lib/common.sh"

require_repo_root
require_ddev
ensure_ddev_project_running

SLUG=""
POST_TYPE="any"
FORMAT="table"
FIELDS="ID,post_type,post_status,post_name,post_title"

show_usage() {
	echo "usage: post-find.sh [--slug SLUG] [--post-type TYPE] [--format FORMAT]"
	echo "  Default: list recent posts/pages (mixed)."
	echo "  --slug: filter by post_name (slug)."
	echo "  --post-type: any|post|page|... (default: any → omit filter)"
	echo "  --format: table|csv|json|ids (default: table)"
}

while [[ $# -gt 0 ]]; do
	case "$1" in
		--slug)
			SLUG="${2:-}"
			shift 2
			;;
		--post-type)
			POST_TYPE="${2:-}"
			shift 2
			;;
		--format)
			FORMAT="${2:-}"
			shift 2
			;;
		-h|--help)
			show_usage
			exit 0
			;;
		*)
			echo "unknown argument: $1" >&2
			show_usage
			exit 2
			;;
	esac
done

ARGS=(post list "--format=$FORMAT" "--fields=$FIELDS")

if [[ "$POST_TYPE" != "any" && -n "$POST_TYPE" ]]; then
	ARGS+=("--post_type=$POST_TYPE")
fi

if [[ -n "$SLUG" ]]; then
	ARGS+=("--name=$SLUG")
fi

if [[ -z "$SLUG" ]]; then
	ARGS+=(--posts_per_page=20)
fi

ddev_wp "${ARGS[@]}"
