<?php
/**
 * Button Modal Module
 *
 * Extends the core Button block with modal functionality for Synced Patterns.
 *
 * @package AcmePlugin
 */

declare(strict_types=1);

namespace AcmePlugin\Modules;

/**
 * Handles button modal functionality and asset enqueuing.
 */
class ButtonModal {

	/**
	 * Flag to track if modal assets have been enqueued.
	 *
	 * @var bool
	 */
	private bool $assets_enqueued = false;

	/**
	 * Collection of pattern IDs that need modals on this page.
	 *
	 * @var array<int>
	 */
	private array $modal_pattern_ids = [];

	/**
	 * Collection of custom modal headings indexed by pattern ID.
	 *
	 * @var array<int, string>
	 */
	private array $modal_custom_headings = [];

	/**
	 * Initialize the module.
	 */
	public function init(): void {
		\add_filter( 'render_block', [ $this, 'render_button_block' ], 10, 2 );
		\add_action( 'wp_footer', [ $this, 'render_modal_dialogs' ], 99 );
	}

	/**
	 * Filter the button block output to detect modal attributes and enqueue assets.
	 *
	 * @param string $block_content The block content.
	 * @param array  $block         The full block, including name and attributes.
	 * @return string Modified block content.
	 */
	public function render_button_block( string $block_content, array $block ): string {
		// Only process button blocks.
		if ( 'core/button' !== $block['blockName'] ) {
			return $block_content;
		}

		// Get block attributes.
		$attributes = $block['attrs'] ?? [];

		// Check if modal is enabled.
		$is_modal_enabled     = $attributes['isModalEnabled'] ?? false;
		$pattern_id           = $attributes['patternId'] ?? 0;
		$has_custom_heading   = $attributes['hasCustomModalHeading'] ?? false;
		$custom_modal_heading = $attributes['customModalHeading'] ?? '';

		// If modal is not enabled, return original content.
		if ( ! $is_modal_enabled ) {
			return $block_content;
		}

		// Enqueue modal assets (only once per page).
		if ( ! $this->assets_enqueued ) {
			$this->enqueue_modal_assets();
			$this->assets_enqueued = true;
		}

		// Track pattern ID for modal rendering.
		if ( ! empty( $pattern_id ) && is_numeric( $pattern_id ) ) {
			$pattern_id_int = (int) $pattern_id;
			if ( ! in_array( $pattern_id_int, $this->modal_pattern_ids, true ) ) {
				$this->modal_pattern_ids[] = $pattern_id_int;
			}

			// Store custom heading if provided.
			if ( $has_custom_heading && ! empty( $custom_modal_heading ) ) {
				$this->modal_custom_headings[ $pattern_id_int ] = $custom_modal_heading;
			}
		}

		// Process the block content to add data attributes.
		return $this->add_modal_attributes( $block_content, $pattern_id );
	}

	/**
	 * Add modal data attributes to the button using WP_HTML_Tag_Processor.
	 *
	 * Handles both <a> and <button> elements that WordPress Button block can render.
	 *
	 * @param string $block_content The block content.
	 * @param int    $pattern_id    The pattern post ID.
	 * @return string Modified block content.
	 */
	private function add_modal_attributes( string $block_content, int $pattern_id ): string {
		$processor = new \WP_HTML_Tag_Processor( $block_content );

		// Find the button element (can be either <a> or <button>).
		while ( $processor->next_tag() ) {
			$tag_name        = $processor->get_tag();
			$class_attribute = $processor->get_attribute( 'class' );

			// Check if this is the button element (link or button).
			if ( ( 'A' === $tag_name || 'BUTTON' === $tag_name ) &&
				$class_attribute &&
				strpos( $class_attribute, 'wp-block-button__link' ) !== false ) {

				// Add modal data attributes.
				$processor->set_attribute( 'data-modal-enabled', 'true' );

				if ( ! empty( $pattern_id ) ) {
					$processor->set_attribute( 'data-pattern-id', (string) $pattern_id );

					// Set href for <a> tags, data-open-modal for <button> tags.
					if ( 'A' === $tag_name ) {
						$processor->set_attribute( 'href', '#modal-pattern-' . $pattern_id );
					} else {
						// For button elements, use data-open-modal attribute.
						$processor->set_attribute( 'data-open-modal', 'modal-pattern-' . $pattern_id );
					}
				}

				// Add a class for easier styling/targeting.
				$processor->add_class( 'has-modal' );

				// Stop after finding the first button element.
				break;
			}
		}

		return $processor->get_updated_html();
	}

	/**
	 * Enqueue modal JavaScript and CSS.
	 *
	 * This method will enqueue the modal assets when a button with modal
	 * attributes is detected on the page.
	 */
	private function enqueue_modal_assets(): void {
		$modal_js_path = ACME_PLUGIN_DIR . 'build/frontend-button-modal.js';

		if ( file_exists( $modal_js_path ) ) {
			$asset_file = ACME_PLUGIN_DIR . 'build/frontend-button-modal.asset.php';
			$asset_data = file_exists( $asset_file ) ? require $asset_file : [
				'dependencies' => [],
				'version'      => ACME_PLUGIN_VERSION,
			];

			\wp_enqueue_script(
				'acme-button-modal',
				ACME_PLUGIN_URL . 'build/frontend-button-modal.js',
				$asset_data['dependencies'],
				$asset_data['version'],
				true
			);
		}

		$modal_css_path = ACME_PLUGIN_DIR . 'build/frontend-button-modal.css';

		if ( file_exists( $modal_css_path ) ) {
			\wp_enqueue_style(
				'acme-button-modal',
				ACME_PLUGIN_URL . 'build/frontend-button-modal.css',
				[],
				ACME_PLUGIN_VERSION
			);
		}

		/**
		 * Hook to allow enqueueing additional modal assets.
		 *
		 * @since 0.1.0
		 */
		\do_action( 'acme_plugin_button_modal_enqueue_assets' );
	}

	/**
	 * Render modal dialog elements with Synced Patterns in the footer.
	 *
	 * Outputs all modal dialogs needed for the current page.
	 */
	public function render_modal_dialogs(): void {
		// Skip if no patterns need modals.
		if ( empty( $this->modal_pattern_ids ) ) {
			return;
		}

		foreach ( $this->modal_pattern_ids as $pattern_id ) {
			$this->render_single_modal_dialog( $pattern_id );
		}
	}

	/**
	 * Render a single modal dialog with Synced Pattern.
	 *
	 * @param int $pattern_id The pattern post ID (wp_block post type).
	 */
	private function render_single_modal_dialog( int $pattern_id ): void {
		// Get the pattern post.
		$pattern = \get_post( $pattern_id );

		if ( ! $pattern || 'wp_block' !== $pattern->post_type ) {
			// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
			error_log( sprintf( 'ACME Button Modal: Pattern ID %d not found or is not a synced pattern.', $pattern_id ) );
			return;
		}

		// Get pattern title for accessibility.
		// Use custom heading if available, otherwise fall back to pattern title.
		// Translators: %d: The ID of the synced pattern post.
		if ( isset( $this->modal_custom_headings[ $pattern_id ] ) && ! empty( $this->modal_custom_headings[ $pattern_id ] ) ) {
			$modal_title = $this->modal_custom_headings[ $pattern_id ];
		} elseif ( ! empty( $pattern->post_title ) ) {
			$modal_title = $pattern->post_title;
		} else {
			$modal_title = sprintf(
				// Translators: %d: The ID of the synced pattern post.
				__( 'Pattern %d', 'acme-plugin' ),
				$pattern_id
			);
		}

		// Get and render the pattern content.
		$pattern_content = $pattern->post_content;

		?>
		<dialog id="modal-pattern-<?php echo esc_attr( $pattern_id ); ?>" class="acme-modal" aria-labelledby="modal-pattern-title-<?php echo esc_attr( $pattern_id ); ?>" data-pattern-id="<?php echo esc_attr( $pattern_id ); ?>">
			<div class="acme-modal__container">
				<div class="acme-modal__header">
					<h2 id="modal-pattern-title-<?php echo esc_attr( $pattern_id ); ?>" class="acme-modal__title">
						<?php echo esc_html( $modal_title ); ?>
					</h2>
					<button type="button" class="acme-modal__close" aria-label="<?php esc_attr_e( 'Close modal', 'acme-plugin' ); ?>" data-close-modal="">
						<svg xmlns="http://www.w3.org/2000/svg" class="acme-modal__close-icon" focusable="false" aria-hidden="true" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2" viewBox="0 0 17 17"><path d="m14.127 12.808 6.099-6.098a.564.564 0 0 0 0-.797l-1.06-1.059a.56.56 0 0 0-.797 0l-6.098 6.098-6.099-6.098a.56.56 0 0 0-.797 0L4.316 5.913a.564.564 0 0 0 0 .797l6.099 6.098-6.099 6.099a.564.564 0 0 0 0 .797l1.059 1.059c.221.22.577.22.797 0l6.099-6.098 6.098 6.098c.221.22.577.22.797 0l1.06-1.059a.564.564 0 0 0 0-.797z" style="fill-rule:nonzero" transform="translate(-4.15 -4.688)"/></svg>
					</button>
				</div>
				<div class="acme-modal__content">
					<?php
					/**
					 * Allow customization before pattern rendering.
					 *
					 * @param int      $pattern_id The pattern ID.
					 * @param \WP_Post $pattern    The pattern post object.
					 */
					\do_action( 'acme_plugin_button_modal_before_pattern', $pattern_id, $pattern );

					// Render the pattern content (parse blocks).
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Content is rendered blocks from pattern.
					echo do_blocks( $pattern_content );

					/**
					 * Allow customization after pattern rendering.
					 *
					 * @param int      $pattern_id The pattern ID.
					 * @param \WP_Post $pattern    The pattern post object.
					 */
					\do_action( 'acme_plugin_button_modal_after_pattern', $pattern_id, $pattern );
					?>
				</div>
			</div>
		</dialog>
		<?php
	}
}
