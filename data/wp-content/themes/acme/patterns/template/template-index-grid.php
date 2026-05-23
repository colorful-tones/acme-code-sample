<?php
/**
 * Title: Post Loop Grid
 * Slug: acme/template-index-grid
 * Template Types: front-page, home, index
 * Description: A three column grid layout for blog posts and archive pages.
 * Categories: acme/posts
 * Keywords: blog, posts, query, loop
 * Viewport Width: 1400
 * Inserter: false
 */

?>
<!-- wp:template-part {"slug":"header","area":"header","tagName":"header"} /-->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|regular","bottom":"var:preset|spacing|tiny"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--regular);margin-bottom:var(--wp--preset--spacing--tiny)">
	<!-- wp:heading {"align":"wide"} -->
	<h2 class="wp-block-heading alignwide">Recent News</h2>
	<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"acme/post-query-loop"} /-->

<!-- wp:template-part {"slug":"footer","tagName":"footer","area":"footer"} /-->
