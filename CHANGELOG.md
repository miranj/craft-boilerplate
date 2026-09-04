# Miranj Craft Boilerplate Changelog

Release notes for Miranj's Craft Boilerplate starter project.

## 3.6.0 - 2026-09-04

### Front-end

- Added index page views with pagination.

## Unreleased 3.next

### Front-end

- SVGs are now automatically optimised in-place as part of the Gulp build process.
- Added theme variables and utility classes for `z-index`, enabling a standardised stacking order across the pages.
- Added an `eagerload_first_img` parameter to the lister component, enabling list views to eager load the first image where it's the LCP element.
- Fixed an issue where focal points on images were not applied correctly.
- Removed redundant `@layer` declaration for `theme.css`.
- Reduced the default image compression quality for jpeg and webp images to decrease image file sizes in _Imager_.
- Enabled automatic responsive image variant generation in _Imager_.
- Fixed a bug where SEO images would not be updated if the original asset was modified without renaming the file.

### Craft

- Added a Matrix field entry type filter, so a single Matrix field can offer different blocks in different sections or global sets.
- Improved performance of accessing manifest files for cache busting build file URLs.
- Moved configuration of build stylesheets, build scripts, and external stylesheets to `config/custom`.
- Added `headLinkTags` to `config/custom` to configure custom `<link>` tags inside `<head>`.
- Added `createObject()` Twig function as an alias to `Craft::createObject()`.
- Increased default cache duration for application and template caches to 1 year.
- Switched to `craft up` instead of `craft migrate/all` and `craft pc/apply` for the `composer install` script.
- Updated Redis cache component config for compatibility with Yii 2 Redis 2.1.0.
- Updated Craft CMS to 5.9.14.
- Updated CKEditor to 4.11.1.
- Updated Imager X to 5.1.7.
- Updated Navigation to 3.0.17.
- Updated No-Cache to 3.1.0.
- Updated oEmbed to 3.2.0.
- Updated Retcon to 3.2.2.
- Updated Typogrify to 5.0.2.
- Updated Yii 2 Redis to 2.1.0.

### System

- Ignore `.sql` files from version control.

## 3.5.0 - 2026-02-17

### Front-end

- Upgraded to Tailwind CSS 4.x.
- Added `<lite-youtube>` web component.
- Improved `.richtext` typographic styles to handle tables and `pre` content, added `.italictext`.
- Improved `_components/embed` with support for facade loading _YouTube_ videos.
- The entry “Edit” button now redirects authors back to the front-end entry page when they save their changes.
- Eager-loaded images will now be loaded with `fetchpriority: high` to improve pageload speed.
- Fixed a bug where `:is`, `:where`, and other colon selectors were always getting purged.
- Removed outdated favicon meta tags.
- Updated CSS Nano to 7.0.6.

### Data Model

- Added a _Multimedia_ asset volume.

### Craft

- Added support for previewing partial element views to logged-in site authors.
- Added support for nested entries in the Detail, Feed, JSON-LD, and Teaser view routers.
- Added `_layouts/private` as a base template for front-end content restricted to site authors.
- Added `_layouts/json` as a base template for rendering JSON content.
- Added support for `cacheKeySuffixes` which can be overridden by child templates.
- Improved `_components/metaInfo` with support for item links and icons.
- Added `svgIcon()` Twig function to render SVGs from any file path (or alias).
- Added `cache-svg-shapes` hook to enable caching repeat instances of SVG markup generated via `svgIcon()`.
- Added default Feed Me plugin config for optional HTTP auth credentials support.
- Added default Image Resizer plugin config.
- Cache oEmbed lookups.
- Queue jobs are now allowed to run for 15 minutes.
- Replaced deprecated `|ucfirst` with `|capitalize`.
- Disabled automatic conversion of exponents, fractions, and marks via `|typogrify`.
- Fixed a bug where the _Edit_ button would not be shown for authors on nested entry pages.
- Fixed a bug where RSS Feed content was double escaping HTML entities.
- Added _Video Utils_ plugin.
- Updated Craft CMS to 5.8.11.
- Updated CKEditor to 4.9.0.
- Updated Element Index Default to 4.0.1.
- Updated Image Resizer to 4.0.4.
- Updated Imager X to 5.1.6.
- Updated Navigation to 3.0.10.
- Updated oEmbed to 3.1.5.
- Updated SEOMate to 3.2.0.
- Removed CP Field Inspect plugin.

### DevOps

- Allow Nginx to bypass cache for all responses that contain _any_ cookie.
- Fixed in infinite redirection loop for URLs that map to directories.

## 3.4.1 - 2025-07-25

### Craft

- Updated Craft CMS to 5.7.4.
- Updated Navigation to 3.0.8.

## 3.4.0 - 2025-05-01

### Front-end

- Remove CSS fallbacks for `calc()`, and CSS variables, both of which are now _Baseline: Widely Available_.
- Added _Index_ views router.

### Data Model

- The following sections, entry types and corresponding fields have been added:
  - _Academic Levels_ section, _Academic Level_ entry type, and _Academic Level_ field
  - _Departments_ section, _Department_ entry type, and _Department_ and _Departments_ field
  - _Events_ section, _Event_ entry type
  - _Jobs_ and _Jobs Index_ sections, _Job_ entry type
  - _News_ and _News Index_ sections, _News_ entry type
  - _Organisations_ section, _Organisation_ entry type
  - _Offices_ and _Offices Index_ sections, _Office_ entry type, _Offices_ field
  - _People_ and _People Index_ sections, _Org Member_ and _External Contributor_ entry types, _Authors_ and _People_ fields
  - _Programmes_ and _Programmes Index_ sections, _Programme_ entry type and a _Programmes_ field
  - _Projects_ and _Projects Index_ sections, _Project_ entry type
  - _Publications_ and _Publications Index_ sections, _Publication_ entry type
  - _Resources_ and _Resources Index_ sections, _Resource_ and _Resource Link_ entry types
  - _Testimonials_ section, _Testimonial_ entry type
  - _Search_ section
  - _Tenders_ section, _Tender_ entry type
- The following categories and corresponding fields have been added:
  - _Disciplines_
  - _Event Types_
  - _Focus Areas_
  - _Languages_
  - _News Types_
  - _Oportunities Types_
  - _Publications Types_
  - _Practices_
  - _Project Types_
  - _Resource Types_
  - _Topics_
- The following fields have also been added:
  - Content Blocks: _Faculty_, and _Projects_.
  - Content Builders: _Simple Navigation_, _Contact Information_, and _Credits_.
  - Body Blocks: _Collapse_, _Button_, and _Media Embed_, alongwith a _Nested Body_ field for nesting content in _Collapse_ blocks.
  - Other fields: _Author Type_, _External Person Roles_, various _Hyperlink_ and _Url_ options, _Date_, and _Media Embed_.
- The following navigation menus have been created:
  - _Header_
  - _Footer_
  - _Fineprint_
- Added the _Organisation_ global set.

### Craft

- Installed Navigation 3.0.6.
- Installed Store Hours 4.2.0.
- Installed oEmbed 3.1.4.
- Updated Craft CMS to 5.6.17.
- Updated CKEditor to 4.6.0.
- Updated CP Field Inspect to 2.0.4.
- Updated Image Resizer to 4.0.3.
- Updated Imager X to 5.1.3.
- Fixed a bug where changes to an existing asset would not always result in Imager transforms being re-generated.

### DevOps

- PDF files can now be cached by user agents for 1 month.
- Fixed a bug where the primary Craft app would not honour extra static file rules for videos, webmanifests, etc.
- Refactored extra Nginx static file rules config for better re-use.

### System

- Added automated deployment commands (post-install) for the boilerplate project setup.

## 3.3.0 - 2025-02-24

### Front-end

- Added native CSS view transitions when navigating between pages.

### Data Model

- Added project config for a blank Craft install.
- Added _Blog_, _Blog Index_, _Home Page_, _Pages_, and _404 Page Not Found_ sections.
- Added _Sharing & SEO_, _Footer_, _Newsletter_, and _Google Analytics_ global sets.
- Added _Page_, _Blog Post_, and _Index Page_ entry types.
- Added Body field with nested Image, Gallery blocks.
- Added text fields for common use cases: Label, Plain Text, Simple Text, Rich Text, Summary, and Code.
- Added asset fields for common use cases: Image, Images.
- Added lightswitch fields for common use cases: Toggle (Default: off), and Toggle (Default: on).
- Added links fields for common use cases: Call to Action, Hyperlink, and Legacy URL.
- Added SEO fields for: title, description, image, and default image.
- Added filesystems for common use cases: Uploads, Static Assets, Transforms, and Private Uploads.
- Added asset volumes for common use cases: Images, Documents, Form Submissions, User Photos, and Static Assets.
- Added custom entry sources for Home Page and Index Pages.
- Added dynamic entry sources: Updated Recently, Published Recently, Created Recently.
- Added user permissions groups for Editors, Site Configuration, System Administration, and User Managers.
- Added a primary site.

### Craft

- Added SMTP email config.
- Added scaffolding for including custom Control Panel CSS.
- Added `limitBlocksByType()` macro to `_helpers/matrix`.
- Added `_cp/paths/assets` template for generically generating asset upload paths.
- Updated Craft to 5.5.

### DevOps

- Improved robustness of Live Preview CORS headers for control panel URLs using standard ports.

### System

- Added the Composer lock file.

## 3.2.0 - 2024-12-17

### Front-end

- Added generated front-end CSS and JS assets inside the `./web/build` folder.
- Safelisted CSS selectors for common HTML tags in richtext content, as well as typographic frills added by the `|typogrify` filter.
- CSS purge task will now ignore dev preview templates when scanning for selectors.

### Craft

- Added custom 404 and 403 error page templates. The 403 page is automatically shown when accessing an entry that is not yet published.
- Added `getPDFCover()` macro to `_helpers/pdf`.
- Improved handling of SEO page title for a homepage single.
- Fixed a bug where certain Craft preview pages were getting cached by Nginx FastCGI.
- Fixed a bug where `normaliseRichtext()` would process input as Markdown by default.
- Removed all uses of the deprecated `|spaceless` filter.
- Updated Craft to 5.3.

### System

- Prefer importing database dumps via Craft’s `db/restore` for better robustness.
- Updated PurgeCSS to 7.0.0, switched to PostCSS plugin based usage.

## 3.1.0 - 2024-08-28

### Front-end

- Added a barebones site-level header and footer to the base template.
- Added a barebones placeholder homepage.
- Added a base layout grid with utility classes for grid areas.
- Added a base fluid type scale (via [Utopia](https://utopia.fyi/type/calculator/)).
- Added a base fluid spacing scale (via [Utopia](https://utopia.fyi/space/calculator/)).
- Added `em` based relative units to the spacing scale corresponding to the existing `rem` scale.
- Added support for Dark Mode (via the `prefers-color-scheme` media query).
- Added hover feedback effect for zoomable images.
- Added a page at `/_views` to visualise non-fullpage views such as Teasers, Snippets.
- Added [Alpine.js](https://alpinejs.dev/), alongwith the [Collapse plugin](https://alpinejs.dev/plugins/collapse).
- Added icons for some common podcast hosts.
- Fixed a bug where arbitrary value Tailwind classes with a `,` would always be purged.
- Updated Tailwind to 3.4.4.
- Removed JS based webfont loading workflow (deprecated in favour of [`font-display`](https://developer.mozilla.org/en-US/docs/Web/CSS/@font-face/font-display)).
- Removed Pjax based navigation (deprecated in favour of [Instant.page](https://github.com/instantpage/instant.page) and upcoming native page transitions).
- Removed Font Face Observer.
- Removed Pjax.
- Removed Topbar.

### Craft

- View routers now also look for section-independent entry type overrides (eg: `_page`, `_article`, etc.) in their cascade before falling back to the `_default` view.
- Teasers now refer to the primary object variable as `element` instead of `entry`.
- Added `heroicon()` Twig function to render the SVG version of any [Heroicons](https://heroicons.com/).
- Added `image` and `imageNested` fields to the Field Library.
- Added sample [Imager X named transforms](https://imager-x.spacecat.ninja/usage/named-transforms.html) based preset to the `_image` component.
- Added an `@icons` alias for the public SVG icons folder.
- The `_image` component's `preset` parameter can now directly refer to [Imager X named transforms](https://imager-x.spacecat.ninja/usage/named-transforms.html).
- Added `--dark-mode` media query to the `_image` component.
- Refactored `embed` component to render an [oEmbed plugin field](https://github.com/wrav/oembed).
- Logged in users with editing permissions will see a floating “Edit” button when viewing an entry on the front-end.
- SEOMate meta can now render custom `<link>` tags via the `links` key.
- Added sample code for GA4 data model integration.
- Enabled the _Last Edited By_ column for Entry sources.
- Enabled the _New Child_, and _Slug_ columns for Category sources.
- Added ProfilePage JSON-LD Schema definition.
- Improved existing JSON-LD Schema definitions, default templates.
- Fixed a bug where `normaliseRichtext()` would process input as Markdown by default.
- Fixed a bug where Live Previews would not work if the URL included a custom port.
- Fixed a bug where pagination would not work on any detail view pages.
- Fixed a bug where images with missing dimensions were causing a page loading failure.
- Removed _New Child_, and _URI_ columns for Entry sources, and _Date Created_ for Category sources.
- Removed Redactor configs.

### DevOps

- Configured CSP headers for CDN content (such as PDFs) to be embeddedable on the primary domain.
- Added DDEV support for dev environments.
- Added Ngrok support (via DDEV).

### System

- Switched to new Changelog format showing the unreleased version number, and grouping changes under semantic, audience-based sub-heads.
- Fixed a bug where Prettier would throw an error when committing the manifest symlink files.

## 3.0.0 - 2024-07-01

### Craft

- Added Craft 5 compatibility.
- Added a default HTML Purifier config.
- [Prevent user enumeration](https://craftcms.com/docs/5.x/reference/config/general.html#preventuserenumeration) on production via the _Forgot Password_ flow.
- Simplified [Redis and App Cache config](https://craftcms.com/docs/5.x/reference/config/app.html#redis-example).
- Updated Craft to 5.2.
- Updated Child Me! to 2.2.2.
- Updated CKEditor to 4.1.0.
- Updated CP Field Inspect to 2.0.1.
- Updated Element Index Defaults to 4.0.0.
- Updated Environment Label to 5.0.0.
- Updated Field Manager to 4.0.1.
- Updated Image Resizer to 4.0.0.
- Updated Imager X to 5.0.1.
- Updated Minify to 5.0.0.
- Updated No-Cache to 3.0.2.
- Updated Obfuscator to 1.2.0.
- Updated Retcon to 3.1.1.
- Updated SEOMate to 3.0.0-beta.6.
- Updated Twig Perversion to 5.0.0.
- Updated Typogrify to 5.0.1.
- Removed Inventory.

### DevOps

- Simplified `.env` config by assigning common default values.
- Simplified Apache config for dev environments.
- Refactored custom `.env` url and path variables to drop the `CRAFT_` prefix.
- Apache dev config is automatically enabled via htaccess in the post-install sequence.

### System

- Added a Changelog to track updates to the boilerplate.
- Added `package-lock.json` lockfile to keep track of exact Node packages.
- Added [PHPStan](https://github.com/craftcms/phpstan) for PHP code quality audits.
- Updated Gulp to 5.0.0. ([#96](https://github.com/miranj/craft-boilerplate/pull/96) via [@dependabot](https://github.com/apps/dependabot))
- Updated Node version to 20 LTS “Iron”.
- Updated PostCSS to 8.4.31. ([#94](https://github.com/miranj/craft-boilerplate/pull/94) via [@dependabot](https://github.com/apps/dependabot))
- Updated Prettier to 3.3.2.
- Updated Prettier PHP plugin to 0.22.2.
- Updated PHP to 8.2.
- The Field Library folder will now be purged in the post-install sequence.
- Removed `./craft setup` from the project post-install sequence.
- Removed legacy and redundant `.gitignore` rules.

## 2.0.0

- Craft 4 starter project.

## 1.0.0

- Craft 3 starter project.
