#!/usr/bin/env python3
"""Fail when a job that a pull request can start names a stored secret.

    pr-job-secrets.py <workflow.yaml>...

Actions hands a stored secret to a job when any part of the job's definition names it,
a step that its own `if:` skips included, and through `secrets: inherit`; only a job that
never starts receives nothing. So a job a pull request can start must name no stored
secret, and what keeps a job off a pull request is its own job-level `if:`.

A job counts as kept off a pull request when its `if:` is a conjunction (`&&` at the top
level, no `||` there) one of whose terms is `github.event_name != '<event>'` or
`github.event_name == '<another event>'`, for every pull-request event the workflow
listens to. Anything else (no `if:`, a disjunction, a condition this does not read) counts
as "can run": the check errs towards a failure a person reads, never towards a pass.

A job names a secret with a `${{ }}` expression anywhere in it that reads
`secrets.<NAME>`, `secrets[…]` or `toJSON(secrets)` (the `secrets` context is read nowhere
else), or with `secrets: inherit`. The YAML is read by yq (mikefarah, v4) with anchors and
aliases resolved, so a secret named through an alias counts in the job that uses it.
Workflow-level `env:` counts in every job. GITHUB_TOKEN is not a stored secret.
"""
import json
import re
import subprocess
import sys

PULL_REQUEST_EVENTS = {"pull_request", "pull_request_target"}
EXPRESSION = re.compile(r"\$\{\{(.*?)\}\}", re.DOTALL)
NAMED =re.compile(r"\bsecrets\s*\.\s*([A-Za-z_][A-Za-z0-9_-]*)", re.IGNORECASE)
DYNAMIC = re.compile(r"\bsecrets\s*\[|\btojson\s*\(\s*secrets\s*\)", re.IGNORECASE)
EVENT_TEST = re.compile(r"^github\.event_name\s*(==|!=)\s*'([^']*)'$", re.IGNORECASE)


def load(path):
    out = subprocess.run(["yq", "-o=json", "explode(.)", path],
                         check=True, capture_output=True, text=True).stdout
    return json.loads(out)


def triggers(workflow):
    on = workflow.get("on")
    if isinstance(on, str):
        return {on}
    if isinstance(on, (list, dict)):
        return set(on)
    return set()


def outside_literals(expr):
    """(index, character, parentheses open before it) for each character outside '…'."""
    depth, quoted, i = 0, False, 0
    while i < len(expr):
        c = expr[i]
        if quoted:
            if c == "'":
                if expr[i + 1:i + 2] == "'":  # '' is a quote inside a literal
                    i += 1
                else:
                    quoted = False
        elif c == "'":
            quoted = True
        else:
            yield i, c, depth
            depth += (c == "(") - (c == ")")
        i += 1


def split_top_level(expr, op):
    """`expr` cut at every `op` outside parentheses and string literals."""
    parts, start = [], 0
    for i, _, depth in outside_literals(expr):
        if depth == 0 and i >= start and expr.startswith(op, i):
            parts.append(expr[start:i].strip())
            start = i + len(op)
    parts.append(expr[start:].strip())
    return parts


def wrapped(expr):
    """Whether the parenthesis that opens `expr` is the one that closes it: `(a) && (b)` is not."""
    if not (expr.startswith("(") and expr.endswith(")")):
        return False
    return not any(c == ")" and depth == 1 and i < len(expr) - 1
                   for i, c, depth in outside_literals(expr))


def unwrap(expr):
    expr = expr.strip()
    if expr.startswith("${{") and expr.endswith("}}"):
        expr = expr[3:-2].strip()
    while wrapped(expr):
        expr = expr[1:-1].strip()
    return expr


def conjuncts(expr):
    expr = unwrap(expr)
    if len(split_top_level(expr, "||")) > 1:
        return [expr]  # a disjunction: one term this does not read
    parts = split_top_level(expr, "&&")
    if len(parts) == 1:
        return parts
    return [term for part in parts for term in conjuncts(part)]


def kept_off(job_if, events):
    """The events among `events` that the job-level `if:` provably skips."""
    if job_if is False:
        return set(events)
    if job_if is None or job_if is True or job_if == "":
        return set()
    skipped = set()
    for term in conjuncts(str(job_if)):
        test = EVENT_TEST.match(term)
        if not test:
            continue
        op, name = test.group(1), test.group(2).lower()
        skipped |= {event for event in events if (event == name) == (op == "!=")}
    return skipped


def strings(node):
    if isinstance(node, str):
        yield node
    elif isinstance(node, dict):
        for value in node.values():
            yield from strings(value)
    elif isinstance(node, list):
        for value in node:
            yield from strings(value)


def secrets_named(job, workflow):
    expressions = [m.group(1) for s in strings([job, workflow.get("env") or {}])
                   for m in EXPRESSION.finditer(s)]
    names = {m.group(1) for e in expressions for m in NAMED.finditer(e)
             if m.group(1).upper() != "GITHUB_TOKEN"}
    if any(DYNAMIC.search(e) for e in expressions):
        names.add("secrets[...] / toJSON(secrets)")
    if job.get("secrets") == "inherit":
        names.add("secrets: inherit")
    return sorted(names)


def main(paths):
    if not paths:
        print("usage: pr-job-secrets.py <workflow.yaml>...", file=sys.stderr)
        return 2
    failed = 0
    for path in paths:
        workflow = load(path)
        events = triggers(workflow) & PULL_REQUEST_EVENTS
        for name, job in (workflow.get("jobs") or {}).items():
            runs_on = sorted(events - kept_off(job.get("if"), events))
            named = secrets_named(job, workflow)
            if runs_on and named:
                failed += 1
                print(f"FAIL {path}: job `{name}` can run on {', '.join(runs_on)} "
                      f"and names {', '.join(named)}")
            elif named:
                print(f"ok   {path}: job `{name}` names {', '.join(named)}; "
                      f"no pull request starts it")
            else:
                print(f"ok   {path}: job `{name}` names no stored secret")
    if failed:
        print(f"{failed} job(s) a pull request can start name a stored secret: move what "
              f"needs it into a job whose job-level `if:` skips pull requests", file=sys.stderr)
    return 1 if failed else 0


if __name__ == "__main__":
    sys.exit(main(sys.argv[1:]))
