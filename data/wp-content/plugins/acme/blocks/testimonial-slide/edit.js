import { __ } from '@wordpress/i18n';
import { useBlockProps, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { Button, TextareaControl, TextControl } from '@wordpress/components';
import { useCallback } from '@wordpress/element';

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

const StarRating = ({ rating, onChange }) => (
	<div className="testimonial-stars-editor" role="group" aria-label={__('Rating', 'acme')}>
		{[1, 2, 3, 4, 5].map(star => (
			<button
				key={star}
				type="button"
				className="testimonial-star-btn"
				onClick={() => onChange(star)}
				aria-label={`${star} star${star !== 1 ? 's' : ''}`}
			>
				<StarIcon filled={star <= rating} />
			</button>
		))}
	</div>
);

export default function Edit({ attributes, setAttributes }) {
	const { quote, name, photo, photoId, rating } = attributes;

	const blockProps = useBlockProps({ className: 'testimonial-editor-card' });

	const handleMediaSelect = useCallback(
		media => {
			if (media?.url) {
				setAttributes({ photo: media.url, photoId: media.id });
			}
		},
		[setAttributes]
	);

	return (
		<div {...blockProps}>
			<div className="testimonial-editor-card__body">
				<div className="testimonial-editor-card__photo-area">
					<MediaUploadCheck>
						<MediaUpload
							onSelect={handleMediaSelect}
							allowedTypes={['image']}
							value={photoId > 0 ? photoId : undefined}
							render={({ open }) => (
								<div className="testimonial-editor-photo-wrapper">
									{photo ? (
										<>
											<img
												src={photo}
												alt={name || __('Testimonial photo', 'acme')}
												className="testimonial-editor-photo"
											/>
											<Button
												variant="tertiary"
												size="small"
												onClick={open}
												className="testimonial-editor-photo-replace"
											>
												{__('Replace', 'acme')}
											</Button>
											<Button
												variant="tertiary"
												isDestructive
												size="small"
												onClick={() =>
													setAttributes({
														photo: '',
														photoId: 0,
													})
												}
												className="testimonial-editor-photo-remove"
											>
												{__('Remove', 'acme')}
											</Button>
										</>
									) : (
										<Button
											variant="secondary"
											size="small"
											onClick={open}
											className="testimonial-editor-photo-add"
										>
											{__('Add Photo', 'acme')}
										</Button>
									)}
								</div>
							)}
						/>
					</MediaUploadCheck>
				</div>
				<div className="testimonial-editor-card__fields">
					<TextareaControl
						label={__('Quote', 'acme')}
						value={quote}
						onChange={val => setAttributes({ quote: val })}
						rows={3}
						placeholder={__('Enter testimonial quote…', 'acme')}
					/>
					<TextControl
						label={__('First Name', 'acme')}
						value={name}
						onChange={val => setAttributes({ name: val })}
						placeholder={__('Alex M.', 'acme')}
					/>
					<div className="testimonial-editor-card__rating">
						<span className="testimonial-editor-card__rating-label">
							{__('Rating', 'acme')}
						</span>
						<StarRating
							rating={rating}
							onChange={val => setAttributes({ rating: val })}
						/>
					</div>
				</div>
			</div>
		</div>
	);
}
