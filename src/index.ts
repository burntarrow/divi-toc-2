/**
 * Divi TOC – Root Extension Index
 *
 * Exposes the module(s) to Divi 5.
 * The actual builder/runtime wiring is handled by the module definition
 * (edit/styles/customCss/etc.) plus the PHP extension config.
 */

import TableOfContentsModule from './components/table-of-contents-module';

// Optional named export, handy for tests or tooling.
export { TableOfContentsModule };

// Array of modules exposed by this extension.
// Divi 5 expects the default export to contain a `modules` array.
export const modules = [TableOfContentsModule];

export default {
  modules,
};
