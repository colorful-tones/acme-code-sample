/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { addFilter } from '@wordpress/hooks';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, ToggleControl, ComboboxControl, TextControl } from '@wordpress/components';
import { createHigherOrderComponent } from '@wordpress/compose';
import { useSelect } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';

/**
 * Add the attributes needed for modal-enabled buttons.
 *
 * @since 0.1.0
 * @param {Object} settings Block settings
 * @return {Object} Modified settings
 */
function addAttributes(settings) {
	if ('core/button' !== settings.name) {
		return settings;
	}

	// Add the modal attributes.
	const modalAttributes = {
		isModalEnabled: {
			type: 'boolean',
			default: false,
		},
		patternId: {
			type: 'number',
			default: 0,
		},
		hasCustomModalHeading: {
			type: 'boolean',
			default: false,
		},
		customModalHeading: {
			type: 'string',
			default: '',
		},
	};

	return {
		...settings,
		attributes: {
			...settings.attributes,
			...modalAttributes,
		},
	};
}

addFilter('blocks.registerBlockType', 'acme/button-modal-add-attributes', addAttributes);

/**
 * Add inspector controls to the button block for modal settings.
 *
 * @since 0.1.0
 */
const withInspectorControls = createHigherOrderComponent(BlockEdit => {
	return props => {
		if (props.name !== 'core/button') {
			return <BlockEdit {...props} />;
		}

		const { attributes, setAttributes } = props;
		const { isModalEnabled, patternId, hasCustomModalHeading, customModalHeading } = attributes;

		// Fetch synced patterns
		const { patterns, isLoading } = useSelect(select => {
			const { getEntityRecords } = select(coreStore);

			// Query for synced patterns (wp_block post type)
			const query = {
				per_page: -1,
				status: 'publish',
				orderby: 'title',
				order: 'asc',
			};

			const records = getEntityRecords('postType', 'wp_block', query);

			return {
				patterns: records || [],
				isLoading: !records,
			};
		}, []);

		// Format patterns for ComboboxControl
		// Note: WordPress core-data returns title as a plain string, not an object
		const patternOptions = patterns.map(pattern => {
			const title = pattern.title?.raw || pattern.title || __('(no title)', 'acme');
			return {
				value: String(pattern.id),
				label: title,
			};
		});

		return (
			<>
				<BlockEdit {...props} />
				<InspectorControls>
					<PanelBody title={__('Modal Settings', 'acme')} initialOpen={false}>
						<ToggleControl
							label={__('Enable Modal', 'acme')}
							help={
								isModalEnabled
									? __('Modal is enabled for this button.', 'acme')
									: __('Enable modal to show a pattern when clicked.', 'acme')
							}
							checked={isModalEnabled}
							onChange={value => {
								setAttributes({ isModalEnabled: value });
								// Clear pattern ID when disabling modal
								if (!value) {
									setAttributes({ patternId: 0 });
								}
							}}
						/>
						{isModalEnabled && (
							<>
								<ComboboxControl
									label={__('Synced Pattern', 'acme')}
									help={__(
										'Search and select a synced pattern to display in the modal.',
										'acme'
									)}
									value={patternId ? String(patternId) : ''}
									onChange={newValue => {
										// newValue is the pattern ID as a string
										const selectedId = newValue ? parseInt(newValue, 10) : 0;
										setAttributes({
											patternId: selectedId,
										});
									}}
									options={patternOptions}
									placeholder={
										isLoading
											? __('Loading patterns…', 'acme')
											: __('Search for a pattern…', 'acme')
									}
								/>
								<ToggleControl
									label={__('Custom Modal Heading', 'acme')}
									help={
										hasCustomModalHeading
											? __('Custom heading is enabled.', 'acme')
											: __(
													'Enable to use a custom heading instead of the pattern title.',
													'acme'
												)
									}
									checked={hasCustomModalHeading}
									onChange={value => {
										setAttributes({
											hasCustomModalHeading: value,
										});
										// Clear custom heading when disabling
										if (!value) {
											setAttributes({
												customModalHeading: '',
											});
										}
									}}
								/>
								{hasCustomModalHeading && (
									<TextControl
										label={__('Heading Text', 'acme')}
										help={__(
											'Enter the custom heading to display in the modal.',
											'acme'
										)}
										value={customModalHeading}
										onChange={value =>
											setAttributes({
												customModalHeading: value,
											})
										}
									/>
								)}
							</>
						)}
					</PanelBody>
				</InspectorControls>
			</>
		);
	};
}, 'withInspectorControls');

addFilter('editor.BlockEdit', 'acme/button-modal-add-inspector-controls', withInspectorControls);

/**
 * Add custom attributes to the block's save output.
 *
 * This ensures the attributes are saved to the block's markup.
 *
 * @since 0.1.0
 * @param {Object} extraProps Block extra props
 * @param {Object} blockType  Block type
 * @param {Object} attributes Block attributes
 * @return {Object} Modified extra props
 */
function addSaveProps(extraProps, blockType, attributes) {
	if ('core/button' !== blockType.name) {
		return extraProps;
	}

	const { isModalEnabled, patternId, hasCustomModalHeading, customModalHeading } = attributes;

	if (isModalEnabled) {
		extraProps['data-modal-enabled'] = 'true';
		if (patternId) {
			extraProps['data-pattern-id'] = patternId;
		}
		if (hasCustomModalHeading && customModalHeading) {
			extraProps['data-custom-modal-heading'] = customModalHeading;
		}
	}

	return extraProps;
}

addFilter('blocks.getSaveContent.extraProps', 'acme/button-modal-add-save-props', addSaveProps);
