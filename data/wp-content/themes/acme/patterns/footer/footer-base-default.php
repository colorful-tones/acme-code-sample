<?php
/**
 * Title: Footer - Base
 * Slug: acme/footer-base-default
 * Categories: acme/footer
 * Block Types: core/template-part/footer
 */

?>
<!-- wp:group {"tagName":"footer","style":{"elements":{"link":{"color":{"text":"var:preset|color|white"},":hover":{"color":{"text":"var:preset|color|tertiary"}}}}},"backgroundColor":"primary-dark","textColor":"white","layout":{"inherit":true,"type":"constrained"}} -->
<footer class="wp-block-group has-white-color has-primary-dark-background-color has-text-color has-background has-link-color"><!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"0","right":"0"},"blockGap":"0"}}} -->
	<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--60);padding-right:0;padding-bottom:var(--wp--preset--spacing--60);padding-left:0"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"flex","orientation":"vertical","flexWrap":"nowrap","justifyContent":"stretch"}} -->
		<div class="wp-block-group alignwide"><!-- wp:site-logo {"width":300,"className":"is-style-white-knockout","style":{"spacing":{"margin":{"top":"0","bottom":"0","left":"0","right":"0"},"padding":{"top":"0","bottom":"0"}}}} /-->

			<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"0","bottom":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->
			<div class="wp-block-group alignwide" style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|70","left":"var:preset|spacing|50"}}}} -->
				<div class="wp-block-columns alignwide"><!-- wp:column {"width":""} -->
					<div class="wp-block-column"><!-- wp:heading {"style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}},"typography":{"fontStyle":"normal","fontWeight":"700"}},"textColor":"white","fontSize":"large"} -->
						<h2 class="wp-block-heading has-white-color has-text-color has-link-color has-large-font-size" style="font-style:normal;font-weight:700"><?php esc_html_e( 'Acme Locations', 'acme' ); ?></h2>
						<!-- /wp:heading -->

						<!-- wp:navigation {"textColor":"white","overlayMenu":"never","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} /-->
					</div>
					<!-- /wp:column -->

					<!-- wp:column -->
					<div class="wp-block-column"><!-- wp:heading {"style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}},"typography":{"fontStyle":"normal","fontWeight":"700"}},"textColor":"white","fontSize":"large"} -->
						<h2 class="wp-block-heading has-white-color has-text-color has-link-color has-large-font-size" style="font-style:normal;font-weight:700"><?php esc_html_e( 'Learn More', 'acme' ); ?></h2>
						<!-- /wp:heading -->

						<!-- wp:navigation {"overlayMenu":"never","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} /-->
					</div>
					<!-- /wp:column -->

					<!-- wp:column {"width":""} -->
					<div class="wp-block-column"><!-- wp:heading {"style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}},"typography":{"fontStyle":"normal","fontWeight":"700"}},"textColor":"white","fontSize":"large"} -->
						<h2 class="wp-block-heading has-white-color has-text-color has-link-color has-large-font-size" style="font-style:normal;font-weight:700"><?php esc_html_e( 'Follow us on Social Media', 'acme' ); ?></h2>
						<!-- /wp:heading -->

						<!-- wp:social-links {"className":"is-style-square","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|30"}}}} -->
						<ul class="wp-block-social-links is-style-square"><!-- wp:social-link {"url":"#","service":"facebook"} /-->

							<!-- wp:social-link {"url":"#","service":"instagram"} /-->

							<!-- wp:social-link {"url":"#","service":"youtube"} /-->
						</ul>
						<!-- /wp:social-links -->

						<!-- wp:image {"width":"151px","height":"auto","sizeSlug":"large","linkDestination":"none"} -->
						<figure class="wp-block-image size-large is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/sunrise-20-years-badge.png" alt="" style="width:151px;height:auto" /></figure>
						<!-- /wp:image -->
					</div>
					<!-- /wp:column -->

					<!-- wp:column {"width":""} -->
					<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
						<div class="wp-block-group"><!-- wp:paragraph {"align":"left","style":{"typography":{"textTransform":"uppercase"}}} -->
							<p class="has-text-align-left" style="text-transform:uppercase"><?php esc_html_e( 'For Admission 24/7 Call', 'acme' ); ?></p>
							<!-- /wp:paragraph -->

							<!-- wp:buttons {"style":{"spacing":{"blockGap":{"top":"0"},"padding":{"top":"0","bottom":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"left"}} -->
							<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0"><!-- wp:button -->
								<div class="wp-block-button">
									<a class="wp-block-button__link wp-element-button">
										<img data-slug="arrow-right-children" data-icon="arrow-right" src="<?php echo esc_url( WPMU_PLUGIN_URL . '/acme/assets/svg/children/phone.svg' ); ?>" alt="" style="--icon-url: url('<?php echo esc_url( WPMU_PLUGIN_URL . '/acme/assets/svg/children/phone.svg' ); ?>'); max-width: 16px; max-height: 16px;" class="wp-icon-inline">
										800-123-4567
									</a>
								</div>
								<!-- /wp:button -->
							</div>
							<!-- /wp:buttons -->
						</div>
						<!-- /wp:group -->

						<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30","padding":{"top":"var:preset|spacing|30"}}},"layout":{"type":"grid","columnCount":null,"minimumColumnWidth":"5rem"}} -->
						<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--30)"><!-- wp:image {"sizeSlug":"medium","linkDestination":"none"} -->
							<figure class="wp-block-image size-medium"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/vvl-award.png" alt="" /></figure>
							<!-- /wp:image -->

							<!-- wp:image {"sizeSlug":"medium","linkDestination":"none"} -->
							<figure class="wp-block-image size-medium"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/asam-3.5-award.png" alt="" /></figure>
							<!-- /wp:image -->

							<!-- wp:image {"sizeSlug":"medium","linkDestination":"none"} -->
							<figure class="wp-block-image size-medium"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/asam-3.7-award.png" alt="" /></figure>
							<!-- /wp:image -->

							<!-- wp:image {"sizeSlug":"medium","linkDestination":"none"} -->
							<figure class="wp-block-image size-medium"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/carf.png" alt="" /></figure>
							<!-- /wp:image -->

							<!-- wp:image {"sizeSlug":"medium","linkDestination":"none"} -->
							<figure class="wp-block-image size-medium"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/joint-commission.png" alt="" /></figure>
							<!-- /wp:image -->

							<!-- wp:image {"sizeSlug":"medium","linkDestination":"none"} -->
							<figure class="wp-block-image size-medium"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/legit-script-award.png" alt="" /></figure>
							<!-- /wp:image -->
						</div>
						<!-- /wp:group -->
					</div>
					<!-- /wp:column -->
				</div>
				<!-- /wp:columns -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"align":"wide","style":{"elements":{"link":{"color":{"text":"var:preset|color|white"},":hover":{"color":{"text":"var:preset|color|tertiary"}}}},"spacing":{"margin":{"top":"var:preset|spacing|70","bottom":"0"},"blockGap":"0","padding":{"bottom":"var:preset|spacing|50","top":"var:preset|spacing|40"}}},"textColor":"white","layout":{"type":"default"}} -->
		<div class="wp-block-group alignwide has-white-color has-text-color has-link-color" style="margin-top:var(--wp--preset--spacing--70);margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"center","level":3,"align":"wide","style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}},"typography":{"fontStyle":"normal","fontWeight":"400"}},"textColor":"white","fontSize":"medium"} -->
			<h3 class="wp-block-heading alignwide has-text-align-center has-white-color has-text-color has-link-color has-medium-font-size" style="font-style:normal;font-weight:400"><?php esc_html_e( 'Medical Disclaimer', 'acme' ); ?></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
			<p style="margin-top:var(--wp--preset--spacing--40)">
				The content of this website is not intended to be a substitute for professional medical advice, diagnosis, or treatment. Website text, graphics, videos, images, and other content are for informational purposes only. Never use the contents of this website as a substitute for the advice of a doctor. Always consult a physician if you have questions or concerns about health matters, including any drugs, supplements, maladies, or remedies mentioned. Descriptions and reports on products or services mentioned on this website should not be considered endorsements nor recommendations. If you have a medical emergency, call 9-1-1 or a doctor immediately. If you have concerns about suicide, please call the National Hotline at <a href="tel:8001234567" data-type="tel" data-id="tel:8001234567">1-800-123-4567</a>. </p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|80"},"blockGap":"var:preset|spacing|40"}},"fontSize":"small","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
		<div class="wp-block-group alignwide has-small-font-size" style="margin-top:var(--wp--preset--spacing--80)"><!-- wp:acme/copyright {"copyrightHolder":"Acme"} -->
			<p class="wp-block-acme-copyright" data-start-year="" data-copyright-holder="Acme">© <span class="copyright-year"></span> Acme</p>
			<!-- /wp:acme/copyright -->

			<!-- wp:navigation {"textColor":"white","overlayMenu":"never","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"fontSize":"small","layout":{"type":"flex","justifyContent":"center"}} /-->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</footer>
<!-- /wp:group -->
