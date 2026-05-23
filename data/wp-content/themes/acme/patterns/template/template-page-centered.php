<?php
/**
 * Title: Page Centered
 * Slug: acme/template-page-centered
 * Template Types: page
 * Description: A centered page layout where the content sits in a container in the middle of the page.
 * Categories: acme/pages
 * Keywords: page, full-width
 * Viewport Width: 1400
 * Inserter: false
 */

?>
<!-- wp:template-part {"slug":"header","tagName":"header","className":"site-header"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|x-large"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--x-large)"><!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull"><!-- wp:post-content /--></div>
<!-- /wp:group --></main>
<!-- /wp:group -->

