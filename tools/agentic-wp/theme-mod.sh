#!/usr/bin/env bash
# Read or write a single theme mod on the active theme (Customizer). Requires DDEV.
set -euo pipefail
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
# shellcheck source=lib/common.sh
source "$SCRIPT_DIR/lib/common.sh"

require_repo_root
require_ddev
ensure_ddev_project_running

show_usage() {
	echo "usage: theme-mod.sh get KEY"
	echo "       theme-mod.sh set KEY VALUE"
	echo "  Example key (KX theme): footer_copyright"
}

if [[ $# -lt 2 ]]; then
	show_usage
	exit 2
fi

ACTION="$1"
KEY="$2"

case "$ACTION" in
	get)
		if [[ $# -ne 2 ]]; then
			show_usage
			exit 2
		fi
		ddev_wp theme mod get "$KEY"
		;;
	set)
		if [[ $# -lt 3 ]]; then
			echo "error: set requires VALUE" >&2
			show_usage
			exit 2
		fi
		VALUE="$3"
		ddev_wp theme mod set "$KEY" "$VALUE"
		echo "theme_mod set: $KEY"
		;;
	*)
		show_usage
		exit 2
		;;
esac
