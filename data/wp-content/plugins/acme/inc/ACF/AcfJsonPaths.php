<?php
/**
 * ACF local JSON save and load points.
 *
 * @package AcmePlugin
 */

declare(strict_types=1);

namespace AcmePlugin\ACF;

/**
 * Registers per-type ACF local JSON save and load paths so that field groups,
 * post types, taxonomies, and UI options pages are stored inside the plugin.
 */
final class AcfJsonPaths {

	private const TYPE_DIR_MAP = [
		'acf-field-group'     => 'field-groups',
		'acf-post-type'       => 'post-types',
		'acf-taxonomy'        => 'taxonomies',
		'acf-ui-options-page' => 'ui-options-pages',
	];

	private string $base_dir;

	public function __construct( string $plugin_dir ) {
		$this->base_dir = trailingslashit( $plugin_dir ) . 'acf-json';
	}

	/** Register save and load filters for each ACF type. */
	public function init(): void {
		foreach ( self::TYPE_DIR_MAP as $type => $subdir ) {
			$path = $this->base_dir . '/' . $subdir;

			add_filter(
				"acf/settings/save_json/type={$type}",
				fn() => $path
			);
		}

		add_filter(
			'acf/settings/load_json',
			fn( array $paths ) => array_merge(
				$paths,
				array_values(
					array_map(
						fn( string $subdir ) => $this->base_dir . '/' . $subdir,
						self::TYPE_DIR_MAP
					)
				)
			)
		);
	}
}
