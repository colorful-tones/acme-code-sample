import PropTypes from 'prop-types';
import { __ } from '@wordpress/i18n';
import { useSelect } from '@wordpress/data';
import { useState, useEffect } from '@wordpress/element';
import { insertObject } from '@wordpress/rich-text';
import { RichTextToolbarButton } from '@wordpress/block-editor';
import { symbol } from '@wordpress/icons';
import apiFetch from '@wordpress/api-fetch';

import IconModal from './icon-modal';

const name = 'custom/icon';
const title = __('Insert icon', 'acme-plugin');

const DEFAULT_STYLE = 'max-width: 16px; max-height: 16px;';

export default function Edit({ value, onChange, onFocus, isObjectActive, activeObjectAttributes }) {
	const [isModalOpen, setIsModalOpen] = useState(false);
	const [isEditing, setIsEditing] = useState(false);
	const [iconGroups, setIconGroups] = useState({});
	const [isLoading, setIsLoading] = useState(false);

	const selectedBlock = useSelect(select => {
		return select('core/block-editor').getSelectedBlock();
	});

	const isInButton =
		selectedBlock?.name === 'core/button' ||
		selectedBlock?.name === 'core/buttons' ||
		selectedBlock?.attributes?.tagName === 'button';

	// Load icons when modal opens.
	useEffect(() => {
		if (isModalOpen && Object.keys(iconGroups).length === 0) {
			setIsLoading(true);
			apiFetch({ path: '/acme-plugin/v1/svg-images' })
				.then(response => {
					setIconGroups(response);
					setIsLoading(false);
				})
				.catch(error => {
					// eslint-disable-next-line no-console
					console.error('Failed to load icons:', error);
					setIsLoading(false);
				});
		}
	}, [isModalOpen, iconGroups]);

	// Bail early if not inside a button.
	if (!isInButton) {
		return null;
	}

	/**
	 * Extract the current icon data from active attributes.
	 */
	const getCurrentIconData = () => {
		if (!activeObjectAttributes) {
			return null;
		}

		// Extract icon URL from style.
		const iconUrlMatch = activeObjectAttributes.style?.match(/--icon-url:\s*url\(([^)]+)\)/);
		const iconUrl = iconUrlMatch ? iconUrlMatch[1] : activeObjectAttributes.url;

		// Extract dimensions from style.
		const maxWidthMatch = activeObjectAttributes.style?.match(/max-width:\s*([^;]+)/);
		const maxHeightMatch = activeObjectAttributes.style?.match(/max-height:\s*([^;]+)/);

		return {
			slug: activeObjectAttributes.iconSlug || activeObjectAttributes['data-slug'],
			name: activeObjectAttributes.iconName || activeObjectAttributes['data-icon'],
			url: iconUrl,
			maxWidth: maxWidthMatch ? maxWidthMatch[1] : '16px',
			maxHeight: maxHeightMatch ? maxHeightMatch[1] : '16px',
			alt: activeObjectAttributes.alt || '',
		};
	};

	const currentIconData = getCurrentIconData();

	/**
	 * Handles icon selection from the modal.
	 *
	 * @param {Object} iconData      - Selected icon data
	 * @param {string} iconData.name - Icon name
	 * @param {string} iconData.slug - Icon slug
	 * @param {string} iconData.url  - Icon URL
	 */
	const handleIconSelect = iconData => {
		const isReplacing = isObjectActive && currentIconData;

		// Get existing dimensions or use defaults.
		const existingMaxWidth = currentIconData?.maxWidth || '16px';
		const existingMaxHeight = currentIconData?.maxHeight || '16px';
		const existingAlt = currentIconData?.alt || '';

		if (isReplacing) {
			// Replace existing icon.
			const newReplacements = value.replacements.slice();
			newReplacements[value.start] = {
				type: name,
				attributes: {
					...activeObjectAttributes,
					iconSlug: iconData.slug,
					'data-slug': iconData.slug,
					iconName: iconData.name,
					'data-icon': iconData.name,
					url: iconData.url,
					alt: existingAlt,
					style: `--icon-url: url(${iconData.url}); max-width: ${existingMaxWidth}; max-height: ${existingMaxHeight};`,
				},
			};

			onChange({
				...value,
				replacements: newReplacements,
			});
		} else {
			// Insert new icon.
			onChange(
				insertObject(value, {
					type: name,
					attributes: {
						iconSlug: iconData.slug,
						'data-slug': iconData.slug,
						iconName: iconData.name,
						'data-icon': iconData.name,
						url: iconData.url,
						alt: '',
						style: `--icon-url: url(${iconData.url}); ${DEFAULT_STYLE}`,
					},
				})
			);
		}

		onFocus();
		setIsModalOpen(false);
		setIsEditing(false);
	};

	/**
	 * Handles saving icon edit changes.
	 *
	 * @param {Object} editData           - Edit data from the modal
	 * @param {string} editData.alt       - Alternative text
	 * @param {string} editData.maxWidth  - Maximum width
	 * @param {string} editData.maxHeight - Maximum height
	 */
	const handleSaveEdit = editData => {
		if (!currentIconData) {
			return;
		}

		const newReplacements = value.replacements.slice();
		newReplacements[value.start] = {
			type: name,
			attributes: {
				...activeObjectAttributes,
				alt: editData.alt || '',
				style: `--icon-url: url(${currentIconData.url}); max-width: ${editData.maxWidth}; max-height: ${editData.maxHeight};`,
			},
		};

		onChange({
			...value,
			replacements: newReplacements,
		});

		setIsModalOpen(false);
		setIsEditing(false);
		onFocus();
	};

	/**
	 * Handles clicking on an existing icon to edit it.
	 */
	const handleExistingIconClick = () => {
		setIsEditing(true);
		setIsModalOpen(true);
	};

	return (
		<>
			<RichTextToolbarButton
				icon={symbol}
				title={isObjectActive ? __('Edit icon', 'acme-plugin') : title}
				onClick={() => {
					if (isObjectActive) {
						handleExistingIconClick();
					} else {
						setIsModalOpen(true);
					}
				}}
				isActive={isObjectActive}
				isPressed={isObjectActive}
			/>

			<IconModal
				isOpen={isModalOpen}
				onClose={() => {
					setIsModalOpen(false);
					setIsEditing(false);
				}}
				onSelectIcon={handleIconSelect}
				currentIcon={currentIconData?.name}
				currentIconSlug={currentIconData?.slug}
				currentIconUrl={currentIconData?.url}
				isEditing={isEditing}
				setIsEditing={setIsEditing}
				editAttributes={{
					...activeObjectAttributes,
					...currentIconData,
				}}
				onSaveEdit={handleSaveEdit}
				iconGroups={iconGroups}
				isLoading={isLoading}
			/>
		</>
	);
}

Edit.propTypes = {
	value: PropTypes.object.isRequired,
	onChange: PropTypes.func.isRequired,
	onFocus: PropTypes.func.isRequired,
	isObjectActive: PropTypes.bool.isRequired,
	activeObjectAttributes: PropTypes.object,
};
