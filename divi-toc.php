<?php
/**
 * Plugin Name:       Divi TOC
 * Description:       A Divi 5 module that generates a table of contents for page/post headings.
 * Version:           1.0.0
 * Author:            Divi5 Plugins
 * Author URI:        https://divi5-plugins.com
 * Plugin URI:        https://divi5-plugins.com/divi-toc/
 * License:           GPL-3.0-or-later
 * Text Domain:       divi-toc
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Base plugin constants.
 */
define( 'DIVI_TOC_PLUGIN_FILE', __FILE__ );
define( 'DIVI_TOC_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'DIVI_TOC_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Load translations.
 */
add_action( 'plugins_loaded', function () {
    load_plugin_textdomain(
        'divi-toc',
        false,
        dirname( plugin_basename( __FILE__ ) ) . '/languages'
    );
} );

/**
 * 🔥 Register this plugin as a Divi 5 Extension.
 *
 * This is REQUIRED. Without this, Divi 5 will NOT:
 * - Know your extension exists
 * - Load builder scripts automatically
 * - Load module.json definitions
 * - Register modules
 */
add_filter( 'divi.modules.extensions', function ( $extensions ) {
    $extensions['divi-toc'] = require __DIR__ . '/divi-toc-extension.php';
    return $extensions;
} );

/**
 * Load the PHP modules loader.
 *
 * (This loads TableOfContentsModule.php which contains the module's PHP definition.
 *  Actual Divi 5 JS module registration happens via builder.tsx → registerModule().)
 */
require_once DIVI_TOC_PLUGIN_DIR . 'modules/Modules.php';

/**
 * Register modules after Divi initializes.
 */
add_action( 'init', function () {
    if ( class_exists( '\Divi_toc\Modules\Modules' ) ) {
        \Divi_toc\Modules\Modules::register();
    }
}, 20 );

/**
 * Enqueue FRONT-END scripts & styles.
 */
add_action( 'wp_enqueue_scripts', function () {
    // Webpack front-end bundle
    wp_enqueue_script(
        'divi-toc-frontend',
        DIVI_TOC_PLUGIN_URL . 'build/divi-toc-frontend.js',
        [],
        '1.0.0',
        true
    );

    // Shared CSS
    wp_enqueue_style(
        'divi-toc',
        DIVI_TOC_PLUGIN_URL . 'assets/css/divi-toc.css',
        [],
        '1.0.0'
    );
} );
