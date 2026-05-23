<?php
/**
 * Block editor and ACF datastore settings for the team-member post type.
 *
 * @package AcmePlugin
 */

declare(strict_types=1);

namespace AcmePlugin\PostTypes;

/**
 * Disables the block editor for team-member, enables the ACF 6.8+ datastore,
 * and registers the 300×300 team-member-photo image size.
 */
final class TeamMemberEditor {

	public function init(): void {
		add_filter( 'acf/settings/enable_datastore', '__return_true' );
		add_filter( 'use_block_editor_for_post_type', [ $this, 'disable_block_editor' ], 10, 2 );
		add_action( 'init', [ $this, 'register_image_size' ] );
	}

	/**
	 * @param bool   $use_block_editor
	 * @param string $post_type
	 */
	public function disable_block_editor( bool $use_block_editor, string $post_type ): bool {
		if ( 'team-member' === $post_type ) {
			return false;
		}

		return $use_block_editor;
	}

	public function register_image_size(): void {
		add_image_size( 'team-member-photo', 300, 300, true );
	}
}
