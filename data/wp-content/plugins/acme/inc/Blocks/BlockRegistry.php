<?php
/**
 * Block registry.
 *
 * @package AcmePlugin
 */

declare(strict_types=1);

namespace AcmePlugin\Blocks;

/**
 * Auto-discovers and registers blocks from the build directory.
 *
 * Each block must have a block.json in build/blocks/{block-name}/.
 * Run `npm run build` to compile blocks from blocks/{block-name}/index.js.
 */
final class BlockRegistry {

	/**
	 * Absolute path to the plugin root directory.
	 *
	 * @var string
	 */
	private string $plugin_dir;

	/**
	 * Constructor.
	 *
	 * @param string $plugin_dir Absolute path to the plugin root directory.
	 */
	public function __construct( string $plugin_dir ) {
		$this->plugin_dir = $plugin_dir;
	}

	/** Discover and register all blocks from the build directory. */
	public function register(): void {
		$blocks_dir = $this->plugin_dir . 'build/blocks';

		if ( ! is_dir( $blocks_dir ) ) {
			return;
		}

		$block_json_files = glob( $blocks_dir . '/*/block.json' );

		if ( false === $block_json_files ) {
			$block_json_files = [];
		}

		foreach ( $block_json_files as $block_json ) {
			register_block_type( dirname( $block_json ) );
		}
	}
}
