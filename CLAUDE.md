# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

Marketing site + installable PWA for **VIP Ketering**, a catering company in Skopje. Laravel 12 backend serving an Inertia + Vue 3 single-page frontend, styled with Tailwind v4. Five public pages whose content is **fully database-backed and editable through an admin panel at `/admin`** (see "Admin / CMS" below). Content is **Macedonian (Cyrillic)** — preserve it verbatim when editing; don't translate or transliterate.

## Commands

```bash
composer dev      # all-in-one dev: php artisan serve + queue + pail logs + vite (concurrently)
npm run dev       # vite dev server only (HMR)
npm run build     # production asset build (required before serving without vite)
php artisan test  # run the full test suite (clears config first)
php artisan test --filter=ExampleTest   # run a single test
vendor/bin/pint   # format PHP to Laravel style

php artisan migrate --force             # APP is in production mode → --force is required
php artisan db:seed --force             # (re)seed all site content + admin user (idempotent: updateOrCreate)
php artisan route:clear                 # routes are cached on this host — clear after editing routes/web.php
```

Admin login is seeded by `DatabaseSeeder`: `admin@vipketering.mk` / `vipketering2026` (also recorded in `feedback.md`).

There is no JS linter/test runner configured — only Vite build and PHPUnit.

## Architecture

**Request flow:** `routes/web.php` → `PageController` → `Inertia::render('PageName')` → resolves `resources/js/Pages/PageName.vue`. Adding a page = a route + a controller method + a `Pages/*.vue` file (see `resources/js/app.js` for the glob resolver). The Inertia root template is `resources/views/app.blade.php`.

**Shared shell:** every page wraps its content in `resources/js/Components/Layout.vue`, which owns the header, scroll/solid nav state, full-screen mobile menu, footer, and the lightbox markup. Active-link and "always-solid header off the homepage" logic is driven by the Inertia URL. Page titles are set per-page via `<Head>` and suffixed with `— VIP Ketering` in `app.js`.

**Interactions:** `resources/js/effects.js` exports `initEffects(root)`, called from `Layout.vue`'s `onMounted`. It wires the scroll-reveal (`.reveal` → `.in`), animated counters (`[data-count]`), Ken-Burns hero, and the gallery lightbox — all by DOM querying, so new sections opt in via those classes/attributes rather than Vue state.

**Styling:** Tailwind v4 is loaded through the Vite plugin (`@tailwindcss/vite`); `resources/css/app.css` does `@import 'tailwindcss'` plus `@source` globs over blade/js/vue. The actual design system — color tokens (`--ink`, champagne gold `--gold`/`--gold-bright`, `--cream`), components, and animations — lives in `resources/css/site.css` as CSS variables and `.btn`, `.nav`, `.reveal` etc. classes. Templates mix Tailwind utilities with these custom classes and inline `var(--...)` references. Fonts (Cormorant, Cinzel, Manrope, full Cyrillic) come from Google Fonts in `app.blade.php`.

**PWA:** `public/manifest.webmanifest` + `public/sw.js` (network-first navigations, stale-while-revalidate for static assets, Inertia XHR bypasses cache). The service worker registration and the custom install-prompt UI are inline `<script>` in `app.blade.php`. Bump `CACHE` in `sw.js` when changing cached-asset behavior.

## Admin / CMS

The public pages are data-driven. `PageController` loads a `Page` row (+ related `Menu`, `EquipmentItem`, `GalleryImage`) and passes it as Inertia props; `HandleInertiaRequests::share()` injects the singleton `SiteSetting` (brand, phones, email, social, logo) globally so `Layout.vue` reads it everywhere. The Vue pages keep all original markup/classes and only **bind** values — headings with line breaks / gold accent spans are stored as small HTML snippets and rendered with `v-html`.

- **Content model:** `site_settings` (singleton), `pages` (one row per slug; a `content` **JSON** column holds all structured per-page fields), `menus`, `equipment_items`, `gallery_images` (per-`collection`: `home-food`, `menia`, `oprema`).
- **Schema-driven editor:** `app/Support/PageSchemas.php` declares, per page, the editable fields as sections of typed fields (`text`/`textarea`/`html`/`image`/`images`/`list`/`repeater`). The admin `Pages/Edit.vue` renders a form from this schema via the recursive `Components/Admin/FieldRenderer.vue`, writing into nested `content` keys (dot paths, see `resources/js/lib/path.js`). **To add an editable field, add it to `PageSchemas` and reference it in the page's Vue template — no migration needed.**
- **Auth:** session-based, single admin role. Routes live under the `admin.` prefix in `routes/web.php` (`guest` group = login, `auth` group = everything else). Unauthenticated admin hits redirect to `admin.login` (configured in `bootstrap/app.php`). Admin controllers are in `app/Http/Controllers/Admin/`.
- **Images:** every image is a URL-path string. `MediaController@store` (`POST /admin/media`) saves uploads to the `public` disk (`storage/app/public/uploads`, served via the `public/storage` symlink) and returns `{ src }`; the shared `Components/Admin/ImageField.vue` uploads and stores that path. Seeded content keeps the original `/img/*.jpg` paths until replaced.
- **Admin UI** uses the same Inertia/Vue stack but a separate light theme (`Components/Admin/AdminLayout.vue` sidebar shell with Tailwind utilities), distinct from the dark public design system.

When changing public content shape, keep three things in sync: the `PageSchemas` field, the `PagesSeeder` value, and the page's Vue binding.

## Key directories

- `design/` — the original hand-built **static HTML prototype** (Tailwind CDN) that the Vue pages were ported from. Not served; it's the design source of truth. `design/README.md` documents the concept, palette, menu price data, and remaining porting TODOs (menus/equipment/stats should eventually be data-backed; the contact form is currently demo-only JS and not wired to a controller).
- `public/img/` — production images (served). `design/assets/img/` is the prototype's copy.
- `backup/*.sql` — dump from the **old WordPress site** being replaced; reference only.

## Environment

See the auto-memory `server-environment.md` for host-specific quirks (CloudPanel, no `clpctl`, mysql root/root, node via nvm, php-fpm). This app itself has no DB-driven features, so most local work only needs `npm run dev` + `php artisan serve` (or `composer dev`).
