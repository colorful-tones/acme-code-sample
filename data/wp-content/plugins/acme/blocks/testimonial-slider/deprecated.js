import { createBlock } from '@wordpress/blocks';

export default [
	{
		attributes: {
			testimonials: {
				type: 'array',
				default: [],
			},
			autoPlay: {
				type: 'boolean',
				default: true,
			},
			interval: {
				type: 'number',
				default: 4,
			},
			accentColor: {
				type: 'string',
				default: 'primary',
			},
		},
		save() {
			return null;
		},
		migrate(attributes) {
			const { testimonials, ...rest } = attributes;
			const innerBlocks = (testimonials || []).map(t =>
				createBlock('acme/testimonial-slide', {
					quote: t.quote || '',
					name: t.name || '',
					photo: t.photo || '',
					photoId: t.photoId || 0,
					rating: t.rating || 5,
				})
			);
			return [rest, innerBlocks];
		},
	},
];
