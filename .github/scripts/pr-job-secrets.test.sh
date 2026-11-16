#!/usr/bin/env bash
# The cases pr-job-secrets.py has to get right: it fails on every shape that hands a stored
# secret to a job a pull request starts, and passes the shapes that keep such a job off one.
set -euo pipefail

check="$(cd "$(dirname "$0")" && pwd)/pr-job-secrets.py"
tmp="$(mktemp -d)"
trap 'rm -rf "$tmp"' EXIT
failures=0

# <file> <expected exit code> [<job the check must name>…] — and no other job.
expect() {
    local file="$1" want="$2" rc=0 out flagged expected
    shift 2
    out="$("$check" "$tmp/$file" 2>&1)" || rc=$?
    # shellcheck disable=SC2016 # the backticks are the check's own quotes around a job's name
    flagged="$(printf '%s\n' "$out" | sed -n 's/^FAIL [^`]*`\([^`]*\)`.*/\1/p' | sort | tr '\n' ' ')"
    expected="$(printf '%s\n' "$@" | sed '/^$/d' | sort | tr '\n' ' ')"
    if [ "$rc" -ne "$want" ] || [ "$flagged" != "$expected" ]; then
        echo "not ok $file: exit $rc (want $want), flagged [${flagged% }] (want [${expected% }])"
        printf '%s\n' "$out" | sed 's/^/    /'
        failures=$((failures + 1))
    else
        echo "ok     $file: exit $rc, flagged [${flagged% }]"
    fi
}

cat > "$tmp/delivers.yaml" <<'YAML'
on: [push, pull_request]
jobs:
    # A step skipped by its own if: still hands the job the secret.
    skipped-step:
        runs-on: ubuntu-latest
        steps:
            - if: github.event_name != 'pull_request'
              run: echo "$KEY"
              env:
                  KEY: ${{ secrets.RELEASE_APP_PRIVATE_KEY }}
    # Kept off a pull request, and the anchor's owner: passes.
    release:
        if: github.event_name != 'pull_request'
        runs-on: ubuntu-latest
        steps:
            - uses: actions/create-github-app-token@v3
              with: &app
                  client-id: ${{ secrets.RELEASE_APP_CLIENT_ID }}
                  private-key: ${{ secrets.RELEASE_APP_PRIVATE_KEY }}
    # The same secret through an alias.
    through-an-alias:
        runs-on: ubuntu-latest
        steps:
            - uses: actions/create-github-app-token@v3
              if: false
              with: *app
    # A disjunction is not read: it can run.
    disjunction:
        if: github.event_name != 'pull_request' || always()
        runs-on: ubuntu-latest
        steps:
            - run: echo "${{ secrets.RELEASE_APP_CLIENT_ID }}"
    # The step's if: is not the job's.
    step-level-only:
        runs-on: ubuntu-latest
        steps:
            - if: ${{ github.event_name != 'pull_request' }}
              run: echo "${{ toJSON(secrets) }}"
    inherit:
        uses: ./.github/workflows/reusable.yaml
        secrets: inherit
YAML
expect delivers.yaml 1 skipped-step through-an-alias disjunction step-level-only inherit

cat > "$tmp/workflow-env.yaml" <<'YAML'
on: pull_request
env:
    KEY: ${{ secrets.RELEASE_APP_PRIVATE_KEY }}
jobs:
    any-job:
        runs-on: ubuntu-latest
        steps:
            - run: true
YAML
expect workflow-env.yaml 1 any-job

# `!= 'pull_request'` says nothing about pull_request_target.
cat > "$tmp/target.yaml" <<'YAML'
on: pull_request_target
jobs:
    wrong-event:
        if: github.event_name != 'pull_request'
        runs-on: ubuntu-latest
        steps:
            - run: echo "${{ secrets.RELEASE_APP_CLIENT_ID }}"
YAML
expect target.yaml 1 wrong-event

cat > "$tmp/keeps-off.yaml" <<'YAML'
on:
    pull_request:
        branches: [main]
    schedule:
        - cron: '17 6 * * 1'
    workflow_dispatch:
        inputs:
            dry_run:
                type: boolean
jobs:
    no-secret:
        runs-on: ubuntu-latest
        env:
            GH_TOKEN: ${{ github.token }}
            ALSO: ${{ secrets.GITHUB_TOKEN }}
        steps:
            - run: gh api user
    # Text outside a ${{ }} expression reads no context.
    plain-text:
        runs-on: ubuntu-latest
        steps:
            - run: .github/scripts/pr-job-secrets.py secrets.RELEASE_APP_PRIVATE_KEY
    release:
        if: >-
            !cancelled()
            && needs.plan.result == 'success'
            && github.event_name != 'pull_request'
            && inputs.dry_run != true
        runs-on: ubuntu-latest
        steps:
            - run: echo "${{ secrets.RELEASE_APP_PRIVATE_KEY }}"
    only-on-schedule:
        if: ${{ (github.event_name == 'schedule') && (always()) }}
        runs-on: ubuntu-latest
        steps:
            - run: echo "${{ secrets.RELEASE_APP_PRIVATE_KEY }}"
    never:
        if: false
        runs-on: ubuntu-latest
        steps:
            - run: echo "${{ secrets.RELEASE_APP_PRIVATE_KEY }}"
YAML
expect keeps-off.yaml 0

cat > "$tmp/no-pull-request.yaml" <<'YAML'
on:
    push:
        tags: ['v*']
jobs:
    release:
        runs-on: ubuntu-latest
        steps:
            - run: echo "${{ secrets.RELEASE_APP_PRIVATE_KEY }}"
YAML
expect no-pull-request.yaml 0

if [ "$failures" -gt 0 ]; then
    echo "$failures case(s) failed"
    exit 1
fi
echo "every case passes"
