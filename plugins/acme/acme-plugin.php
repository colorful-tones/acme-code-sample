<?php
/**
 * Plugin Name:       Acme
 * Description:       Modular WordPress plugin for Acme.
 * Version:           1.0.0
 * Requires at least: 6.4
 * Requires PHP:      8.1
 * Author:            Damon Cook
 * License:           GPL-2.0-or-later
 * Text Domain:       acme-plugin
 */

declare(strict_types=1);

use AcmePlugin\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Require Composer autoloader; fall back to a PSR-4 loader for standalone installs (e.g. WordPress Playground).
if ( file_exists( dirname( __DIR__, 2 ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __DIR__, 2 ) . '/vendor/autoload.php';
} else {
	spl_autoload_register(
		static function ( string $class ): void {
			$prefix = 'AcmePlugin\\';
			$len    = strlen( $prefix );
			if ( strncmp( $prefix, $class, $len ) !== 0 ) {
				return;
			}
			$file = __DIR__ . '/inc/' . str_replace( '\\', '/', substr( $class, $len ) ) . '.php';
			if ( file_exists( $file ) ) {
				require $file;
			}
		}
	);
}

define( 'ACME_PLUGIN_VERSION', '1.0.0' );
define( 'ACME_PLUGIN_FILE', __FILE__ );
define( 'ACME_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'ACME_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

$acme_plugin = Plugin::make();

register_activation_hook( __FILE__, [ $acme_plugin, 'activate' ] );
register_deactivation_hook( __FILE__, [ $acme_plugin, 'deactivate' ] );

add_action( 'plugins_loaded', [ $acme_plugin, 'boot' ] );
