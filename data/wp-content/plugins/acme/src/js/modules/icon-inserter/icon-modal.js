import PropTypes from 'prop-types';
import {
	Button,
	// eslint-disable-next-line @wordpress/no-unsafe-wp-apis
	__experimentalHStack as HStack,
	// eslint-disable-next-line @wordpress/no-unsafe-wp-apis
	__experimentalVStack as VStack,
	// eslint-disable-next-line @wordpress/no-unsafe-wp-apis
	__experimentalUnitControl as UnitControl,
	// eslint-disable-next-line @wordpress/no-unsafe-wp-apis
	__experimentalUseCustomUnits as useCustomUnits,
	TextControl,
	Modal,
	Spinner,
	TabPanel,
	SearchControl,
} from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { useState, useMemo } from '@wordpress/element';

export default function IconModal({
	isOpen,
	onClose,
	onSelectIcon,
	currentIcon,
	currentIconSlug,
	currentIconUrl,
	setIsEditing,
	isEditing,
	editAttributes,
	onSaveEdit,
	iconGroups,
	isLoading,
}) {
	// Initialize from editAttributes which now includes extracted values.
	const [editedWidth, setEditedWidth] = useState(editAttributes?.maxWidth || '16px');
	const [editedHeight, setEditedHeight] = useState(editAttributes?.maxHeight || '16px');
	const [editedAlt, setEditedAlt] = useState(editAttributes?.alt || '');
	const [searchTerm, setSearchTerm] = useState('');

	const units = useCustomUnits({
		availableUnits: ['px', 'em', 'rem', '%'],
		defaultValues: { px: 16 },
	});

	// Filter icons based on search term.
	const filteredIconGroups = useMemo(() => {
		if (!searchTerm) {
			return iconGroups;
		}

		const filtered = {};
		Object.keys(iconGroups).forEach(group => {
			const filteredIcons = iconGroups[group].filter(icon =>
				icon.name.toLowerCase().includes(searchTerm.toLowerCase())
			);
			if (filteredIcons.length > 0) {
				filtered[group] = filteredIcons;
			}
		});
		return filtered;
	}, [iconGroups, searchTerm]);

	// Never show unless we need it.
	if (!isOpen) {
		return null;
	}

	// Helper function at the top of your file
	const getSvgWithStyles = svgContent => {
		if (!svgContent) {
			return '';
		}
		return svgContent
			.replace(/style="[^"]*"/g, '') // Remove existing style attribute
			.replace(/<svg([^>]*)>/, '<svg$1 style="max-width: 100%; max-height: 100%;">');
	};

	let modalTitle = __('Select Icon', 'acme-plugin');
	if (isEditing) {
		modalTitle = __('Edit Icon', 'acme');
	} else if (currentIcon) {
		modalTitle = __('Replace Icon', 'acme-plugin');
	}

	// Edit form view.
	if (isEditing && currentIconUrl) {
		return (
			<Modal
				title={modalTitle}
				onRequestClose={onClose}
				className="icon-format-modal"
				size="medium"
			>
				<VStack spacing={4}>
					<div className="icon-preview" style={{ textAlign: 'center' }}>
						<div
							style={{
								background:
									'repeating-conic-gradient(#f0f0f0 0% 25%, #fff 0% 50%) 50% / 20px 20px',
								padding: '20px',
								borderRadius: '4px',
								marginBottom: '8px',
							}}
						>
							<img
								src={currentIconUrl}
								alt={editedAlt || currentIcon}
								style={{
									maxWidth: editedWidth,
									maxHeight: editedHeight,
									width: 'auto',
									height: 'auto',
									display: 'block',
									margin: '0 auto',
								}}
							/>
						</div>
						<p
							style={{
								margin: '8px 0 0',
								fontSize: '14px',
								fontWeight: '600',
							}}
						>
							{currentIcon}
						</p>
						{currentIconSlug && (
							<p
								style={{
									margin: '4px 0 0',
									fontSize: '12px',
									color: '#666',
								}}
							>
								{currentIconSlug}
							</p>
						)}
					</div>

					<UnitControl
						__next40pxDefaultSize
						label={__('Max Width', 'acme-plugin')}
						value={editedWidth}
						onChange={setEditedWidth}
						units={units}
						min={1}
						max={500}
					/>

					<UnitControl
						__next40pxDefaultSize
						label={__('Max Height', 'acme-plugin')}
						value={editedHeight}
						onChange={setEditedHeight}
						units={units}
						min={1}
						max={500}
					/>

					<TextControl
						label={__('Alternative text', 'acme-plugin')}
						value={editedAlt}
						onChange={setEditedAlt}
						help={__('Leave empty if decorative.', 'acme-plugin')}
					/>

					<HStack justify="space-between">
						<Button variant="secondary" onClick={() => setIsEditing(false)}>
							{__('Change Icon', 'acme-plugin')}
						</Button>
						<Button
							variant="primary"
							onClick={() =>
								onSaveEdit({
									maxWidth: editedWidth,
									maxHeight: editedHeight,
									alt: editedAlt,
								})
							}
						>
							{__('Save Changes', 'acme-plugin')}
						</Button>
					</HStack>
				</VStack>
			</Modal>
		);
	}

	// Icon selection grid view.
	const tabs = Object.keys(filteredIconGroups).map(groupName => ({
		name: groupName,
		title:
			groupName === 'svg'
				? __('General', 'acme-plugin')
				: groupName.charAt(0).toUpperCase() + groupName.slice(1).replace(/-/g, ' '),
		className: `tab-${groupName}`,
	}));

	return (
		<Modal
			title={modalTitle}
			onRequestClose={onClose}
			className="icon-format-modal"
			size="large"
		>
			{isLoading ? (
				<div style={{ textAlign: 'center', padding: 40 }}>
					<Spinner />
					<p>{__('Loading icons…', 'acme-plugin')}</p>
				</div>
			) : (
				<>
					<SearchControl
						value={searchTerm}
						onChange={setSearchTerm}
						placeholder={__('Search icons…', 'acme-plugin')}
						style={{ marginBottom: '16px' }}
					/>

					{tabs.length === 0 && (
						<div
							style={{
								textAlign: 'center',
								padding: '40px',
								color: '#757575',
							}}
						>
							{__('No icons found.', 'acme-plugin')}
						</div>
					)}
					{tabs.length === 1 && (
						// Single group - no tabs needed.
						<div
							className="icon-format-grid"
							style={{
								display: 'grid',
								gridTemplateColumns: 'repeat(auto-fill, minmax(100px, 1fr))',
								gap: 8,
								maxHeight: 400,
								overflowY: 'auto',
								padding: '4px',
							}}
						>
							{filteredIconGroups[tabs[0].name]?.map(iconData => {
								const isCurrentIcon = iconData.slug === currentIconSlug;
								return (
									<button
										key={iconData.slug}
										className={`icon-format-option ${isCurrentIcon ? 'is-current' : ''}`}
										onClick={() => onSelectIcon(iconData)}
										type="button"
										style={{
											display: 'flex',
											flexDirection: 'column',
											alignItems: 'center',
											padding: 8,
											border: isCurrentIcon
												? '2px solid #007cba'
												: '1px solid #ddd',
											borderRadius: 4,
											background: isCurrentIcon ? '#e7f3ff' : 'white',
											cursor: 'pointer',
											position: 'relative',
											transition: 'all 0.2s ease',
										}}
										onMouseEnter={e => {
											if (!isCurrentIcon) {
												e.currentTarget.style.background = '#f0f0f0';
											}
										}}
										onMouseLeave={e => {
											if (!isCurrentIcon) {
												e.currentTarget.style.background = 'white';
											}
										}}
									>
										<div
											dangerouslySetInnerHTML={{
												__html: getSvgWithStyles(iconData.content),
											}}
											style={{
												width: 32,
												height: 32,
												display: 'flex',
												alignItems: 'center',
												justifyContent: 'center',
											}}
											className="icon-form-svg-container"
										/>
										<span
											className="icon-format-name"
											style={{
												fontSize: 12,
												marginTop: 4,
												wordBreak: 'break-word',
												color: isCurrentIcon ? '#007cba' : '#1e1e1e',
												fontWeight: isCurrentIcon ? '600' : 'normal',
											}}
										>
											{iconData.name}
										</span>
										{isCurrentIcon && (
											<span
												style={{
													position: 'absolute',
													top: '4px',
													right: '4px',
													background: '#007cba',
													color: 'white',
													width: '20px',
													height: '20px',
													borderRadius: '50%',
													display: 'flex',
													alignItems: 'center',
													justifyContent: 'center',
													fontSize: '12px',
													fontWeight: 'bold',
												}}
											>
												✓
											</span>
										)}
									</button>
								);
							})}
						</div>
					)}
					{tabs.length > 1 && (
						// Multiple groups - use tabs.
						<TabPanel tabs={tabs}>
							{tab => (
								<div
									className="icon-format-grid"
									style={{
										display: 'grid',
										gridTemplateColumns:
											'repeat(auto-fill, minmax(100px, 1fr))',
										gap: 8,
										maxHeight: 400,
										overflowY: 'auto',
										marginTop: 20,
										padding: '4px',
									}}
								>
									{filteredIconGroups[tab.name]?.map(iconData => {
										const isCurrentIcon = iconData.slug === currentIconSlug;
										return (
											<button
												key={iconData.slug}
												className={`icon-format-option ${isCurrentIcon ? 'is-current' : ''}`}
												onClick={() => onSelectIcon(iconData)}
												type="button"
												style={{
													display: 'flex',
													flexDirection: 'column',
													alignItems: 'center',
													padding: 8,
													border: isCurrentIcon
														? '2px solid #007cba'
														: '1px solid #ddd',
													borderRadius: 4,
													background: isCurrentIcon ? '#e7f3ff' : 'white',
													cursor: 'pointer',
													position: 'relative',
													transition: 'all 0.2s ease',
												}}
												onMouseEnter={e => {
													if (!isCurrentIcon) {
														e.currentTarget.style.background =
															'#f0f0f0';
													}
												}}
												onMouseLeave={e => {
													if (!isCurrentIcon) {
														e.currentTarget.style.background = 'white';
													}
												}}
											>
												<div
													dangerouslySetInnerHTML={{
														__html: getSvgWithStyles(iconData.content),
													}}
													style={{
														width: 32,
														height: 32,
														display: 'flex',
														alignItems: 'center',
														justifyContent: 'center',
													}}
													className="icon-form-svg-container"
												/>
												<span
													className="icon-format-name"
													style={{
														fontSize: 12,
														marginTop: 4,
														wordBreak: 'break-word',
														color: isCurrentIcon
															? '#007cba'
															: '#1e1e1e',
														fontWeight: isCurrentIcon
															? '600'
															: 'normal',
													}}
												>
													{iconData.name}
												</span>
												{isCurrentIcon && (
													<span
														style={{
															position: 'absolute',
															top: '4px',
															right: '4px',
															background: '#007cba',
															color: 'white',
															width: '20px',
															height: '20px',
															borderRadius: '50%',
															display: 'flex',
															alignItems: 'center',
															justifyContent: 'center',
															fontSize: '12px',
															fontWeight: 'bold',
														}}
													>
														✓
													</span>
												)}
											</button>
										);
									})}
								</div>
							)}
						</TabPanel>
					)}
				</>
			)}
		</Modal>
	);
}

/**
 * PropTypes for IconModal component.
 */
IconModal.propTypes = {
	isOpen: PropTypes.bool.isRequired,
	onClose: PropTypes.func.isRequired,
	onSelectIcon: PropTypes.func.isRequired,
	currentIcon: PropTypes.string,
	currentIconSlug: PropTypes.string,
	currentIconUrl: PropTypes.string,
	setIsEditing: PropTypes.func.isRequired,
	isEditing: PropTypes.bool.isRequired,
	editAttributes: PropTypes.object,
	onSaveEdit: PropTypes.func.isRequired,
	iconGroups: PropTypes.object,
	isLoading: PropTypes.bool,
};
