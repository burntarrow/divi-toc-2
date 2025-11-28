<?php
/**
 * Divi TOC – Divi 5 Modules Orchestrator
 *
 * This class is required by divi-5/divi5-toc.php
 * and is responsible for:
 *  - Hooking into Divi 5's module dependency tree
 *  - Adding the TableOfContents dependency
 */

namespace DiviTOC\Divi5\Server\Modules;

defined( 'ABSPATH' ) || exit;

use DiviTOC\Divi5\Server\Modules\TableOfContents\TableOfContents;
use ET\Builder\Packages\ModuleLibrary\DependencyInterface;

class Modules {

        /**
         * Register all Divi 5 server-side dependencies for this plugin.
         *
         * Called from divi5-toc.php on 'init'.
         */
        public static function register() {
                // Hook into Divi 5's module dependency tree. The exact filter name
                // mirrors the pattern used by the working divi-content-toggle plugin.
                add_filter(
                        'divi_module_library_modules_dependency_tree',
                        [ __CLASS__, 'register_dependencies' ]
		);
	}

	/**
	 * Add our TableOfContents dependency to Divi's dependency tree.
	 *
	 * @param array $dependencies Existing dependencies.
	 *
         * @return array Modified dependencies including our TOC module.
         */
        public static function register_dependencies( array $dependencies ): array {
                if ( ! interface_exists( DependencyInterface::class ) ) {
                        // Divi 5's ModuleLibrary autoloader is not available; bail quietly.
                        return $dependencies;
                }

                $toc_file = __DIR__ . '/TableOfContents/TableOfContents.php';

                if ( file_exists( $toc_file ) && ! class_exists( TableOfContents::class ) ) {
                        require_once $toc_file;
                }

                if ( class_exists( TableOfContents::class ) ) {
                        $dependencies[] = new TableOfContents();
                }

                return $dependencies;
        }
}
