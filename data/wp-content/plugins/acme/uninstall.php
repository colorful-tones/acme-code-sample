<?php
/**
 * Uninstall routine — runs only when the plugin is deleted from the WP admin.
 */

declare(strict_types=1);

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option( 'acme_plugin_options' );
