<?php
/**
 * Title: Page with Sidebar
 * Slug: acme/page-sidebar
 * Description: A page hero with breadcrumbs and sidebar.
 * Categories: acme/pages
 * Keywords: page, layout, design, template
 * Viewport Width: 1400
 * Block Types: core/post-content
 * Post Types: page, wp_template
 * Inserter: true
 */

?>

<!-- wp:pattern {"slug":"acme/hero"} /-->

<!-- wp:group {"tagName":"main","align":"full","layout":{"type":"default"}} -->
<main class="wp-block-group alignfull">
	<!-- wp:pattern {"slug":"acme/hero-page-title"} /-->

<!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|x-large"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--x-large)"><!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"66.66%","style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}}} -->
<div class="wp-block-column" style="flex-basis:66.66%">
	<!-- wp:pattern {"slug":"acme/content-breadcrumbs"} /-->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading"></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"placeholder":"<?php esc_attr_e( 'Start writing here!', 'acme' ); ?>"} -->
<p></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:template-part {"slug":"sidebar"} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></main>
<!-- /wp:group -->
