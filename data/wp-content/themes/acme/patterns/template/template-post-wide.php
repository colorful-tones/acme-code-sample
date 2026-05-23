<?php
/**
 * Title: Post Wide
 * Slug: acme/template-post-wide
 * Template Types: post
 * Description: A blog post with a wide layout.
 * Categories: acme/posts
 * Keywords: post, sidebar
 * Viewport Width: 1400
 * Inserter: false
 */

?>
<!-- wp:template-part {"slug":"header","area":"header","tagName":"header"} /-->
<!-- wp:group {"tagName":"main","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|x-large"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--x-large)"><!-- wp:group {"align":"wide"} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="margin-top:0"><!-- wp:post-featured-image {"height":"450px","align":"wide","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|large"}}}} /-->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|regular"},"margin":{"bottom":"var:preset|spacing|x-large"}}}} -->
<div class="wp-block-columns alignwide" style="margin-bottom:var(--wp--preset--spacing--x-large)"><!-- wp:column {"width":"66.66%","style":{"spacing":{"blockGap":"var:preset|spacing|tiny"}}} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:group {"metadata":{"name":"Breadcrumbs"},"className":"breadcrumbs","layout":{"type":"constrained"}} -->
<div class="wp-block-group breadcrumbs"><!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|tiny","bottom":"var:preset|spacing|tiny"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--tiny);padding-bottom:var(--wp--preset--spacing--tiny)"><!-- wp:yoast-seo/breadcrumbs /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:post-title {"level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"400"},"spacing":{"margin":{"bottom":"var:preset|spacing|small"}}},"fontSize":"x-large"} /-->

<!-- wp:group {"templateLock":"all","lock":{"move":true,"remove":true},"metadata":{"name":"Date"},"className":"has-link-color","textColor":"accent-4","fontSize":"small","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-link-color has-accent-4-color has-text-color has-small-font-size"><!-- wp:post-date {"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}}} /--></div>
<!-- /wp:group -->

<!-- wp:group -->
<div class="wp-block-group"><!-- wp:post-content /--></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"33.33%","templateLock":"all","lock":{"move":true,"remove":true}} -->
<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:template-part {"slug":"sidebar"} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></main>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"},"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|x-large"}}}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--x-large)">
	<!-- wp:pattern {"slug":"acme/post-more-posts"} /-->
</div>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer","area":"footer"} /-->
