#!/usr/bin/env bash
# Update post title and/or raw post_content from a file (Gutenberg HTML/serialized blocks). Requires DDEV.
set -euo pipefail
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
# shellcheck source=lib/common.sh
source "$SCRIPT_DIR/lib/common.sh"

require_repo_root
require_ddev
ensure_ddev_project_running

show_usage() {
	echo "usage: post-update-content.sh --slug SLUG --file PATH [--title \"New title\"]"
	echo "  Updates the post matching post_name=SLUG (first match). Uses raw post_content from file."
	echo "  caution: invalid block markup can break the editor; test in wp-admin on a copy first."
}

SLUG=""
FILE=""
TITLE=""

while [[ $# -gt 0 ]]; do
	case "$1" in
		--slug)
			SLUG="${2:-}"
			shift 2
			;;
		--file)
			FILE="${2:-}"
			shift 2
			;;
		--title)
			TITLE="${2:-}"
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

if [[ -z "$SLUG" || -z "$FILE" ]]; then
	show_usage
	exit 2
fi

if [[ ! -f "$FILE" ]]; then
	echo "error: file not found: $FILE" >&2
	exit 1
fi

# shellcheck disable=SC2094
CONTENT="$(<"$FILE")"
if [[ -z "$CONTENT" ]]; then
	echo "error: file is empty: $FILE" >&2
	exit 1
fi

IDS="$(ddev_wp post list --name="$SLUG" --field=ID --format=ids)"
if [[ -z "$IDS" ]]; then
	echo "error: no post found with slug (post_name): $SLUG" >&2
	exit 1
fi
# First ID only if multiple (should not happen for unique slugs per type)
FIRST_ID="${IDS%% *}"

UPDATE_ARGS=(post update "$FIRST_ID" --post_content="$CONTENT")
if [[ -n "$TITLE" ]]; then
	UPDATE_ARGS+=(--post_title="$TITLE")
fi

ddev_wp "${UPDATE_ARGS[@]}"
echo "updated post ID $FIRST_ID (slug: $SLUG)"
