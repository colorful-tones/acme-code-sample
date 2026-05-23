<?php
/**
 * Rest endpoint for icon library.
 *
 * @package AcmePlugin
 */

declare(strict_types=1);

namespace AcmePlugin\Rest;

/**
 * Registers and serves the SVG icon library via a REST endpoint.
 */
class IconLibrary {

	/**
	 * Get the base SVG url.
	 *
	 * @return string file url.
	 */
	public function get_base_url(): string {
		return ACME_PLUGIN_URL . 'assets/svg/';
	}

	/**
	 * Get the base SVG path.
	 *
	 * @return string file path.
	 */
	public function get_base_path(): string {
		return ACME_PLUGIN_DIR . 'assets/svg/';
	}

	/**
	 * Get the SVG url.
	 *
	 * @param string $filename file url.
	 * @param string $group optional group/subdirectory.
	 * @return string
	 */
	public function get_svg_url( string $filename, string $group = '' ): string {
		$base_url = $this->get_base_url();

		if ( ! empty( $group ) ) {
			$base_url .= $group . '/';
		}
		return $base_url . $filename;
	}

	/**
	 * Get the SVG path.
	 *
	 * @param string $filename file path.
	 * @param string $group optional group/subdirectory.
	 * @return string
	 */
	public function get_svg_path( string $filename, string $group = '' ): string {
		$base_path = $this->get_base_path();

		if ( ! empty( $group ) ) {
			$base_path .= $group . '/';
		}
		return $base_path . $filename;
	}

	/**
	 * Register REST endpoint for editor access.
	 *
	 * @return void
	 */
	public function register_rest_routes(): void {
		register_rest_route(
			'acme-plugin/v1',
			'/svg-images',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'get_svg_list' ),
				'permission_callback' => array( $this, 'can_edit_posts' ),
			)
		);
	}

	/**
	 * Permission callback: requires edit_posts capability.
	 *
	 * @return bool
	 */
	public function can_edit_posts(): bool {
		return current_user_can( 'edit_posts' );
	}

	/**
	 * Get list of svg images organized by directory.
	 *
	 * @return array list of images grouped by directory.
	 */
	public function get_svg_list(): array {
		$cache_key = 'acme_plugin_svg_list';
		$cached    = wp_cache_get( $cache_key, 'acme-plugin' );

		if ( false !== $cached ) {
			return $cached;
		}

		$svg_base_path   = $this->get_base_path();
		$svg_base_url    = $this->get_base_url();
		$grouped_images  = array();
		$normalized_base = rtrim( $svg_base_path, '/' );

		if ( ! is_dir( $svg_base_path ) ) {
			return $grouped_images;
		}

		// Get all subdirectories, then append the base directory itself.
		$directories   = glob( $svg_base_path . '*', GLOB_ONLYDIR );
		$directories[] = $normalized_base;

		foreach ( $directories as $dir ) {
			$is_base_dir = ( rtrim( $dir, '/' ) === $normalized_base );
			$group_name  = $is_base_dir ? 'general' : basename( $dir );
			$svg_files   = glob( $dir . '/*.svg' );

			if ( empty( $svg_files ) ) {
				continue;
			}

			$grouped_images[ $group_name ] = array();

			foreach ( $svg_files as $file ) {
				$filename = basename( $file );
				$url_path = $is_base_dir ? $filename : $group_name . '/' . $filename;

				$grouped_images[ $group_name ][] = array(
					'name'    => pathinfo( $filename, PATHINFO_FILENAME ),
					'slug'    => pathinfo( $filename, PATHINFO_FILENAME ) . '-' . $group_name,
					'url'     => $svg_base_url . $url_path,
					'content' => file_get_contents( $file ), // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
				);
			}
		}

		wp_cache_set( $cache_key, $grouped_images, 'acme-plugin', HOUR_IN_SECONDS );

		return $grouped_images;
	}
}
