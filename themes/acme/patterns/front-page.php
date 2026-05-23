<?php
/**
 * Title: front-page
 * Slug: acme/front-page
 * Inserter: no
 */

?>
<!-- wp:template-part {"slug":"header","tagName":"header","area":"header","className":"header-nav-background"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<main class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"metadata":{"name":"Hero (with color changing header)"},"align":"full","className":"has-matching-header-bg-color","style":{"spacing":{"padding":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large"}},"elements":{"link":{"color":{"text":"var:preset|color|white"},":hover":{"color":{"text":"var:preset|color|neutral-400"}}},"heading":{"color":{"text":"var:preset|color|neutral-400"}}}},"backgroundColor":"primary","textColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-matching-header-bg-color has-white-color has-primary-background-color has-text-color has-background has-link-color" style="padding-top:var(--wp--preset--spacing--x-large);padding-bottom:var(--wp--preset--spacing--x-large)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|regular","left":"100px"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">
Structure support.<br>Real recovery.</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"medium"} -->
<p class="has-medium-font-size"><?php esc_html_e( 'A thoughtfully designed clinical environment where evidence-based treatment meets genuine compassion. Every detail of your care has been considered.', 'acme' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"tagName":"button","className":"is-style-button-secondary","isModalEnabled":true,"patternId":274,"hasCustomModalHeading":true,"customModalHeading":"Speak to a specialist"} -->
<div class="wp-block-button is-style-button-secondary" data-modal-enabled="true" data-pattern-id="274" data-custom-modal-heading="Speak to a specialist"><button type="button" class="wp-block-button__link wp-element-button">Speak with Admissions <img data-slug="arrow-right-general" data-icon="arrow-right" src="<?php echo esc_url( get_site_url() ); ?>/wp-content/plugins/acme/assets/svg/arrow-right.svg" alt="" style="--icon-url: url(<?php echo esc_url( get_site_url() ); ?>/wp-content/plugins/acme/assets/svg/arrow-right.svg); max-width: 16px; max-height: 16px;" class="wp-icon-inline"></button></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|tiny","margin":{"top":"var:preset|spacing|large"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--large)"><!-- wp:group {"metadata":{"name":"Avatars"},"className":"avatar-block","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group avatar-block"><!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"layout":{"selfStretch":"fixed","flexSize":"41px"},"border":{"radius":{"topLeft":"1000px","topRight":"1000px","bottomLeft":"1000px","bottomRight":"1000px"},"width":"2px"},"shadow":"var:preset|shadow|subtile"},"borderColor":"neutral-400"} -->
<figure class="wp-block-image size-full has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/avatar1.jpg" alt="" class="has-border-color has-neutral-400-border-color" style="border-width:2px;border-top-left-radius:1000px;border-top-right-radius:1000px;border-bottom-left-radius:1000px;border-bottom-right-radius:1000px;box-shadow:var(--wp--preset--shadow--subtile);aspect-ratio:1;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"layout":{"selfStretch":"fixed","flexSize":"41px"},"border":{"radius":{"topLeft":"1000px","topRight":"1000px","bottomLeft":"1000px","bottomRight":"1000px"},"width":"2px"},"shadow":"var:preset|shadow|subtile","spacing":{"margin":{"left":"-11px"}}},"borderColor":"neutral-400"} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-left:-11px"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/avatar2.jpg" alt="" class="has-border-color has-neutral-400-border-color" style="border-width:2px;border-top-left-radius:1000px;border-top-right-radius:1000px;border-bottom-left-radius:1000px;border-bottom-right-radius:1000px;box-shadow:var(--wp--preset--shadow--subtile);aspect-ratio:1;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"layout":{"selfStretch":"fixed","flexSize":"41px"},"border":{"radius":{"topLeft":"1000px","topRight":"1000px","bottomLeft":"1000px","bottomRight":"1000px"},"width":"2px"},"shadow":"var:preset|shadow|subtile","spacing":{"margin":{"left":"-11px"}}},"borderColor":"neutral-400"} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-left:-11px"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/avatar3.jpg" alt="" class="has-border-color has-neutral-400-border-color" style="border-width:2px;border-top-left-radius:1000px;border-top-right-radius:1000px;border-bottom-left-radius:1000px;border-bottom-right-radius:1000px;box-shadow:var(--wp--preset--shadow--subtile);aspect-ratio:1;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"layout":{"selfStretch":"fixed","flexSize":"41px"},"border":{"radius":{"topLeft":"1000px","topRight":"1000px","bottomLeft":"1000px","bottomRight":"1000px"},"width":"2px"},"shadow":"var:preset|shadow|subtile","spacing":{"margin":{"left":"-11px"}}},"borderColor":"neutral-400"} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-left:-11px"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/avatar4.jpg" alt="" class="has-border-color has-neutral-400-border-color" style="border-width:2px;border-top-left-radius:1000px;border-top-right-radius:1000px;border-bottom-left-radius:1000px;border-bottom-right-radius:1000px;box-shadow:var(--wp--preset--shadow--subtile);aspect-ratio:1;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|primary-alt"}}},"typography":{"lineHeight":"1.3"}},"textColor":"primary-alt","fontSize":"small"} -->
<p class="has-primary-alt-color has-text-color has-link-color has-small-font-size" style="line-height:1.3">
<strong>Over 4,000</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|primary-alt"}}},"typography":{"lineHeight":"1.3"}},"fontSize":"small"} -->
<p class="has-link-color has-small-font-size" style="line-height:1.3"><?php esc_html_e( '5 Star Google Reviews', 'acme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"aspectRatio":"3/2","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":{"topLeft":"5px","topRight":"5px","bottomLeft":"5px","bottomRight":"5px"}}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/lounge.jpg" alt="<?php esc_attr_e( 'Lounge with plenty of comfortable couches', 'acme' ); ?>" style="border-top-left-radius:5px;border-top-right-radius:5px;border-bottom-left-radius:5px;border-bottom-right-radius:5px;aspect-ratio:3/2;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"neutral-500","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-neutral-500-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--x-large);padding-bottom:var(--wp--preset--spacing--x-large)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignwide"><!-- wp:paragraph {"className":"has-secondary-100-color has-text-color has-link-color","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.04em","fontStyle":"normal","fontWeight":"500","textAlign":"left"},"elements":{"link":{"color":{"text":"var:preset|color|secondary-100"}}}},"textColor":"secondary-100","fontSize":"small"} -->
<p class="has-text-align-left has-secondary-100-color has-text-color has-link-color has-small-font-size" style="font-style:normal;font-weight:500;letter-spacing:0.04em;text-transform:uppercase"><?php esc_html_e( 'Evidence-Based Care', 'acme' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"align":"wide","style":{"typography":{"textAlign":"left"}}} -->
<h2 class="wp-block-heading has-text-align-left alignwide"><?php esc_html_e( 'Treatment Programs', 'acme' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|tiny","bottom":"var:preset|spacing|regular"}},"elements":{"link":{"color":{"text":"var:preset|color|neutral-100"}}}},"textColor":"neutral-100","fontSize":"medium"} -->
<p class="has-neutral-100-color has-text-color has-link-color has-medium-font-size" style="margin-top:var(--wp--preset--spacing--tiny);margin-bottom:var(--wp--preset--spacing--regular)"><?php esc_html_e( 'Non aliquip laboris ad eiusmod proident exercitation dolor ipsum culpa ipsum aliqua consectetur amet enim dolor voluptate cupidatat.', 'acme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":{"topLeft":"5px","topRight":"5px","bottomLeft":"5px","bottomRight":"5px"},"width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|small","right":"var:preset|spacing|small"},"blockGap":"var:preset|spacing|tiny"},"dimensions":{"minHeight":"100%"}},"backgroundColor":"white","borderColor":"neutral-400","layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch","verticalAlignment":"space-between"}} -->
<div class="wp-block-group has-border-color has-neutral-400-border-color has-white-background-color has-background" style="border-width:1px;border-top-left-radius:5px;border-top-right-radius:5px;border-bottom-left-radius:5px;border-bottom-right-radius:5px;min-height:100%;padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--small);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--small)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|tiny"},"dimensions":{"minHeight":"100%"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="min-height:100%"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-200"}}},"typography":{"fontStyle":"normal","fontWeight":"500","textTransform":"uppercase","letterSpacing":"0.04em"}},"textColor":"secondary-200","fontSize":"x-small"} -->
<p class="has-secondary-200-color has-text-color has-link-color has-x-small-font-size" style="font-style:normal;font-weight:500;letter-spacing:0.04em;text-transform:uppercase"><?php esc_html_e( 'Residential / Outpatient', 'acme' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Dual Diagnosis Treatment', 'acme' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'When substance use disorders coexist with conditions like depression, anxiety, PTSD, or bipolar disorder, treating one without addressing the other sets the stage for relapse. Our dual diagnosis program delivers fully integrated psychiatric and addiction care under a single coordinated treatment team.', 'acme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|tiny","padding":{"top":"var:preset|spacing|tiny"},"margin":{"top":"var:preset|spacing|x-small"}},"layout":{"selfStretch":"fit","flexSize":null},"border":{"top":{"color":"var:preset|color|neutral-400","width":"1px"}},"dimensions":{"minHeight":""},"elements":{"link":{"color":{"text":"var:preset|color|neutral-200"}}}},"textColor":"neutral-200","fontSize":"small","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"bottom","justifyContent":"left"}} -->
<div class="wp-block-group has-neutral-200-color has-text-color has-link-color has-small-font-size" style="border-top-color:var(--wp--preset--color--neutral-400);border-top-width:1px;margin-top:var(--wp--preset--spacing--x-small);padding-top:var(--wp--preset--spacing--tiny)"><!-- wp:paragraph -->
<p><?php esc_html_e( 'Duration:', 'acme' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e( '30-90 days', 'acme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":{"topLeft":"5px","topRight":"5px","bottomLeft":"5px","bottomRight":"5px"},"width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|small","right":"var:preset|spacing|small"},"blockGap":"var:preset|spacing|tiny"},"dimensions":{"minHeight":"100%"}},"backgroundColor":"white","borderColor":"neutral-400","layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch","verticalAlignment":"space-between"}} -->
<div class="wp-block-group has-border-color has-neutral-400-border-color has-white-background-color has-background" style="border-width:1px;border-top-left-radius:5px;border-top-right-radius:5px;border-bottom-left-radius:5px;border-bottom-right-radius:5px;min-height:100%;padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--small);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--small)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|tiny"},"dimensions":{"minHeight":"100%"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="min-height:100%"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-200"}}},"typography":{"fontStyle":"normal","fontWeight":"500","textTransform":"uppercase","letterSpacing":"0.04em"}},"textColor":"secondary-200","fontSize":"x-small"} -->
<p class="has-secondary-200-color has-text-color has-link-color has-x-small-font-size" style="font-style:normal;font-weight:500;letter-spacing:0.04em;text-transform:uppercase"><?php esc_html_e( 'Family Support', 'acme' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Family Recovery Program', 'acme' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Addiction reshapes every relationship in its orbit. The Family Recovery Program at Serenity Path gives spouses, parents, siblings, and adult children the clinical guidance and practical tools to rebuild trust, establish boundaries, and support lasting recovery without sacrificing their own wellbeing.', 'acme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|tiny","padding":{"top":"var:preset|spacing|tiny"},"margin":{"top":"var:preset|spacing|x-small"}},"border":{"top":{"color":"var:preset|color|neutral-400","width":"1px"}},"layout":{"selfStretch":"fit","flexSize":null},"dimensions":{"minHeight":""},"elements":{"link":{"color":{"text":"var:preset|color|neutral-200"}}}},"textColor":"neutral-200","fontSize":"small","layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"bottom"}} -->
<div class="wp-block-group has-neutral-200-color has-text-color has-link-color has-small-font-size" style="border-top-color:var(--wp--preset--color--neutral-400);border-top-width:1px;margin-top:var(--wp--preset--spacing--x-small);padding-top:var(--wp--preset--spacing--tiny)"><!-- wp:paragraph -->
<p><?php esc_html_e( 'Duration:', 'acme' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e( '4–8 weeks', 'acme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":{"topLeft":"5px","topRight":"5px","bottomLeft":"5px","bottomRight":"5px"},"width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|small","right":"var:preset|spacing|small"},"blockGap":"var:preset|spacing|tiny"},"dimensions":{"minHeight":"100%"}},"backgroundColor":"white","borderColor":"neutral-400","layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch","verticalAlignment":"space-between"}} -->
<div class="wp-block-group has-border-color has-neutral-400-border-color has-white-background-color has-background" style="border-width:1px;border-top-left-radius:5px;border-top-right-radius:5px;border-bottom-left-radius:5px;border-bottom-right-radius:5px;min-height:100%;padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--small);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--small)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|tiny"},"dimensions":{"minHeight":"100%"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="min-height:100%"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-200"}}},"typography":{"fontStyle":"normal","fontWeight":"500","textTransform":"uppercase","letterSpacing":"0.04em"}},"textColor":"secondary-200","fontSize":"x-small"} -->
<p class="has-secondary-200-color has-text-color has-link-color has-x-small-font-size" style="font-style:normal;font-weight:500;letter-spacing:0.04em;text-transform:uppercase"><?php esc_html_e( 'Outpatient', 'acme' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Intensive Outpatient Program (IOP)', 'acme' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'The Intensive Outpatient Program at Serenity Path bridges the gap between residential treatment and independent recovery, providing clinically rigorous programming while allowing clients to live at home, maintain employment, and begin practicing new coping skills in real-world settings.', 'acme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|tiny","padding":{"top":"var:preset|spacing|tiny","bottom":"0"},"margin":{"top":"var:preset|spacing|x-small"}},"layout":{"selfStretch":"fit","flexSize":null},"border":{"top":{"color":"var:preset|color|neutral-400","width":"1px"}},"dimensions":{"minHeight":""},"elements":{"link":{"color":{"text":"var:preset|color|neutral-200"}}}},"textColor":"neutral-200","fontSize":"small","layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"bottom","justifyContent":"left"}} -->
<div class="wp-block-group has-neutral-200-color has-text-color has-link-color has-small-font-size" style="border-top-color:var(--wp--preset--color--neutral-400);border-top-width:1px;margin-top:var(--wp--preset--spacing--x-small);padding-top:var(--wp--preset--spacing--tiny);padding-bottom:0"><!-- wp:paragraph -->
<p><?php esc_html_e( 'Duration:', 'acme' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e( '8–12 weeks', 'acme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button">
View Programs <img data-slug="arrow-right-children" data-icon="arrow-right" src="<?php echo esc_url( get_site_url() ); ?>/wp-content/themes/acme/assets/images/arrow-right.svg" alt="" style="--icon-url: url(<?php echo esc_url( get_site_url() ); ?>/wp-content/plugins/acme/assets/svg/children/arrow-right.svg); max-width: 16px; max-height: 16px;" class="wp-icon-inline"></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|regular","bottom":"var:preset|spacing|x-large"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--regular);padding-bottom:var(--wp--preset--spacing--x-large)"><!-- wp:acme/testimonial-slider -->
<!-- wp:acme/testimonial-slide {"quote":"Outstanding service from start to finish. They listened carefully and delivered exactly what we needed.","name":"Jordan L.","photo":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero-avatars/avatar3.jpg","photoId":49} /-->

<!-- wp:acme/testimonial-slide {"quote":"The team went above and beyond to make sure everything was perfect. I couldn't be happier with the results.","name":"Alex M.","photo":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero-avatars/avatar4.jpg","photoId":50,"rating":3} /-->

<!-- wp:acme/testimonial-slide {"quote":"Professional, responsive, and genuinely invested in our success. Highly recommend to anyone looking for real results.","name":"Taylor R.","photo":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero-avatars/avatar2.jpg","photoId":48} /-->

<!-- wp:acme/testimonial-slide {"quote":"Ex officia fugiat qui ex qui eu duis minim id sint nulla.","name":"Randal W.","photo":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero-avatars/avatar1.jpg","photoId":47,"rating":4} /-->
<!-- /wp:acme/testimonial-slider --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large"},"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|neutral-500"}}}},"backgroundColor":"primary","textColor":"neutral-500","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-neutral-500-color has-primary-background-color has-text-color has-background has-link-color" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--x-large);padding-bottom:var(--wp--preset--spacing--x-large)"><!-- wp:query {"queryId":2,"query":{"perPage":3,"pages":0,"offset":0,"postType":"team-member","order":"asc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":null,"parents":[],"featuredOnly":true},"namespace":"acme/team-member-query","metadata":{"categories":["acme/team"],"patternName":"acme/team-members-feature-query","name":"Team Members Featured Query"},"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-query alignwide"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|regular"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"5rem"}} -->
<!-- wp:acme/team-member-card {"style":{"border":{"radius":{"topLeft":"5px","topRight":"5px","bottomLeft":"5px","bottomRight":"5px"},"width":"1px"},"elements":{"link":{"color":{"text":"var:preset|color|neutral-0"}}},"spacing":{"padding":{"top":"var:preset|spacing|regular","bottom":"var:preset|spacing|regular","left":"var:preset|spacing|regular","right":"var:preset|spacing|regular"},"blockGap":"var:preset|spacing|x-small"}},"backgroundColor":"white","textColor":"neutral-0","borderColor":"primary-100"} /-->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"neutral-500","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-neutral-500-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--x-large);padding-bottom:var(--wp--preset--spacing--x-large)"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large","right":"var:preset|spacing|large"}},"border":{"radius":{"topLeft":"10px","topRight":"10px","bottomLeft":"10px","bottomRight":"10px"},"width":"1px"}},"backgroundColor":"white","borderColor":"neutral-400","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-neutral-400-border-color has-white-background-color has-background" style="border-width:1px;border-top-left-radius:10px;border-top-right-radius:10px;border-bottom-left-radius:10px;border-bottom-right-radius:10px;padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large)"><!-- wp:heading {"level":3,"style":{"elements":{"link":{"color":{"text":"var:preset|color|primary"}}}},"textColor":"primary","fontSize":"x-large"} -->
<h3 class="wp-block-heading has-primary-color has-text-color has-link-color has-x-large-font-size"><?php esc_html_e( 'Frequently Asked Questions', 'acme' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'We know you have questions — here are answers to the ones we hear most often from individuals and families considering treatment.', 'acme' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:accordion {"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}}} -->
<div role="group" class="wp-block-accordion" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:accordion-item {"openByDefault":true} -->
<div class="wp-block-accordion-item is-open"><!-- wp:accordion-heading -->
<h3 class="wp-block-accordion-heading"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title">What happens when I first call the admissions line?</span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph -->
<p><?php esc_html_e( 'When you call, you will speak with a trained admissions counselor who will ask a few questions about your situation — substance use history, any co-occurring mental health concerns, and your insurance information. This conversation is completely confidential and typically takes 15 to 20 minutes. There is no obligation, and we will answer every question you have about the process, timeline, and what to expect.', 'acme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading -->
<h3 class="wp-block-accordion-heading"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title">How quickly can I be admitted?</span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph -->
<p><?php esc_html_e( 'In many cases, we can arrange admission within 24 to 48 hours of your initial call. For individuals in crisis or requiring medical detoxification, we prioritize same-day intake whenever possible. Our admissions team coordinates insurance verification and pre-assessment concurrently to avoid delays.', 'acme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading -->
<h3 class="wp-block-accordion-heading"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title">What should I bring to treatment?</span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph -->
<p><?php esc_html_e( 'We recommend bringing comfortable clothing for a one- to two-week stay, personal hygiene items (no alcohol-based products), any prescription medications in their original containers, your insurance card and a photo ID, and a journal or notebook if you use one. We provide a full packing list upon confirmation of admission. Electronics policies vary by program level — your admissions counselor will explain what is permitted.', 'acme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item --></div>
<!-- /wp:accordion --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer","area":"footer"} /-->
