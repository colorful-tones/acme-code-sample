<?php
/**
 * Title: Archive Page
 * Slug: acme/template-page-archive
 * Description: The page that shows archives for categories, tags, and more.
 * Categories: acme/pages
 * Keywords: page, full-width
 * Viewport Width: 1400
 * Inserter: false
 */

?>

<!-- wp:template-part {"slug":"header","area":"header","tagName":"header"} /-->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|regular","bottom":"var:preset|spacing|tiny"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--regular);margin-bottom:var(--wp--preset--spacing--tiny)">
	<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"bottom"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:query-title {"type":"archive","showPrefix":false,"style":{"typography":{"fontStyle":"normal","fontWeight":"400"}},"fontSize":"x-large"} /-->

		<!-- wp:term-description /-->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"acme/post-query-loop"} /-->

<!-- wp:template-part {"slug":"footer","area":"footer","tagName":"footer"} /-->
