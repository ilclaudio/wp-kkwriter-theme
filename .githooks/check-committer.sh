#!/usr/bin/env bash
set -euo pipefail

echo "[KKW pre-commit] Check committer identity ..." >&2

BLOCKED_EMAIL="blocked-email@example.invalid"
committer_email="$(git config user.email 2>/dev/null || true)"

if [ "$committer_email" = "$BLOCKED_EMAIL" ]; then
	echo "Commit blocked: committer '$committer_email' is not authorized on this repository." >&2
	exit 1
fi
