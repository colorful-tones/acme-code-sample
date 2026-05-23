<?php
/**
 * Testimonial Slider — Server-side render.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block content (inner blocks rendered HTML).
 * @var WP_Block $block      Block instance.
 */

$inner_blocks = $block->inner_blocks;
$auto_play    = ! empty( $attributes['autoPlay'] );
$interval     = isset( $attributes['interval'] ) ? absint( $attributes['interval'] ) : 4;
$accent       = isset( $attributes['accentColor'] ) ? sanitize_html_class( $attributes['accentColor'] ) : 'primary';
$slider_id    = wp_unique_id( 'testimonial-slider-' );
$count        = count( $inner_blocks );

if ( 0 === $count ) {
	return;
}

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class'                => 'testimonial-slider accent-' . $accent,
		'id'                   => $slider_id,
		'role'                 => 'region',
		'aria-label'           => esc_attr__( 'Client Testimonials', 'acme' ),
		'aria-roledescription' => esc_attr__( 'carousel', 'acme' ),
		'data-autoplay'        => $auto_play ? 'true' : 'false',
		'data-interval'        => esc_attr( $interval ),
		'data-count'           => esc_attr( $count ),
	)
);
?>
<div <?php echo wp_kses_post( $wrapper_attributes ); ?>>
	<div class="testimonial-viewport">
		<div class="testimonial-track" id="<?php echo esc_attr( $slider_id ); ?>-track" aria-live="off">
			<?php
			$i = 0;
			foreach ( $inner_blocks as $inner_block ) :
				$t        = $inner_block->parsed_block['attrs'] ?? array();
				$rating   = isset( $t['rating'] ) ? max( 0, min( 5, absint( $t['rating'] ) ) ) : 5;
				$name     = isset( $t['name'] ) ? $t['name'] : '';
				$quote    = isset( $t['quote'] ) ? $t['quote'] : '';
				$photo    = isset( $t['photo'] ) ? $t['photo'] : '';
				$hidden   = 0 === $i ? 'false' : 'true';
				$slide_id = $slider_id . '-slide-' . $i;
				// translators: 1: current slide number, 2: total slides.
				$slide_label = sprintf( __( 'Slide %1$d of %2$d', 'acme' ), $i + 1, $count );
				// translators: %d: star rating number.
				$stars_label = sprintf( __( '%d out of 5 stars', 'acme' ), $rating );
				?>
			<div
				class="testimonial-slide"
				id="<?php echo esc_attr( $slide_id ); ?>"
				role="tabpanel"
				aria-roledescription="<?php esc_attr_e( 'slide', 'acme' ); ?>"
				aria-labelledby="<?php echo esc_attr( $slider_id . '-dot-' . $i ); ?>"
				aria-hidden="<?php echo esc_attr( $hidden ); ?>"
			>
				<div class="testimonial-quote"><?php echo esc_html( $quote ); ?></div>
				<div class="testimonial-attribution">
					<?php if ( $photo ) : ?>
						<img
							src="<?php echo esc_url( $photo ); ?>"
							alt="<?php echo esc_attr( $name ); ?>"
							class="testimonial-photo"
							loading="lazy"
							width="80"
							height="80"
						/>
					<?php endif; ?>
					<div>
						<?php if ( $name ) : ?>
							<div class="testimonial-name"><?php echo esc_html( $name ); ?></div>
						<?php endif; ?>
						<div class="testimonial-stars" role="img" aria-label="<?php echo esc_attr( $stars_label ); ?>">
							<?php for ( $star_index = 1; $star_index <= 5; $star_index++ ) : ?>
								<?php if ( $star_index <= $rating ) : ?>
									<svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" class="star-filled" stroke-width="1.5" stroke-linejoin="round" stroke-linecap="round"/></svg>
								<?php else : ?>
									<svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" class="star-empty" stroke-width="1.5" stroke-linejoin="round" stroke-linecap="round"/></svg>
								<?php endif; ?>
							<?php endfor; ?>
						</div>
					</div>
				</div>
			</div>
				<?php
				++$i;
			endforeach;
			?>
		</div>

		<button
			type="button"
			class="testimonial-nav-arrow testimonial-nav-prev"
			aria-label="<?php esc_attr_e( 'Previous testimonial', 'acme' ); ?>"
			aria-controls="<?php echo esc_attr( $slider_id ); ?>-track"
		>
			<svg viewBox="0 0 24 24" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
		</button>

		<button
			type="button"
			class="testimonial-nav-arrow testimonial-nav-next"
			aria-label="<?php esc_attr_e( 'Next testimonial', 'acme' ); ?>"
			aria-controls="<?php echo esc_attr( $slider_id ); ?>-track"
		>
			<svg viewBox="0 0 24 24" aria-hidden="true"><polyline points="9 6 15 12 9 18"/></svg>
		</button>
	</div>

	<div class="testimonial-dots" role="tablist" aria-label="<?php esc_attr_e( 'Testimonial navigation', 'acme' ); ?>">
		<?php for ( $d = 0; $d < $count; $d++ ) : ?>
			<?php
			// translators: %d: testimonial number.
			$dot_label = sprintf( __( 'Testimonial %d', 'acme' ), $d + 1 );
			?>
			<button
				type="button"
				id="<?php echo esc_attr( $slider_id . '-dot-' . $d ); ?>"
				class="testimonial-dot<?php echo 0 === $d ? ' is-active' : ''; ?>"
				role="tab"
				aria-selected="<?php echo 0 === $d ? 'true' : 'false'; ?>"
				aria-label="<?php echo esc_attr( $dot_label ); ?>"
				aria-controls="<?php echo esc_attr( $slider_id . '-slide-' . $d ); ?>"
				data-index="<?php echo esc_attr( $d ); ?>"
			></button>
		<?php endfor; ?>
	</div>
</div>
