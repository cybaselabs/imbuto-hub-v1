"use strict";

// Keep the callable CommonJS API used by the pinned ESLint plugins while all
// matching is delegated to the patched, integrity-verified upstream release.
const modern = require("minimatch-modern");

function adapt(api) {
  function match(path, pattern, options) {
    return api(path, pattern, options);
  }
  Object.assign(match, modern, api);
  match.minimatch = match;
  match.defaults = (options) => adapt(api.defaults(options));

  // The installed eslint-plugin-import only calls .test() on makeRe's result.
  // v11 intentionally removes RegExp generation. Do not reconstruct vulnerable
  // regexes or claim this matcher object is a general RegExp replacement.
  match.makeRe = (pattern, options) => {
    const matcher = new api.Minimatch(pattern, options);
    return Object.freeze({ test: (path) => matcher.match(path) });
  };
  return match;
}

module.exports = adapt(modern.minimatch);
