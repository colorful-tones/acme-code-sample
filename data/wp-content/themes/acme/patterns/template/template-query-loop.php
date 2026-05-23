<?php
/**
 * Title: List of posts in cards
 * Slug: acme/template-query-loop
 * Description: A list of posts in cards.
 * Viewport Width: 1400
 * Categories: acme/posts
 * Keywords: posts, loop, query
 * Block Types: core/query
 * Template Types: archive
 */

?>
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"align":"wide"} -->
<h2 class="wp-block-heading alignwide"><?php esc_html_e( 'Latest News', 'acme' ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"tagName":"main","metadata":{"name":"Loop"},"layout":{"type":"constrained"}} -->
<main class="wp-block-group"><!-- wp:query {"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[]},"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-query alignwide"><!-- wp:group {"metadata":{"name":"Post Grid"},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:post-template {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:group {"metadata":{"name":"Post Content"},"style":{"spacing":{"blockGap":"0","padding":{"right":"0","left":"0"}},"dimensions":{"minHeight":"100%"}},"backgroundColor":"grey-100","layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch","verticalAlignment":"space-between"}} -->
<div class="wp-block-group has-grey-100-background-color has-background" style="min-height:100%;padding-right:0;padding-left:0"><!-- wp:post-featured-image {"isLink":true,"width":"100%","height":"150px","style":{"layout":{"selfStretch":"fit","flexSize":null},"spacing":{"margin":{"bottom":"var:preset|spacing|20"}}}} /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"},"padding":{"top":"0","bottom":"0","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}},"dimensions":{"minHeight":"%"},"layout":{"selfStretch":"fill","flexSize":null}},"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"top","flexWrap":"wrap","justifyContent":"left"}} -->
<div class="wp-block-group" style="min-height:%;margin-top:0;margin-bottom:0;padding-top:0;padding-right:var(--wp--preset--spacing--30);padding-bottom:0;padding-left:var(--wp--preset--spacing--30)"><!-- wp:post-title {"isLink":true,"fontSize":"large"} /-->

<!-- wp:post-excerpt {"moreText":"","showMoreOnNewLine":false,"excerptLength":15} /-->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Read Full Article', 'acme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|30","left":"var:preset|spacing|30"},"margin":{"bottom":"var:preset|spacing|30"},"blockGap":"var:preset|spacing|30"}},"fontSize":"small","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"bottom"}} -->
<div class="wp-block-group has-small-font-size" style="margin-bottom:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:post-author {"showAvatar":false,"showBio":false} /-->

<!-- wp:post-date {"isLink":true,"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}}} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Pagination Navigation"},"style":{"spacing":{"blockGap":"0","margin":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"inherit":true,"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--70);margin-bottom:var(--wp--preset--spacing--70)"><!-- wp:query-pagination {"paginationArrow":"chevron","showLabel":false,"align":"wide","layout":{"type":"flex","justifyContent":"center","flexWrap":"wrap"}} -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination --></div>
<!-- /wp:group -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"placeholder":"Add text or blocks that will display when a query returns no results."} -->
<p>
<?php
/* Translators: 1. is the start of a 'a' HTML element, 2. is the end of a 'a' HTML element, 3. is the start of a 'a' HTML element, 4. is the end of a 'a' HTML element, 5. is the start of a 'a' HTML element, 6. is the end of a 'a' HTML element */
echo esc_html( 'We’re sorry, the page you’re trying to get doesn’t exist. If you want to learn more about Acme, please %1$sclick here to visit our homepage.' )
?>
</p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query --></main>
<!-- /wp:group -->
