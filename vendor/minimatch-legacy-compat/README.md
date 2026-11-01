# Scoped ESLint compatibility adapter

This private project package is not an upstream minimatch release. It delegates
matching to the exact official `minimatch@11.0.3` package through an npm alias.
It replaces only the v3 dependency ranges currently requested by this project's
ESLint stack. TypeScript-ESTree uses unmodified upstream 11.0.3 directly.

Older plugins call `require("minimatch")` as a function; v11 exports named APIs.
This adapter preserves the callable form, methods and defaults used here.
`makeRe` returns a frozen object with a `test` method backed by v11 matching,
because the reviewed import plugin only uses that method. It is deliberately
not a RegExp and must not be used by consumers requiring `.source`, `.exec`,
serialization or other regex APIs. There is no copied v3 matcher or regex engine.

The source is retained alongside a deterministic tarball used by npm overrides.
No lifecycle scripts, runtime preload hooks or remote package modifications are
involved. If the lint stack changes, rerun the compatibility/consumer tests and
review its API usage before retaining these overrides. Remove the adapter when
upstream plugins support the patched API directly.
