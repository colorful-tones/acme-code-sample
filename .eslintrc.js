module.exports = {
	extends: ['plugin:@wordpress/eslint-plugin/recommended'],
	env: {
		browser: true,
		es6: true,
		node: true,
	},
	globals: {
		wp: 'readonly',
		lodash: 'readonly',
		jQuery: 'readonly',
		$: 'readonly',
		rmgBlocks: 'readonly',
	},
	rules: {
		// Custom rules for our project.
		'no-console': 'warn',
		'no-unused-vars': 'error',
		'prefer-const': 'error',
		'no-var': 'error',

		// WordPress specific.
		'@wordpress/no-unsafe-wp-apis': 'warn',
		'@wordpress/no-unused-vars-before-return': 'off',

		// JSX specific.
		'jsx-a11y/no-onchange': 'off',
		'jsx-a11y/click-events-have-key-events': 'off',
		'jsx-a11y/no-static-element-interactions': 'off',

		// Import rules
		'import/no-unresolved': 'off',
		'import/named': 'off',
	},
	overrides: [
		{
			files: ['**/*.test.js', '**/*.spec.js'],
			env: {
				jest: true,
			},
		},
		{
			files: ['src/blocks/**/*.js'],
			rules: {
				// Block-specific rules.
				'@wordpress/no-unused-vars-before-return': 'error',
			},
		},
	],
};
