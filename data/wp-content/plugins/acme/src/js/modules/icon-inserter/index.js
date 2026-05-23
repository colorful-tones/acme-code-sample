import { registerFormatType } from '@wordpress/rich-text';
import { __ } from '@wordpress/i18n';

import Edit from './edit';

const name = 'custom/icon';
const title = __('Insert icon', 'acme-plugin');

/**
 * Icon inline object definition
 */
export const icon = {
	name,
	title,
	keywords: [__('icon', 'acme-plugin'), __('symbol', 'acme-plugin')],
	object: true,
	tagName: 'img',
	className: 'wp-icon-inline',
	attributes: {
		className: 'class',
		iconSlug: 'data-slug',
		iconName: 'data-icon',
		url: 'src',
		alt: 'alt',
		style: 'style',
	},
	edit: Edit,
};

registerFormatType(icon.name, icon);
