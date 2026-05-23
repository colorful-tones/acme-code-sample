# Acme Plugin

Modular WordPress plugin with ACF-managed post types, auto-discovered blocks, context-aware asset loading, and editor extensions.

- **Requires WordPress:** 6.4+
- **Requires PHP:** 8.1+
- **License:** GPL-2.0-or-later

---

## Setup

```bash
# PHP autoloader
composer install

# JS dependencies + initial build
npm install
npm run build
```

Activate the plugin from **Plugins → Installed Plugins** in wp-admin.

---

## Architecture

```
plugins/acme/
├── acme-plugin.php                        # Plugin header + bootstrap
├── uninstall.php                          # Cleanup on delete
├── webpack.config.js                      # Extends @wordpress/scripts config
├── acf-json/
│   ├── field-groups/                      # ACF field group definitions (local JSON)
│   └── post-types/                        # ACF post type definitions (local JSON)
├── assets/
│   └── svg/                               # SVG icon library files (served via REST)
│       ├── general/                       # General-purpose icons
│       ├── acme/                          # Brand-specific icons
│       └── children/                      # Child-context icons
├── inc/
│   ├── Plugin.php                         # Singleton orchestrator — wires everything
│   ├── ACF/
│   │   └── AcfJsonPaths.php              # Local JSON save/load paths per ACF type
│   ├── Admin/
│   │   └── TeamMemberColumns.php         # Featured column + sorting on team-member list
│   ├── Assets/
│   │   └── AssetLoader.php              # Dep-safe enqueueing via *.asset.php manifests
│   ├── Blocks/
│   │   ├── BlockRegistry.php            # Auto-discovers build/blocks/*/block.json
│   │   └── QueryLoop.php               # Featured-filter extension for Query Loop block
│   ├── Modules/
│   │   └── ButtonModal.php             # Extends core Button block with modal support
│   ├── PostTypes/
│   │   └── TeamMemberEditor.php        # Disables block editor for team-member; registers image size
│   └── Rest/
│       └── IconLibrary.php             # SVG icon library REST endpoint
├── src/
│   ├── js/
│   │   ├── frontend.js                  # Public-facing entry point
│   │   ├── frontend-button-modal.js     # Modal JS (lazy-enqueued on demand)
│   │   ├── editor.js                    # Block editor entry point
│   │   ├── admin.js                     # wp-admin entry point
│   │   └── modules/
│   │       ├── button-modal/            # Editor extension for Button → modal
│   │       ├── icon-inserter/           # Icon picker editor extension
│   │       └── query-loop/              # Featured-only filter UI for Query Loop
│   └── scss/
│       ├── frontend.scss
│       ├── editor.scss
│       └── admin.scss
└── blocks/
    ├── team-member-card/                # Dynamic block (render.php); use inside Query Loop
    │   └── block.json
    ├── testimonial-slider/              # Auto-cycling carousel; viewScript-powered
    │   └── block.json
    └── testimonial-slide/              # Child block; must be inside testimonial-slider
        └── block.json
```

### Boot lifecycle

1. `plugins_loaded` → `Plugin::boot()` instantiates each feature class and attaches its WordPress hooks.
2. `init` → `BlockRegistry` registers all blocks found under `build/blocks/`.
3. `init` → `TeamMemberEditor` registers the `team-member-photo` image size and disables the block editor for `team-member`.
4. ACF registers the `team-member` CPT from `acf-json/post-types/` automatically (local JSON load paths wired by `AcfJsonPaths`).
5. On activation — `Plugin::activate()` is called (extend as needed to flush rewrite rules or set defaults).

All wiring lives in `Plugin.php`. Adding a feature means adding a class and one or two lines in `boot()`.

---

## ACF Integration

ACF field groups and post types are stored as local JSON inside the plugin so they travel with the codebase and are version-controlled.

`AcfJsonPaths` registers per-type save and load paths under `acf-json/`:

| ACF type | Directory |
|---|---|
| Field groups | `acf-json/field-groups/` |
| Post types | `acf-json/post-types/` |
| Taxonomies | `acf-json/taxonomies/` |
| UI options pages | `acf-json/ui-options-pages/` |

Any field group or post type you create/edit in the ACF UI is automatically saved to the matching directory. On a fresh install WordPress loads them back from these files.

The ACF 6.8+ datastore is enabled globally via `TeamMemberEditor`, so ACF field values are stored in the post meta table as native WordPress meta (no separate ACF meta table).

---

## Team Member CPT

The `team-member` post type is defined in `acf-json/post-types/post_type_6a0f93f8c1809.json` and registered automatically by ACF when the plugin is active — no PHP registration required.

Key configuration:
- **Slug:** `team-member`
- **Supports:** `title`, `custom-fields`
- **REST API:** enabled (`show_in_rest: true`)
- **Block editor:** disabled for this post type via `TeamMemberEditor`

### Team Member fields

Fields are defined in `acf-json/field-groups/group_team_member_details.json`. The `featured_team_member` field (boolean) drives the featured sorting and filtering features.

### Featured filtering

`TeamMemberColumns` adds a **Featured** column to the admin list table with star icons and sortable ordering.

`QueryLoop` extends the core Query Loop block with a `featuredOnly` attribute. When enabled on a `team-member` query it:
- Injects a `meta_query` condition on the frontend (via `query_loop_block_query_vars`).
- Registers `featuredOnly` as a boolean REST collection param so the editor preview also filters correctly.

### Image size

`TeamMemberEditor` registers a `team-member-photo` image size (300×300 hard crop). Use this size when displaying team member photos in `render.php`.

---

## Adding a Block

1. Create a directory under `blocks/`:

```bash
mkdir blocks/my-block
```

2. Add `block.json` and source files (`index.js`, `edit.js`, `save.js`, style sheets). Use `blocks/testimonial-slider/` as a reference for a static/dynamic block or `blocks/team-member-card/` for a purely dynamic one.

3. Build:

```bash
npm run build
```

The block is auto-discovered by both webpack (entry point) and `BlockRegistry` (PHP registration). No additional PHP changes are required.

> For dynamic (server-rendered) blocks, return `null` from `save.js` and add a `render.php` to your block directory. Webpack's `CopyPlugin` copies both `block.json` and `render.php` to `build/blocks/` automatically.

---

## Button Modal Module

`ButtonModal` extends the core Button block so that any button in a Synced Pattern can open a modal dialog without a page reload.

**How it works:**

1. An editor extension (`src/js/modules/button-modal/edit.js`) adds `isModalEnabled`, `patternId`, and `hasCustomModalHeading`/`customModalHeading` attributes to the block inspector.
2. On the frontend, `ButtonModal::render_button_block` detects these attributes, adds `data-modal-enabled` / `data-pattern-id` attributes to the rendered button element, and lazy-enqueues the modal JS/CSS bundle (`frontend-button-modal`) only when at least one modal button appears on the page.
3. All modal `<dialog>` elements are injected into `wp_footer` with the Synced Pattern content rendered inside.

---

## Icon Library

`IconLibrary` serves the plugin's SVG icon collection via a REST endpoint:

```
GET /wp-json/acme-plugin/v1/svg-images
```

Requires `edit_posts` capability. Returns icons grouped by subdirectory under `assets/svg/`. The top-level files are returned under the `general` group.

The response is object-cached for one hour (`acme_plugin_svg_list`).

The editor icon-inserter (`src/js/modules/icon-inserter/`) consumes this endpoint to render an icon picker panel.

---

## Asset Bundles

Four context-aware bundles are enqueued automatically:

| Bundle | Hook | Use for |
|---|---|---|
| `frontend` | `wp_enqueue_scripts` | Public-facing JS/CSS |
| `frontend-button-modal` | On demand (lazy) | Modal JS/CSS — only when a modal button renders |
| `editor` | `enqueue_block_editor_assets` | Editor-wide (non-block) JS/CSS |
| `admin` | `admin_enqueue_scripts` | All wp-admin screens JS/CSS |

Entry points live in `src/js/` (JS) and `src/scss/` (SCSS). Each bundle's `*.asset.php` manifest (generated by `@wordpress/scripts`) is read at runtime so `@wordpress/*` packages are loaded from WP core rather than bundled.

---

## JS Scripts

```bash
npm run build           # Production build
npm run start           # Development watch mode
npm run lint:js         # Lint JS with @wordpress/eslint-plugin
npm run lint:js:fix     # Lint JS and auto-fix
npm run lint:css        # Lint SCSS with stylelint
npm run format:js       # Auto-format JS
npm run format:css      # Auto-format SCSS
npm run packages-update # Update @wordpress/* peer deps
```

---

## Uninstall

`uninstall.php` runs when the plugin is deleted from wp-admin. Add any data cleanup (options, custom tables, etc.) there. The `WP_UNINSTALL_PLUGIN` constant is verified before any destructive code runs.
