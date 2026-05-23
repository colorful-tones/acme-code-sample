<?php
/**
 * Plugin orchestrator.
 *
 * @package AcmePlugin
 */

declare(strict_types=1);

namespace AcmePlugin;

use AcmePlugin\ACF\AcfJsonPaths;
use AcmePlugin\Admin\TeamMemberColumns;
use AcmePlugin\Assets\AssetLoader;
use AcmePlugin\Blocks\BlockRegistry;
use AcmePlugin\Blocks\QueryLoop;
use AcmePlugin\Modules\ButtonModal;
use AcmePlugin\PostTypes\TeamMemberEditor;
use AcmePlugin\Rest\IconLibrary;

/**
 * Wires up and boots all plugin features.
 */
final class Plugin {

	/** @var self|null */
	private static ?self $instance = null;

	private function __construct() {}

	public static function make(): self {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/** Register WordPress hooks. Called on `plugins_loaded`. */
	public function boot(): void {
		$assets = new AssetLoader( ACME_PLUGIN_URL, ACME_PLUGIN_VERSION );
		add_action( 'wp_enqueue_scripts', [ $assets, 'enqueue_frontend' ] );
		add_action( 'enqueue_block_editor_assets', [ $assets, 'enqueue_editor' ] );
		add_action( 'admin_enqueue_scripts', [ $assets, 'enqueue_admin' ] );

		add_action( 'init', fn() => ( new BlockRegistry( ACME_PLUGIN_DIR ) )->register() );

		( new QueryLoop() )->init();
		( new TeamMemberColumns() )->init();
		( new TeamMemberEditor() )->init();

		( new AcfJsonPaths( ACME_PLUGIN_DIR ) )->init();

		( new ButtonModal() )->init();

		$icon_library = new IconLibrary();
		add_action( 'rest_api_init', [ $icon_library, 'register_rest_routes' ] );
	}

	public function activate(): void {}

	public function deactivate(): void {}
}
