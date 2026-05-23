import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import { registerBlockType } from '@wordpress/blocks';
import './style.scss';
import metadata from './block.json';

registerBlockType(metadata.name, {
	Edit() {
		const blockProps = useBlockProps({ className: 'is-placeholder' });

		return (
			<div {...blockProps}>
				<div className="team-member-card__avatar-placeholder" />
				<div className="team-member-card__body">
					<p className="team-member-card__name">
						{__('Team Member Name', 'acme-plugin')}
					</p>
					<p className="team-member-card__job-title">{__('Job Title', 'acme-plugin')}</p>
					<p className="team-member-card__department">
						{__('Department', 'acme-plugin')}
					</p>
				</div>
			</div>
		);
	},

	Save: () => null,
});
