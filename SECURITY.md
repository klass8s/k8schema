# Security policy

## Reporting a vulnerability

Please do not report a vulnerability in a public issue. Report it privately through GitHub's
private vulnerability reporting: the repository's **Security** tab, **Report a vulnerability**
(<https://github.com/klass8s/k8schema/security/advisories/new>).

Say what is affected (a generated class, the *Generate* workflow, the scripts under `bin/`), the
version (`composer show tequila/k8schema`), and the code or the steps that show the problem. The fix
is coordinated in the advisory, and the advisory is published with the releases that carry it.

## Supported versions

Every Kubernetes minor the *Generate* workflow still regenerates (the newest four upstream) receives
fixes in a new patch release of its line; upgrade to the newest patch release of your minor to
receive them.
