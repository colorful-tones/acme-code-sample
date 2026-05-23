<?php
/**
 * Title: Page with Recent Posts section
 * Slug: acme/template-page-recent-posts
 * Template Types: page
 * Description: This page layout with recent posts, perfect for building pages with patterns.
 * Categories: acme/pages
 * Keywords: page, recent-posts
 * Viewport Width: 1400
 * Inserter: false
 */

?>
<!-- wp:template-part {"slug":"header","tagName":"header","className":"site-header"} /-->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|x-large"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--x-large)"><!-- wp:post-content /--></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"},"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|x-large","top":"var:preset|spacing|large"}}}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--x-large);margin-top:var(--wp--preset--spacing--large);">
	<!-- wp:pattern {"slug":"acme/post-more-posts"} /-->
</div>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer","className":"site-footer"} /-->
