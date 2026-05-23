<?php
/**
 * Admin list-table columns for the team-member post type.
 *
 * @package AcmePlugin
 */

declare(strict_types=1);

namespace AcmePlugin\Admin;

/**
 * Adds and renders a "Featured" column on the team-member admin list table,
 * and makes it sortable via the featured_team_member post meta value.
 */
final class TeamMemberColumns {

	/** Register WordPress hooks. */
	public function init(): void {
		add_filter( 'manage_team-member_posts_columns', [ $this, 'add_columns' ] );
		add_action( 'manage_team-member_posts_custom_column', [ $this, 'render_column' ], 10, 2 );
		add_filter( 'manage_edit-team-member_sortable_columns', [ $this, 'sortable_columns' ] );
		add_action( 'pre_get_posts', [ $this, 'sort_by_featured' ] );
	}

	/**
	 * Insert the Featured column before the date column.
	 *
	 * @param string[] $columns Existing column headers keyed by column ID.
	 * @return string[] Modified column headers.
	 */
	public function add_columns( array $columns ): array {
		$date = $columns['date'] ?? null;
		unset( $columns['date'] );

		$columns['featured_team_member'] = __( 'Featured', 'acme-plugin' );

		if ( null !== $date ) {
			$columns['date'] = $date;
		}

		return $columns;
	}

	/**
	 * Render the Featured column cell for a given post.
	 *
	 * @param string $column  Column ID being rendered.
	 * @param int    $post_id Current post ID.
	 */
	public function render_column( string $column, int $post_id ): void {
		if ( 'featured_team_member' !== $column ) {
			return;
		}

		$is_featured = (bool) get_post_meta( $post_id, 'featured_team_member', true );

		if ( $is_featured ) {
			echo '<span class="dashicons dashicons-star-filled" style="color:#f0b849;" title="' . esc_attr__( 'Featured', 'acme-plugin' ) . '"></span>';
			echo '<span class="screen-reader-text">' . esc_html__( 'Featured', 'acme-plugin' ) . '</span>';
		} else {
			echo '<span class="dashicons dashicons-star-empty" style="color:#c3c4c7;" title="' . esc_attr__( 'Not featured', 'acme-plugin' ) . '"></span>';
			echo '<span class="screen-reader-text">' . esc_html__( 'Not featured', 'acme-plugin' ) . '</span>';
		}
	}

	/**
	 * Declare the Featured column as sortable.
	 *
	 * @param string[] $sortable Existing sortable columns.
	 * @return string[] Modified sortable columns.
	 */
	public function sortable_columns( array $sortable ): array {
		$sortable['featured_team_member'] = 'featured_team_member';
		return $sortable;
	}

	/**
	 * Apply meta-based ordering when the Featured column is the active sort.
	 *
	 * Only runs on the team-member admin list screen.
	 *
	 * @param \WP_Query $query The current query.
	 */
	public function sort_by_featured( \WP_Query $query ): void {
		if (
			! is_admin() ||
			! $query->is_main_query() ||
			'featured_team_member' !== $query->get( 'orderby' )
		) {
			return;
		}

		$query->set( 'meta_key', 'featured_team_member' );
		$query->set( 'orderby', 'meta_value' );
	}
}
