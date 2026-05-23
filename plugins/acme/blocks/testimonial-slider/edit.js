import { __, sprintf } from '@wordpress/i18n';
import { useBlockProps, InnerBlocks, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, ToggleControl, RangeControl, SelectControl } from '@wordpress/components';
import { useState } from '@wordpress/element';
import { useSelect } from '@wordpress/data';

const ALLOWED_BLOCKS = ['acme/testimonial-slide'];

const TEMPLATE = [
	[
		'acme/testimonial-slide',
		{
			quote: "The team went above and beyond to make sure everything was perfect. I couldn't be happier with the results.",
			name: 'Alex M.',
			rating: 5,
		},
	],
	[
		'acme/testimonial-slide',
		{
			quote: 'Outstanding service from start to finish. They listened carefully and delivered exactly what we needed.',
			name: 'Jordan L.',
			rating: 5,
		},
	],
	[
		'acme/testimonial-slide',
		{
			quote: 'Professional, responsive, and genuinely invested in our success. Highly recommend to anyone looking for real results.',
			name: 'Taylor R.',
			rating: 4,
		},
	],
];

const StarIcon = ({ filled }) => (
	<svg
		width="18"
		height="18"
		viewBox="0 0 24 24"
		xmlns="http://www.w3.org/2000/svg"
		aria-hidden="true"
	>
		<path
			d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"
			fill={filled ? 'currentColor' : 'none'}
			stroke="currentColor"
			strokeWidth="1.5"
			strokeLinejoin="round"
			strokeLinecap="round"
		/>
	</svg>
);

export default function Edit({ attributes, setAttributes, clientId }) {
	const { autoPlay, interval, accentColor } = attributes;
	const [activeSlide, setActiveSlide] = useState(0);

	const slides = useSelect(
		select => {
			const block = select('core/block-editor').getBlock(clientId);
			return block?.innerBlocks ?? [];
		},
		[clientId]
	);

	const clampedActive = Math.min(activeSlide, Math.max(0, slides.length - 1));
	const activeAttrs = slides[clampedActive]?.attributes ?? {};

	const blockProps = useBlockProps({ className: `accent-${accentColor}` });

	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Slider Settings', 'acme')} initialOpen={true}>
					<ToggleControl
						label={__('Auto-cycle', 'acme')}
						checked={autoPlay}
						onChange={val => setAttributes({ autoPlay: val })}
					/>
					{autoPlay && (
						<RangeControl
							label={__('Interval (seconds)', 'acme')}
							value={interval}
							onChange={val => setAttributes({ interval: val })}
							min={2}
							max={8}
							step={1}
						/>
					)}
					<SelectControl
						label={__('Accent Color', 'acme')}
						value={accentColor}
						options={[
							{ label: __('Primary', 'acme'), value: 'primary' },
							{
								label: __('Secondary', 'acme'),
								value: 'secondary',
							},
						]}
						onChange={val => setAttributes({ accentColor: val })}
					/>
				</PanelBody>
			</InspectorControls>
			<div {...blockProps}>
				{slides.length > 0 && (
					<div className="testimonial-editor-preview">
						<div className="testimonial-slide">
							<div className="testimonial-quote">{activeAttrs.quote}</div>
							<div className="testimonial-attribution">
								{activeAttrs.photo && (
									<img
										src={activeAttrs.photo}
										alt={activeAttrs.name}
										className="testimonial-photo"
									/>
								)}
								<div>
									<div className="testimonial-name">{activeAttrs.name}</div>
									<div
										className="testimonial-stars"
										role="img"
										aria-label={sprintf(
											/* translators: %d: star rating number */
											__('%d out of 5 stars', 'acme'),
											activeAttrs.rating ?? 5
										)}
									>
										{[1, 2, 3, 4, 5].map(star => (
											<span key={star} aria-hidden="true">
												<StarIcon
													filled={star <= (activeAttrs.rating ?? 5)}
												/>
											</span>
										))}
									</div>
								</div>
							</div>
							{slides.length > 1 && (
								<div className="testimonial-dots">
									{slides.map((_, i) => (
										<button
											key={i}
											type="button"
											className={`testimonial-dot${i === clampedActive ? ' is-active' : ''}`}
											onClick={() => setActiveSlide(i)}
											aria-label={sprintf(__('Slide %d', 'acme'), i + 1)}
										/>
									))}
								</div>
							)}
						</div>
					</div>
				)}
				<InnerBlocks
					allowedBlocks={ALLOWED_BLOCKS}
					template={TEMPLATE}
					templateLock={false}
					orientation="vertical"
				/>
			</div>
		</>
	);
}
