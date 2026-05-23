const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');
const fs = require('fs');
const CopyPlugin = require('copy-webpack-plugin');

/**
 * Auto-discover block entry points from blocks/{block-name}/index.js.
 * Each block becomes its own webpack entry, output to build/blocks/{block-name}/index.js.
 */
const blocksDir = path.resolve(__dirname, 'blocks');
const blockEntries = {};

if (fs.existsSync(blocksDir)) {
	for (const blockName of fs.readdirSync(blocksDir)) {
		const indexEntry = path.join(blocksDir, blockName, 'index.js');
		if (fs.existsSync(indexEntry)) {
			blockEntries[`blocks/${blockName}/index`] = indexEntry;
		}
		const viewEntry = path.join(blocksDir, blockName, 'view.js');
		if (fs.existsSync(viewEntry)) {
			blockEntries[`blocks/${blockName}/view`] = viewEntry;
		}
	}
}

module.exports = {
	...defaultConfig,

	entry: {
		// Global asset bundles — enqueued per context via AssetLoader.php.
		frontend: path.resolve(__dirname, 'src/js/frontend.js'),
		editor: path.resolve(__dirname, 'src/js/editor.js'),
		admin: path.resolve(__dirname, 'src/js/admin.js'),
		'frontend-button-modal': path.resolve(__dirname, 'src/js/frontend-button-modal.js'),
		// Auto-discovered blocks.
		...blockEntries,
	},

	plugins: [
		...defaultConfig.plugins,
		// Copy block.json files to the build directory so PHP can use
		// register_block_type() with the build path directly.
		new CopyPlugin({
			patterns: [
				{
					from: 'blocks/*/block.json',
					to: ({ absoluteFilename }) => {
						const blockName = path.basename(path.dirname(absoluteFilename));
						return path.join('blocks', blockName, 'block.json');
					},
					noErrorOnMissing: true,
				},
				{
					from: 'blocks/*/render.php',
					to: ({ absoluteFilename }) => {
						const blockName = path.basename(path.dirname(absoluteFilename));
						return path.join('blocks', blockName, 'render.php');
					},
					noErrorOnMissing: true,
				},
			],
		}),
	],
};
