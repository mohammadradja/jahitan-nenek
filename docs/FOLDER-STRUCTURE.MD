# Folder Structure

## Top-Level Folders

| Path | Purpose |
| --- | --- |
| `app` | Application PHP code: controllers, middleware, requests, mail, models, providers, services, and view components. |
| `bootstrap` | Laravel bootstrap files, provider list, and cache placeholder. |
| `config` | Laravel and integration configuration. |
| `database` | Migrations, seeders, and factories. |
| `docs` | Generated maintenance documentation and diagrams. |
| `gemini` | Existing planning/context notes from prior AI work. |
| `lang` | English and Indonesian translation files. |
| `public` | Web root, published assets, brand/product images, built assets, and storage symlink target location. |
| `resources` | Source CSS/JS and Blade templates. |
| `routes` | Route files grouped by audience/module. |
| `storage` | Runtime application files, uploaded public files, cache/session/view/log directories. |
| `tests` | PHPUnit feature/unit tests. |

## Important Application Paths

| Path | Notes |
| --- | --- |
| `app/Http/Controllers` | Public, customer, dashboard, auth, admin, and superadmin controllers. |
| `app/Http/Controllers/Admin` | Catalog, order, measurement, blog, and report administration. |
| `app/Http/Controllers/Superadmin` | Staff, customer, and site setting administration. |
| `app/Http/Middleware` | Locale, role, and visitor tracking middleware. |
| `app/Models` | Eloquent models for users, products, orders, settings, visitors, analytics events, and supporting records. |
| `app/Services` | `LoyaltyService` and `WhatsAppService`. |
| `resources/views/layouts` | Main public, dashboard, guest, and navigation layouts. |
| `resources/views/admin` | Admin CRUD and report views. |
| `resources/views/superadmin` | Superadmin settings screens, including dedicated promo/popup management. |
| `resources/views/dashboards` | User/admin/superadmin dashboards and dashboard partials. |
| `resources/views/components` | Blade components for UI, product, blog, home, and layout fragments. |
| `resources/css/app.css` | Tailwind layers and shared component classes. |
| `resources/js/app.js` | Alpine bootstrapping. |
| `routes/web.php` | Public routes and inclusion point for route modules. |
| `routes/customer.php` | Authenticated customer cart, checkout, dashboard, and profile routes. |
| `routes/admin.php` | Admin routes protected by `auth` and `role:admin,superadmin`. |
| `routes/superadmin.php` | Superadmin-only routes protected by `role:superadmin`. |
| `routes/auth.php` | Breeze-style guest/auth routes. |

## Generated/Published Assets

The repository contains published Filament/Telescope-style assets under `public/js/filament`, `public/css/filament`, and `public/fonts/filament`. The app itself is not using Filament resources in `app/Filament`; these appear to be published/static assets only.

`public/build` is a Vite build output. In production, regenerate it with `npm run build` unless intentionally deploying committed built assets.
