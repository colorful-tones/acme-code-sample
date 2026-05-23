<?php
/**
 * ACME theme functions and definitions.
 *
 * @package acme
 */

// Disable emojis (save user some bandwidth and speed up page load).
require get_template_directory() . '/inc/disable-emojis.php';

/**
 * Disable theme support/features.
 *
 * @return void
 */
function acme_remove_theme_support(): void {
	// Remove core block patterns.
	remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', 'acme_remove_theme_support' );

/**
 * Modify block editor settings.
 *
 * @param array $settings settings array.
 * @return array
 */
function acme_modify_settings( array $settings ): array {
	$settings['enableOpenverseMediaCategory'] = false;
	return $settings;
}
add_filter( 'block_editor_settings_all', 'acme_modify_settings' );

/**
 * Register block pattern categories.
 *
 * @return void
 */
function acme_register_block_pattern_category(): void {
	$block_pattern_categories = array(
		'acme/card'           => array(
			'label' => __( 'Cards', 'acme' ),
		),
		'acme/call-to-action' => array(
			'label' => __( 'Call To Action', 'acme' ),
		),
		'acme/content'        => array(
			'label' => __( 'Content', 'acme' ),
		),
		'acme/form'           => array(
			'label' => __( 'Forms', 'acme' ),
		),
		'acme/footer'         => array(
			'label' => __( 'Footer', 'acme' ),
		),
		'acme/gallery'        => array(
			'label' => __( 'Gallery', 'acme' ),
		),
		'acme/header'         => array(
			'label' => __( 'Header', 'acme' ),
		),
		'acme/hero'           => array(
			'label' => __( 'Hero', 'acme' ),
		),
		'acme/pages'          => array(
			'label' => __( 'Pages', 'acme' ),
		),
		'acme/posts'          => array(
			'label' => __( 'Posts', 'acme' ),
		),
		'acme/team'           => array(
			'label' => __( 'Team', 'acme' ),
		),
	);

	foreach ( $block_pattern_categories as $name => $properties ) {
		register_block_pattern_category( $name, $properties );
	}
}
add_action( 'init', 'acme_register_block_pattern_category' );

/**
 * Enqueue theme styles.
 *
 * @return void
 */
function acme_enqueue_style(): void {

	wp_enqueue_style(
		'acme-styles',
		get_template_directory_uri() . '/style.css',
		[],
		filemtime( get_stylesheet_directory() . '/style.css' )
	);
}
add_action( 'wp_enqueue_scripts', 'acme_enqueue_style' );

/**
 * Load custom block styles only when the block is used.
 *
 * @return void
 */
function acme_enqueue_custom_block_styles() {

	// Scan our styles folder to locate block styles.
	$files = glob( get_template_directory() . '/assets/styles/*.css' );

	foreach ( $files as $file ) {

		// Get the filename and core block name.
		$filename   = basename( $file, '.css' );
		$block_name = str_replace( 'core-', 'core/', $filename );

		wp_enqueue_block_style(
			$block_name,
			array(
				'handle' => "acme-block-{$filename}",
				'src'    => get_theme_file_uri( "assets/styles/{$filename}.css" ),
				'path'   => get_theme_file_path( "assets/styles/{$filename}.css" ),
			)
		);
	}
}
add_action( 'init', 'acme_enqueue_custom_block_styles' );

/**
 * Render the Accordion block with FAQ schema if they have the `is-faqs` class.
 *
 * @param string $content The block content.
 * @return string The updated block content.
 */
function acme_render_accordion_faqs_schema( $content ): string {
	$processor = new WP_HTML_Tag_Processor( $content );

	// Bail early if there's no Accordion block with the `.is-faqs` class.
	if (
		! $processor->next_tag( [ 'class_name' => 'wp-block-accordion' ] )
		|| ! $processor->has_class( 'is-faqs' )
	) {
		return $processor->get_updated_html();
	}

	// Add attributes to wrapping accordion block.
	$processor->set_attribute( 'itemscope', true );
	$processor->set_attribute( 'itemtype', 'https://schema.org/FAQPage' );

	// Loop through accordion items and add attributes.
	while ( $processor->next_tag( [ 'class_name' => 'wp-block-accordion-item' ] ) ) {
		$processor->set_attribute( 'itemscope', true );
		$processor->set_attribute( 'itemprop', 'mainEntity' );
		$processor->set_attribute( 'itemtype', 'https://schema.org/Question' );

		// Add attributes to the title element.
		if ( $processor->next_tag( [ 'class_name' => 'wp-block-accordion-heading__toggle-title' ] ) ) {
			$processor->set_attribute( 'itemprop', 'name' );
		}

		// Add attributes to the panel.
		if ( $processor->next_tag( [ 'class_name' => 'wp-block-accordion-panel' ] ) ) {
			$processor->set_attribute( 'itemscope', true );
			$processor->set_attribute( 'itemprop', 'acceptedAnswer' );
			$processor->set_attribute( 'itemtype', 'https://schema.org/Answer' );

			// Add attribute to first paragraph.
			if ( $processor->next_tag( 'p' ) ) {
				$processor->set_attribute( 'itemprop', 'text' );
			}
		}
	}

	return $processor->get_updated_html();
}
add_filter( 'render_block_core/accordion', 'acme_render_accordion_faqs_schema' );

/**
 * Render the Accordion block with custom SVG icons.
 *
 * @param string $content The block content.
 * @return string The updated block content.
 */
function acme_render_accordion_icons( $content ): string {
	$plus_icon  = '<svg xmlns="http://www.w3.org/2000/svg" class="accordion-icon accordion-icon--plus" width="18" height="18" viewBox="0 0 18 18" fill="currentColor"><path d="M16.25 6.875H10.625V1.25C10.625 0.559766 10.0652 0 9.375 0H8.125C7.43477 0 6.875 0.559766 6.875 1.25V6.875H1.25C0.559766 6.875 0 7.43477 0 8.125V9.375C0 10.0652 0.559766 10.625 1.25 10.625H6.875V16.25C6.875 16.9402 7.43477 17.5 8.125 17.5H9.375C10.0652 17.5 10.625 16.9402 10.625 16.25V10.625H16.25C16.9402 10.625 17.5 10.0652 17.5 9.375V8.125C17.5 7.43477 16.9402 6.875 16.25 6.875Z"/></svg>';
	$minus_icon = '<svg xmlns="http://www.w3.org/2000/svg" class="accordion-icon accordion-icon--minus" width="18" height="4" viewBox="0 0 18 4" fill="currentColor"><path d="M16.25 0H1.25C0.559766 0 0 0.559766 0 1.25V2.5C0 3.19023 0.559766 3.75 1.25 3.75H16.25C16.9402 3.75 17.5 3.19023 17.5 2.5V1.25C17.5 0.559766 16.9402 0 16.25 0Z"/></svg>';

	// Scope the replacement to the toggle-icon element so '+' in accordion content is not affected.
	return preg_replace_callback(
		'~(<[^>]+class="[^"]*wp-block-accordion-heading__toggle-icon[^"]*"[^>]*>)\s*\+\s*(</[^>]+>)~',
		static function ( $matches ) use ( $plus_icon, $minus_icon ) {
			return $matches[1] . $plus_icon . $minus_icon . $matches[2];
		},
		$content
	) ?? $content;
}
add_filter( 'render_block_core/accordion', 'acme_render_accordion_icons' );
