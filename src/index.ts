/**
 * Divi TOC – Root Extension Index
 *
 * Exposes the module(s) for tooling or potential future use.
 * Actual registration with the Divi 5 builder is handled in src/builder.tsx
 * via the divi-module-shim.
 */

import { TableOfContentsModule } from './components/table-of-contents-module';

export const modules = [TableOfContentsModule];

export { TableOfContentsModule };

export default {
  modules,
};
