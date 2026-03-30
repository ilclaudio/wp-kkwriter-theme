# wp-kkwriter-theme

A WordPress theme for writer-oriented websites, designed to work with the companion plugin [wp-kkwriter-plugin](https://github.com/ilclaudio/wp-kkwriter-plugin).

## Requirements

**Runtime:**
- WordPress 6.0+
- PHP 8.0+
- [wp-kkwriter-plugin](https://github.com/ilclaudio/wp-kkwriter-plugin) (required)
- [Polylang](https://wordpress.org/plugins/polylang/) (required for multilingual support)
- [CMB2](https://wordpress.org/plugins/cmb2/) (required for theme options UI)

**Development:**
- PHP (CLI) for linting
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) >= 18
- Java 8+ (required for HTML validation tests only)

## Installation

Clone or copy the theme folder into `wp-content/themes/`:

```bash
cd wp-content/themes/
git clone https://github.com/ilclaudio/wp-kkwriter-theme.git
```

Then activate it from **Appearance → Themes** in the WordPress admin.

## Development Setup

Install PHP and Node dependencies from the theme root:

```bash
composer install
npm install
```

Install the Playwright browser (required for e2e tests, ~150 MB, one-time):

```bash
npm run status:scan:install-browser
```

Configure git to use the project hooks:

```bash
git config core.hooksPath .githooks
```

### Compile SCSS

Custom Bootstrap overrides are in `assets/custom/scss/`. To recompile:

```bash
npm run build-css
```

Output: `assets/custom/css/custom-bootstrap.min.css`.

## Linting

```bash
# Check PHP coding standards
composer run lint:php

# Auto-fix PHP coding standards
composer run lint:php:fix
```

Standards are defined in `phpcs.xml.dist` (WordPress Coding Standards).

## Git Hooks

The project uses custom git hooks in `.githooks/`. After cloning, enable them with:

```bash
git config core.hooksPath .githooks
```

Active hooks:

| Hook | What it does |
|---|---|
| `pre-commit` | Blocks commits from unauthorized committers; checks for secrets and l10n issues in staged files |
| `commit-msg` | Blocks commits that contain a `Co-Authored-By: Claude` trailer |

## E2E Tests

Two automated test suites are available under `tests/e2e/`. Both use [Playwright](https://playwright.dev/) to render pages in a headless Chromium browser against a running WordPress instance.

### Status Scanner

Crawls all site pages starting from the sitemap and reports HTTP errors, PHP warnings in the HTML source, JavaScript runtime errors, broken resources (images, CSS, JS), and page response times.

```bash
# Scan the local development site
npm run status:scan -- https://writer.local

# Compare the two most recent scan reports
npm run status:compare
```

Reports are written to `tests/e2e/status-report/reports/` as `.html` and `.json` files with an automatic timestamp suffix. Open the `.html` file directly in the browser.

> Requires WordPress running with `WP_DEBUG=true` and `WP_DEBUG_DISPLAY=true` to surface PHP errors in the HTML source.

For full options and output format see [tests/e2e/status-report/README.md](tests/e2e/status-report/README.md).

### HTML Validator

Renders each page via Playwright and validates the produced HTML against the [Nu Html Checker (VNU)](https://validator.github.io/validator/). Requires Java 8+ on `PATH`.

```bash
# Validate all pages
npm run html:scan -- https://writer.local

# Validate and fail with exit code 1 if errors are found (CI use)
npm run html:scan:gate -- https://writer.local

# Compare the two most recent validation reports
npm run html:compare
```

Reports are written to `tests/e2e/html-report/reports/`.

For full options and output format see [tests/e2e/html-report/README.md](tests/e2e/html-report/README.md).

## Theme Configuration

Theme options are available in the WordPress admin under **Appearance → Theme Options**. The main tabs are:

| Tab | Content |
|---|---|
| HP Layout | Home page section visibility and order (carousel, featured content, blog) |
| Home messages | Configurable text blocks for the home page |
| Site contacts | Contact information displayed in templates |
| Social media | Social network links |
| Advanced settings | Analytics code and other advanced options |

## Home Page Carousel

The home page carousel displays a configurable set of contents (books, events, news) in a sliding panel.

### Configuration

Carousel settings are available under **Appearance → Theme Options → HP Layout → Carousel section**.

| Option | Description |
|---|---|
| Show the Carousel section | Show or hide the carousel on the home page |
| Show carousel before featured content | Controls carousel position relative to the featured content section |
| Automatic selection enabled | If yes, carousel contents are chosen automatically |
| Choose contents | Manually select which contents appear in the carousel |
| **Enable auto-scrolling** | If yes, slides advance automatically at a set interval |
| **Auto-scroll interval (seconds)** | Seconds between slide transitions when auto-scrolling is enabled (default: 5) |

### Auto-scrolling behavior

When auto-scrolling is enabled, slides advance automatically using Bootstrap 5's native carousel engine. No custom JavaScript is required.

**Pause on hover:** when the user moves the mouse over the carousel, the auto-scroll pauses automatically. It resumes as soon as the mouse leaves the carousel area.

**After manual interaction:** if the user clicks the previous/next buttons or the slide indicators, Bootstrap stops the auto-scroll permanently for that page session. It does not resume automatically. This is by design — Bootstrap interprets a manual interaction as the user taking control of navigation.

> If you want auto-scroll to resume after a manual interaction, the `data-bs-ride` attribute in
> `template-parts/home/carousel.php` can be changed from `"carousel"` to `"true"`.

### Accessibility note

Auto-scrolling carousels can be problematic for users with cognitive disabilities, screen readers, or motion sensitivity. A fully accessible implementation requires a visible Pause/Play button and support for the `prefers-reduced-motion` OS setting. These improvements are tracked in the issue backlog.

## Related Repositories

- Companion plugin: [wp-kkwriter-plugin](https://github.com/ilclaudio/wp-kkwriter-plugin)
