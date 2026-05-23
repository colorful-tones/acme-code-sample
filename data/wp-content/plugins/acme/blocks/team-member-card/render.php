<?php
/**
 * Team Member Card block — server-side render.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Inner block HTML (unused).
 * @var WP_Block $block      Block instance with query-loop context.
 *
 * @package AcmePlugin
 */

declare(strict_types=1);

$card_post_id = (int) ( $block->context['postId'] ?? 0 );

if ( ! $card_post_id ) {
	return;
}

$name        = get_the_title( $card_post_id );
$job_title   = (string) get_post_meta( $card_post_id, 'job_title', true );
$credentials = (string) get_post_meta( $card_post_id, 'credentials', true );
$department  = (string) get_post_meta( $card_post_id, 'department', true );

$department_labels = [
	'leadership'     => 'Leadership',
	'clinical'       => 'Clinical',
	'medical'        => 'Medical',
	'administrative' => 'Administrative',
	'support_staff'  => 'Support Staff',
];
$department_label  = $department_labels[ $department ] ?? '';

$photo_id      = (int) get_post_meta( $card_post_id, 'photo', true );
$thumbnail_img = $photo_id
	? wp_get_attachment_image(
		$photo_id,
		'team-member-photo',
		false,
		[ 'class' => 'team-member-card__avatar' ]
	)
	: '';

// __experimentalSkipSerialization is set on border support, so serialize manually.
$border_attrs = $attributes['style']['border'] ?? [];

// Preset color can arrive as a slug in borderColor or as var:preset|color|slug inside
// style.border.color (newer Gutenberg). Resolve both to a real CSS custom property.
if ( ! empty( $attributes['borderColor'] ) ) {
	$border_attrs['color'] = 'var(--wp--preset--color--' . $attributes['borderColor'] . ')';
} elseif ( isset( $border_attrs['color'] ) && str_starts_with( (string) $border_attrs['color'], 'var:preset|color|' ) ) {
	$slug                  = substr( $border_attrs['color'], strlen( 'var:preset|color|' ) );
	$border_attrs['color'] = 'var(--wp--preset--color--' . $slug . ')';
}

// Default to solid so color/width selections are visible without a separate style pick.
if ( empty( $border_attrs['style'] ) && ( ! empty( $border_attrs['color'] ) || ! empty( $border_attrs['width'] ) ) ) {
	$border_attrs['style'] = 'solid';
}

$border_css    = ! empty( $border_attrs )
	? ( wp_style_engine_get_styles( [ 'border' => $border_attrs ] )['css'] ?? '' )
	: '';
$wrapper_attrs = $border_css ? [ 'style' => $border_css ] : [];
?>
<div <?php echo wp_kses_data( get_block_wrapper_attributes( $wrapper_attrs ) ); ?>>

	<?php if ( $thumbnail_img ) : ?>
		<?php echo wp_kses_post( $thumbnail_img ); ?>
	<?php endif; ?>

	<div class="team-member-card__body">

		<h4 class="team-member-card__name"><?php echo esc_html( $name ); ?></h4>

		<?php if ( $credentials ) : ?>
			<span class="team-member-card__credentials"><?php echo esc_html( $credentials ); ?></span>
		<?php endif; ?>

		<?php if ( $job_title ) : ?>
			<p class="team-member-card__job-title"><?php echo esc_html( $job_title ); ?></p>
		<?php endif; ?>

		<?php if ( $department_label ) : ?>
			<p class="team-member-card__department"><?php echo esc_html( $department_label ); ?></p>
		<?php endif; ?>

	</div>
</div>
