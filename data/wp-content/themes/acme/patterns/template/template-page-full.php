<?php
/**
 * Title: Page Full Width No Title
 * Slug: acme/template-page-full
 * Template Types: page
 * Description: This full page layout with no title, perfect for building pages with patterns.
 * Categories: acme/pages
 * Keywords: page, full-width
 * Viewport Width: 1400
 * Inserter: false
 */

?>
<!-- wp:template-part {"slug":"header","tagName":"header","className":"site-header"} /-->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|x-large"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--x-large)"><!-- wp:post-content /--></div>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer","className":"site-footer"} /-->
