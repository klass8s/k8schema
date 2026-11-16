# Contributing to k8schema

Thank you for helping. k8schema is generated code, which decides where a change goes.

## Where a change goes

- **A generated class is wrong or missing** (a type, a property, a method, a collection): the fix
  is a change to [k8schema-generator](https://github.com/klass8s/k8schema-generator), and the next
  regeneration carries it into every Kubernetes minor. Open the issue or the pull request there. The
  classes on the minor branches (`v1.35`, …) are never edited by hand: the next regeneration would
  undo the edit.
- **The template, the workflow or the tooling** (`bin/`, `tools/`, `.github/`, `composer.json`,
  `src/K8SApi.php`, the code-style config) lives on `main`, and a change to it is a pull request
  against `main`.
- **A Kubernetes minor that is missing or out of date:** open an issue; the weekly run of the
  *Generate* workflow picks up the newest upstream schemas on its own.
- **A security issue** is reported privately, never in a public issue: see [SECURITY.md](SECURITY.md).

## Building and checking

You need PHP 8.5 and Composer; the workflow check below also needs Python 3 and
[yq](https://github.com/mikefarah/yq) v4. `composer install` installs the generator and the
code-style tool from their committed locks.

```bash
composer install
git checkout v1.35                          # a minor branch; main holds the template alone
bin/generate v1.35                          # regenerate src/ from the newest schema of the minor
git status                                  # a clean tree: the branch is current for that schema
composer cs:check                           # the code-style check of the generated code
```

On `main`, `.github/scripts/pr-job-secrets.test.sh` checks the workflow guard described below.

## What a pull request must satisfy

- It targets `main`, never a minor branch and never the branch of another open pull request. The
  one exception is a regeneration that the workflow's shrink guard holds for review: the workflow
  opens that pull request against the minor branch itself.
- The pull request's own run of the *Generate* workflow passes: it regenerates every supported
  Kubernetes minor from the pull request's template and generator pin, as a dry run that pushes
  and tags nothing, and checks that every file compiles, the tree autoloads and serializes a
  `Deployment`, and the code style is clean.
- No job that a pull request can start names a stored secret: a secret reaches every job whose
  definition names it, so only a job-level `if:` that keeps the job off pull requests keeps the
  secret off their runners. The workflow's `pr-secrets` job checks this on every pull request.
- The title is a [Conventional Commits](https://www.conventionalcommits.org) header,
  `type(scope): subject`. Pull requests are squash-merged, so the title becomes the commit on
  `main`. Every commit in the pull request is a Conventional Commit too, with a body that says what
  changed and why.

## License

Contributions are licensed under the [MIT License](LICENSE), as the rest of the repository is.
