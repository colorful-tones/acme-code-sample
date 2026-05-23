<?php
/**
 * Title: Team Members Query
 * Slug: acme/team-members-query
 * Description: Team members grid with avatar, name, credentials, job title, and department.
 * Viewport Width: 1400
 * Categories: acme/team
 * Keywords: team, staff, members, query, loop
 * Block Types: core/query
 */

?>
<!-- wp:query {"query":{"perPage":12,"pages":0,"offset":0,"postType":"team-member","order":"asc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":null,"parents":[],"featuredOnly":false},"namespace":"acme/team-member-query","layout":{"type":"default"}} -->
<div class="wp-block-query">

<!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:acme/team-member-card /-->
<!-- /wp:post-template -->

</div>
<!-- /wp:query -->
