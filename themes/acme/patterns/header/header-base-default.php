<?php
/**
 * Title: Header - Base
 * Slug: acme/header-base-default
 * Categories: acme/header
 * Block Types: core/template-part/header
 */

?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"0","bottom":"0"}},"position":{"type":"sticky","top":"0px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="padding-top: 0; padding-bottom: 0">

	<!-- wp:acme/dismissible {"dismissId":"dismiss-d602a5aa"} -->

		<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group alignwide" style="padding-top: var(--wp--preset--spacing--20);padding-bottom: var(--wp--preset--spacing--20);">

			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center">
				Speak to a Specialist • <strong><a href="tel:8001234567">800-123-4567</a></strong>
			</p>
			<!-- /wp:paragraph -->

		</div>
		<!-- /wp:group -->

	<!-- /wp:acme/dismissible -->

	<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull has-white-background-color has-background" style="margin-top: 0;margin-bottom: 0;padding-top: var(--wp--preset--spacing--30);padding-bottom: var(--wp--preset--spacing--30);">

		<!-- wp:group {"align":"wide","style":{"layout":{"selfStretch":"fill","flexSize":null}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
		<div class="wp-block-group alignwide">

			<!-- wp:site-logo {"width":160} /-->

			<!-- wp:navigation {"icon":"menu","overlayBackgroundColor":"primary","overlayTextColor":"white","style":{"spacing":{"margin":{"top":"0"}}},"layout":{"type":"flex","setCascadingProperties":true,"justifyContent":"right","orientation":"horizontal"}} /-->

		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
