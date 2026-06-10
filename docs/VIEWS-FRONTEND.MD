# Views and Frontend Architecture

## Blade Layouts

| Layout | Purpose |
| --- | --- |
| `resources/views/layouts/app.blade.php` | Public storefront layout with fixed navigation, footer, toast component, locale switcher, cart count, auth menu, AOS initialization, and floating widgets. |
| `resources/views/layouts/dashboard.blade.php` | Dashboard shell used by admin/superadmin/customer dashboard views. |
| `resources/views/layouts/guest.blade.php` | Auth/guest screens. |
| `resources/views/layouts/navigation.blade.php` | Breeze-style navigation partial. |

## Public Views

- `home.blade.php` renders CMS-driven hero/features/gallery sections and product grid.
- `about.blade.php` and `contact.blade.php` are static public pages.
- `product/show.blade.php` renders product details, related products, cart/buy-now interactions, and measurement fields for customizable products.
- `blog/index.blade.php` and `blog/show.blade.php` render public blog pages.
- `cart/index.blade.php` renders the session cart.
- `checkout/*.blade.php` render checkout, manual payment, success, tracking form, and tracking result pages.

## Dashboard and Admin Views

- `dashboards/user/index.blade.php` shows customer order history and product recommendations.
- `dashboards/admin/index.blade.php` shows operational stats and charts.
- `dashboards/superadmin/index.blade.php` shows business-wide stats and charts.
- `admin/products`, `admin/categories`, `admin/orders`, `admin/measurements`, `admin/blogs`, `admin/cms`, and `admin/reports` implement admin screens. The category index links to a dedicated category edit form for category updates.
- `superadmin/settings/index.blade.php`, `dashboards/superadmin/staff.blade.php`, and `dashboards/superadmin/customers` implement superadmin screens.

## Blade Components

Components are grouped by use:

- `components/ui`: buttons, modal, dropdown, form inputs, toast, auth session status.
- `components/product`: product cards.
- `components/blog`: blog cards/previews.
- `components/home`: home hero/features/gallery.
- `components/layout`: logo and nav links.

## Frontend Assets

Source assets:

- `resources/css/app.css`
- `resources/js/app.js`
- `resources/js/bootstrap.js`
- `tailwind.config.js`
- `vite.config.js`

Vite inputs:

```js
['resources/css/app.css', 'resources/js/app.js']
```

JavaScript:

- Imports `bootstrap.js`.
- Registers Axios globally as `window.axios`.
- Starts Alpine.js globally as `window.Alpine`.

CSS:

- Tailwind base/components/utilities.
- Shared component classes such as `btn-premium`, `btn-primary`, `input-premium`, `table-premium`, and `card-premium`.
- Custom Tailwind colors: `vintage-cream`, `soft-rose`, `dark-wool`, `accent`.

External frontend dependencies loaded by Blade:

- Font Awesome CDN.
- Google Fonts (`Playfair Display`, `Poppins`, `Outfit`).
- Animate.css CDN.
- AOS CDN.

## Localization

Translations live in `lang/en` and `lang/id`. The public layout uses translation keys from `messages.php`; dashboard views also reference dashboard translations.

`LocaleMiddleware` sets locale from session or `SiteSetting::get('default_language', 'id')`. `/lang/{locale}` only accepts `en` and `id`.

## CMS-Driven Content

Views frequently read CMS data through `SiteSetting::get()` and `SiteSetting::getTranslatabled()`. CMS data includes:

- Site name/tagline.
- Logo/favicon.
- Hero/about/features/gallery content.
- Social links.
- Section visibility flags.
- Bank transfer instructions.

## View Maintenance Notes

- Several controller methods reference missing edit views: `admin.products.edit` and `admin.measurements.edit`.
- Some routes expose resource create/show/edit actions that are empty or not represented by views.
- Public layout contains some hardcoded external links and contact values alongside CMS-driven values.
