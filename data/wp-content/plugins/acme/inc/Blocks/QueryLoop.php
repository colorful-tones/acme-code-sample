<?php
/**
 * Query Loop block server-side extension.
 *
 * @package AcmePlugin
 */

declare(strict_types=1);

namespace AcmePlugin\Blocks;

/**
 * Filters the Query Loop block's WP_Query args to support the
 * featured_team_member ACF field when the post type is team-member.
 */
final class QueryLoop {

	/** Register WordPress hooks. */
	public function init(): void {
		add_filter( 'query_loop_block_query_vars', [ $this, 'apply_featured_filter' ], 10, 3 );
		add_filter( 'rest_team-member_collection_params', [ $this, 'register_rest_param' ] );
		add_filter( 'rest_team-member_query', [ $this, 'apply_rest_featured_filter' ], 10, 2 );
	}

	/**
	 * Register featuredOnly as an allowed boolean REST collection param.
	 *
	 * core/post-template spreads all extra query attributes (via rest element
	 * destructuring) into its getEntityRecords call, so featuredOnly is already
	 * sent as a URL param by the editor. Registering it here lets WordPress
	 * sanitize it to a boolean before our filter reads it.
	 *
	 * @param array $params Existing collection params.
	 * @return array Modified collection params.
	 */
	public function register_rest_param( array $params ): array {
		$params['featuredOnly'] = [
			'description' => __( 'Filter by featured team member status.', 'acme-plugin' ),
			'type'        => 'boolean',
			'default'     => false,
		];

		return $params;
	}

	/**
	 * Apply the featured_team_member meta query when featuredOnly is true in a REST request.
	 *
	 * @param array            $args    WP_Query args from the REST request.
	 * @param \WP_REST_Request $request The current REST request.
	 * @return array Modified query args.
	 */
	public function apply_rest_featured_filter( array $args, \WP_REST_Request $request ): array {
		if ( true !== $request->get_param( 'featuredOnly' ) ) {
			return $args;
		}

		$args['meta_query'] = array_merge( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query -- intentional filter on indexed ACF field.
			$args['meta_query'] ?? [],
			[
				[
					'key'   => 'featured_team_member',
					'value' => '1',
				],
			]
		);

		return $args;
	}

	/**
	 * Inject a meta_query condition when featuredOnly is set on a team-member query.
	 *
	 * @param array     $query_args WP_Query args built by the block.
	 * @param \WP_Block $block     The block instance being rendered.
	 * @return array Modified query args.
	 */
	public function apply_featured_filter( array $query_args, \WP_Block $block ): array {
		$block_query = $block->context['query'] ?? [];

		if (
			( $block_query['postType'] ?? '' ) !== 'team-member' ||
			empty( $block_query['featuredOnly'] )
		) {
			return $query_args;
		}

		$query_args['meta_query'] = array_merge( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query -- intentional filter on indexed ACF field.
			$query_args['meta_query'] ?? [],
			[
				[
					'key'     => 'featured_team_member',
					'value'   => '1',
					'compare' => '=',
				],
			]
		);

		return $query_args;
	}
}
