# Routes

Routes are modular. `routes/web.php` defines public routes and requires the other route files.

`php artisan route:list --except-vendor` reported 110 application routes during inspection.

## Public Routes

Defined in `routes/web.php`.

| Route | Name | Controller/action | Purpose |
| --- | --- | --- | --- |
| `GET /` | `home` | `HomeController@index` | Product listing with search/category/sort. |
| `GET /about` | `about` | inline view | About page. |
| `GET /contact` | `contact` | inline view | Contact page. |
| `GET /product/{slug}` | `product.show` | `HomeController@show` | Product detail and related products. |
| `GET /blog` | `blog.index` | `BlogController@index` | Published blog listing. |
| `GET /blog/{slug}` | `blog.show` | `BlogController@show` | Blog detail and view increment. |
| `GET /track-order` | `order.track` | `CheckoutController@track` | Order tracking form or direct lookup. |
| `POST /track-order` | `order.track.post` | `CheckoutController@trackOrder` | Order lookup by order ID and email. |
| `GET /lang/{locale}` | `lang.switch` | inline closure | Supports `en` and `id`, stores locale in session. |
| `GET /feed/instagram` | `feed.instagram` | `FeedController@instagram` | XML product feed. |
| `POST /analytics/click` | `analytics.click` | `AnalyticsController@click` | Records public storefront click analytics. |
| `GET /dashboard` | `dashboard` | inline closure | Redirects by role. Requires `auth`, `verified`. |

## Customer Routes

Defined in `routes/customer.php`.

Middleware: `auth`, `role:user,admin,superadmin`.

| Route group | Purpose |
| --- | --- |
| `/user/dashboard` | Customer dashboard with orders and product recommendations. |
| `/cart` | Session cart index, add, buy-now, update, remove. |
| `/checkout` | Checkout page, order creation, payment page, proof upload, success page. |
| `/profile` | Profile edit/update/delete and AJAX password verification. |

## Admin Routes

Defined in `routes/admin.php`.

Middleware: `auth`, `role:admin,superadmin`; prefix `admin`; route name prefix `admin.`.

Main resources:

- `admin.products.*`
- `admin.categories.*` including index, create/store, edit/update, and destroy.
- `admin.orders.*`
- `admin.measurements.*`
- `admin.blogs.*`

Custom order routes:

- `POST /admin/orders/{order}/approve`
- `POST /admin/orders/{order}/reject`
- `POST /admin/orders/{order}/stages`
- `DELETE /admin/stages/{stage}`

Reports:

- `admin.reports.sales`
- `admin.reports.stock`
- `admin.reports.customers`
- `admin.reports.finance`

Settings/CMS:

- `admin.settings.*` uses `Superadmin\SiteSettingController`.
- `admin.promo.*` uses `Superadmin\SiteSettingController`.
- `admin.cms.*` uses `CMSController`.

## Superadmin Routes

Defined in `routes/superadmin.php`.

Middleware: `auth`, `role:superadmin`; prefix `superadmin`; route name prefix `superadmin.`.

Superadmins can also access admin-prefixed resource management routes, including `admin.categories.*`, because `routes/admin.php` allows `role:admin,superadmin`.

Routes include:

- Dashboard.
- Settings and test-connection endpoints.
- Dedicated promo and storefront popup endpoints.
- CMS index/update.
- Sales, stock, customer, and finance reports through `Admin\ReportController`.
- Staff resource routes except create/show/edit.
- Customer list/export.

## Auth Routes

Defined in `routes/auth.php`.

Guest routes:

- Register, login, forgot password, reset password.

Authenticated routes:

- Verify email, resend verification notification, confirm password, update password, logout.

## Route Maintenance Notes

- Several `Route::resource` declarations expose create/show/edit/store/destroy routes even when controller methods are empty or views are absent.
- `bootstrap/app.php` excludes `payments/midtrans-notification` from CSRF validation, but no matching route was found.
- Route authorization is currently middleware-based; there are no policies or gates for product/order ownership beyond explicit checks in `CheckoutController`.
