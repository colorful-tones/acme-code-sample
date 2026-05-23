# Acme — Code Sample Guide

A WordPress block theme (`themes/acme`) and companion plugin (`plugins/acme`) for a fictional recovery center. Built to demonstrate modern full-site editing, custom Gutenberg block development, accessible UI patterns, and vanilla JavaScript.

---

## Live Demo

1. Visit [Releases](https://github.com/colorful-tones/acme-code-sample/releases), and download attached `playground.zip`
2. Visit [WordPress Playground](https://playground.wordpress.net)
    - Click 4-square icon in top right, and choose: 'Import .zip'
    - Find downloaded `playground.zip` and select it

The demo opens on the home page which offers all of the custom blocks (testimonial slider, team member cards) and the modal button component (click the 'Speak with Admissions' button in hero area).

Data modelling is handled with ACF Free (no Pro license required). Team member data is seeded via `runPHP` steps in `blueprint.json`; post meta is set with `update_post_meta()` directly, bypassing ACF functions entirely so no Pro dependency exists at runtime.

---

## What to Look For

### 1. Accessible Carousel — Testimonial Slider

The testimonial slider demonstrates accessible carousel implementation across all three layers of the stack.

**React (Block Editor UI)**
`plugins/acme/blocks/testimonial-slider/edit.js`

- `InnerBlocks` with `allowedBlocks` restricted to `acme/testimonial-slide`, with a pre-populated `TEMPLATE`
- Live editor preview: reads inner block attributes via `useSelect` on the `core/block-editor` data store — no prop drilling, no extra state
- Inspector controls wired to block attributes: `ToggleControl` (autoplay), `RangeControl` (interval), `SelectControl` (accent color)
- `useBlockProps` merges the accent-color class with WordPress's wrapper attribute system
- Star rating rendered as inline SVGs with `aria-label` formatted via `sprintf` and a translator comment

**PHP (Server-Side Render)**
`plugins/acme/blocks/testimonial-slider/render.php`

- Full ARIA carousel pattern: `role="region"` + `aria-roledescription="carousel"` on the wrapper; `role="tabpanel"` + `aria-roledescription="slide"` on each slide; `role="tablist"` on the dot nav; `role="tab"` on each dot
- `aria-live="off"` on the track (JS switches to `polite` on user interaction only — prevents screen readers announcing auto-advances)
- `aria-labelledby` cross-references each slide with its dot button via unique IDs from `wp_unique_id()`
- All output escaped: `esc_html`, `esc_url`, `esc_attr`, `wp_kses_post` — zero XSS surface
- Reads data from `$block->inner_blocks` (parsed block attributes) rather than database queries

**Vanilla JS (Frontend)**
`plugins/acme/blocks/testimonial-slider/view.js`

- No framework, no jQuery — plain ES2020
- `inert` attribute: hidden slides become inert so keyboard focus cannot enter them
- `prefers-reduced-motion`: `window.matchMedia` disables CSS transitions and auto-play; listens for live changes via `prefersReducedMotion.addEventListener('change', ...)`
- Pause on hover (`mouseenter`/`mouseleave`) and pause on focus (`focusin` / `focusout` with `slider.contains(e.relatedTarget)` check to avoid false triggers)
- Keyboard navigation: `ArrowLeft` / `ArrowRight` with `preventDefault`
- Touch/swipe: `touchstart` + `touchend` with 50px threshold, `{ passive: true }` listeners

**CSS**
`plugins/acme/blocks/testimonial-slider/style.scss`

- All colors and spacing via `var(--wp--preset--...)` — values come from `theme.json`, never hardcoded
- WCAG 2.5.5 touch targets: dot buttons are 24px visually; hit area extended to 44px via `::after { inset: -2px; }` with an explanatory comment showing the geometry calculation
- `focus-visible` pseudo-class for keyboard-only focus rings (no visible ring on click)
- `will-change: transform` on the track for GPU-composited sliding
- `.no-transition` toggled by JS for reduced-motion users

---

### 2. Accessible Dialog — Button Modal

`plugins/acme/src/js/modules/button-modal/button-modal.js`

A WCAG 2.1-compliant modal system built on the native `<dialog>` element. No library.

- **Focus trap**: queries all focusable selectors, wraps Tab/Shift+Tab at boundaries (WCAG 2.1.2 No Keyboard Trap). Returns a cleanup function used to release the trap on close
- **`showModal()` / `close()` API**: uses the native dialog API — Escape key works for free, backdrop is `::backdrop`, no CSS display toggling needed
- **Scrollbar width compensation**: `window.innerWidth - document.documentElement.clientWidth` measured before `overflow: hidden` is applied; the value becomes `paddingRight` on `body` to prevent layout shift when the scrollbar disappears
- **Focus return**: the triggering element is stored on the dialog as `_acmeTrigger`; a single `close` event listener handles all close paths (button, backdrop click, Escape key) and restores focus
- **Event delegation**: all open/close handlers attach to `document` and use `closest()` for matching — works on dynamically injected buttons without re-initialization

---

### 3. REST-backed Icon Inserter

A custom RichText format that injects inline SVG icons inside button text.

**Editor UI**
`plugins/acme/src/js/modules/icon-inserter/edit.js`

- `RichTextToolbarButton` only renders when the selected block is a button (`core/button`) — early `return null` prevents cluttering other blocks' toolbars
- Icons fetched lazily via `apiFetch` on first modal open; subsequent opens skip the request
- `insertObject` from `@wordpress/rich-text` inserts the icon as an inline object (not editable text) with a stable character placeholder
- Replace vs. insert: `isObjectActive` detects whether the cursor is on an existing icon; if so, the modal pre-fills current values and calls `onChange` to replace the replacement record rather than inserting a new one
- Icon displayed using a CSS mask technique: the icon's URL is set as `--icon-url` custom property; theme CSS renders it as a masked background

**REST Endpoint**
`plugins/acme/inc/Rest/IconLibrary.php`

- `permission_callback` requires `edit_posts` — SVG content is not publicly listed
- `wp_cache_get` / `wp_cache_set` with `HOUR_IN_SECONDS` TTL prevents repeated `glob()` filesystem scans per request
- Icons grouped by subdirectory; each entry exposes `name`, `slug`, `url`, and inline `content` for the modal preview

---

### 4. Dynamic Block — Team Member Card

`plugins/acme/blocks/team-member-card/`

A server-rendered block that displays a team member from a custom post type inside a Query Loop.

- **`usesContext: ["postId", "postType"]`** in `block.json`: the block receives the current post's ID from its Query Loop parent via WordPress context — no REST fetch, no prop drilling
- **Manual border serialization**: `__experimentalSkipSerialization: true` on border support stops WordPress auto-generating border CSS (the auto output was incorrect for this case). `render.php` manually resolves both the `borderColor` attribute slug and the `var:preset|color|slug` shorthand, then passes the resolved values to `wp_style_engine_get_styles()` to produce correct CSS
- **`inserter: false`**: hides the block from the block inserter — it can only be added by placing it inside its Query Loop parent in the editor
- **ACF local JSON** (`acf-json/`): field groups, post types, and taxonomies stored as JSON files inside the plugin, version-controlled alongside code so the team shares field definitions via git and not just via database export

---

### 5. Plugin Architecture

`plugins/acme/inc/`

- **PSR-4 namespacing** (`AcmePlugin\` prefix): each class maps 1:1 to a file path; IDE navigation works without magic includes or custom autoloaders in production
- **`declare(strict_types=1)`** on every PHP file: catches type coercion bugs at development time
- **`Plugin::make()` singleton** (`Plugin.php`): single entry point wires all subsystems; registered on `plugins_loaded` (not `init` or earlier) to ensure all WordPress APIs are available
- **`AssetLoader`** (`inc/Assets/AssetLoader.php`): encapsulates all `wp_enqueue_scripts`, `enqueue_block_editor_assets`, and `admin_enqueue_scripts` logic in one class, using plugin version for cache-busting
- **`BlockRegistry`** (`inc/Blocks/BlockRegistry.php`): discovers and registers blocks by scanning the `build/blocks/` directory, calling `register_block_type_from_metadata()` for each `block.json` found
- **`QueryLoop`** (`inc/Blocks/QueryLoop.php`): extends the core Query Loop block to add `team-member` as a selectable post type in the editor UI

---

### 6. Design Token System — theme.json

`themes/acme/theme.json`

- **Color palette**: `primary`, `secondary`, `accent` each with base, `100`, and `200` tints; `neutral-0` through `neutral-500` for text and UI surfaces; all consumed by blocks via `var(--wp--preset--color--*)` — no hardcoded hex values in CSS
- **Fluid typography**: every font size uses WordPress's `fluid` property to produce `clamp(min, preferred, max)` — type scales smoothly between breakpoints with zero media queries
- **Fluid spacing**: `large` is `clamp(32px, 7vw, 48px)`, `x-large` is `clamp(50px, 7vw, 90px)` — section padding grows proportionally with viewport
- **Custom tokens**: `--wp--custom--button-modal--*` drives the modal SCSS variables; `--wp--custom--font-weight--*` provides named weight aliases used in block typography settings
- **Block-level overrides**: `core/accordion`, `core/separator`, `core/site-title`, `core/navigation` and more are styled in JSON rather than external CSS — the design-token source of truth is one file

---

## Technology Choices

| Area | Choice | Rationale |
|------|--------|-----------|
| PHP | PSR-4, strict types, PHP 8.1+ | Modern, type-safe, IDE-navigable |
| JS (editor) | `@wordpress/element` (React) | Native Gutenberg API |
| JS (frontend) | Vanilla ES2020, no jQuery | Bundle size, zero dependency debt |
| CSS | SCSS + `theme.json` design tokens | Tokens enforce brand consistency across blocks |
| Accessibility | ARIA carousel, focus trap, `inert`, `prefers-reduced-motion` | WCAG 2.1 AA target |
| Block data | ACF local JSON | Version-controlled, team-shareable field definitions |

## Local Setup

1. Clone this repo into your `wp-content/` directory
2. Install PHP dependencies: `composer install` (from `wp-content/`)
3. Build JS/CSS: `cd plugins/acme && npm install && npm run build`
4. Install and activate ACF Free 6.x (or ACF Pro — both work; Pro adds CPT UI and repeater field editing)
5. Activate the `acme` plugin and `acme` theme
6. In the WordPress admin, go to `ACF > Sync` to import field groups from JSON
7. Seed team members: `wp eval-file data/create-team-members.php` (requires ACF Pro for repeater fields; use the blueprint for ACF Free)
