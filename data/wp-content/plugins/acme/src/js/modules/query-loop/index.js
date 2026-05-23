/**
 * Extends the core Query Loop block with team-member post type support,
 * including a "Featured team members only" inspector toggle that maps to
 * the featured_team_member ACF true/false field on the server side.
 */
import { addFilter } from '@wordpress/hooks';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, ToggleControl } from '@wordpress/components';
import { Fragment, createElement } from '@wordpress/element';
import { registerBlockVariation } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';

registerBlockVariation('core/query', {
	name: 'acme/team-member-query',
	title: __('Team Members Query', 'acme-plugin'),
	description: __('Display team members with an optional featured filter.', 'acme-plugin'),
	icon: 'businessperson',
	keywords: [__('team', 'acme-plugin'), __('staff', 'acme-plugin')],
	attributes: {
		query: {
			postType: 'team-member',
			perPage: 12,
			featuredOnly: false,
		},
	},
	isActive: (blockAttributes, variationAttributes) =>
		blockAttributes.query?.postType === variationAttributes.query?.postType,
	scope: ['inserter'],
});

addFilter('editor.BlockEdit', 'acme/query-loop-team-member-controls', BlockEdit => props => {
	if (props.name !== 'core/query') {
		return createElement(BlockEdit, props);
	}

	const { attributes, setAttributes } = props;
	const { query } = attributes;

	if (query?.postType !== 'team-member') {
		return createElement(BlockEdit, props);
	}

	const handleFeaturedToggle = value => {
		setAttributes({ query: { ...query, featuredOnly: value } });
	};

	return createElement(
		Fragment,
		null,
		createElement(BlockEdit, props),
		createElement(
			InspectorControls,
			null,
			createElement(
				PanelBody,
				{ title: __('Team Member Filters', 'acme-plugin') },
				createElement(ToggleControl, {
					__nextHasNoMarginBottom: true,
					label: __('Featured team members only', 'acme-plugin'),
					help: __(
						'When enabled, only team members with the "Featured Team Member" field checked will be displayed.',
						'acme-plugin'
					),
					checked: !!query.featuredOnly,
					onChange: handleFeaturedToggle,
				})
			)
		)
	);
});
