# Views and Frontend Architecture

## Blade Layouts

| Layout | Purpose |
| --- | --- |
| `resources/views/layouts/app.blade.php` | Public storefront layout with fixed navigation, CMS-driven meta tags/footer/social links, promo/notification popup, click analytics script, toast component, locale switcher, cart count, auth menu, AOS initialization, and floating widgets. |
| `resources/views/layouts/dashboard.blade.php` | Dashboard shell used by admin/superadmin/customer dashboard views. |
| `resources/views/layouts/guest.blade.php` | Auth/guest screens. |
| `resources/views/layouts/navigation.blade.php` | Breeze-style navigation partial. |

## Public Views

- `home.blade.php` renders CMS-driven hero/features/gallery sections, optional promo price banner, and product grid.
- `about.blade.php` and `contact.blade.php` are static public pages.
- `product/show.blade.php` renders product details with estimated price ranges, related products, cart/buy-now interactions, and measurement fields for customizable products.
- `blog/index.blade.php` and `blog/show.blade.php` render public blog pages. Blog detail pages include Open Graph/Twitter metadata and horizontal share actions for Facebook, X/Twitter, and WhatsApp.
- `cart/index.blade.php` renders the session cart.
- `checkout/*.blade.php` render checkout, manual payment, success, tracking form, and tracking result pages.

## Dashboard and Admin Views

- `dashboards/user/index.blade.php` shows customer order history and product recommendations.
- `dashboards/admin/index.blade.php` shows operational stats, charts, storefront analytics metrics, and user-facing traffic menu labels in Indonesian.
- `dashboards/superadmin/index.blade.php` shows business-wide stats, charts, storefront analytics metrics, and user-facing traffic menu labels in Indonesian.
- `admin/products`, `admin/categories`, `admin/orders`, `admin/measurements`, `admin/blogs`, `admin/cms`, and `admin/reports` implement admin screens. Product, category, blog, and staff index screens use scrollable dashboard modals for create/edit workflows.
- `superadmin/settings/index.blade.php`, `superadmin/settings/promo.blade.php`, `dashboards/superadmin/staff.blade.php`, and `dashboards/superadmin/customers` implement superadmin screens. Settings include brand/social/footer values, SEO, metadata, Open Graph, Twitter card, Google Tag Manager, Google Analytics, Google Ads, verification tags, and average-position input. The promo screen manages the storefront promo banner, initial popup, and announcement text.

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
- Logo assets. The favicon is served from `public/assets/logo.png`.
- Hero/about/features/gallery content.
- Social links.
- Footer social/contact links, including Instagram, TikTok, Shopee, WhatsApp, email, and address.
- Section visibility flags.
- SEO metadata, Open Graph/Twitter metadata, Google Tag Manager, Google Analytics, Google Ads, verification tags, and average-position dashboard input.
- Bank transfer instructions.
- Promo display values for storefront estimate display (`promo_original_price` and `promo_real_price` keys) plus popup/announcement values.

Dashboard image fields use drag-and-drop file upload controls rather than URL inputs. Product, category, blog, CMS, and payment-proof image inputs accept PNG, JPG/JPEG, WEBP, GIF, or AVIF files up to 5 MB. The CMS editor is stacked vertically with the live preview above the content editor; its internal content tabs sit above the form area. Hero and about text fields write localized `*_id` and `*_en` setting keys so the storefront preview reflects the same values read by `SiteSetting::getTranslatabled()`. Dashboard create/edit modals are teleported to the body and padded below the dashboard topbar so they do not collide with the header.

Dashboard numeric entry fields are rendered as text inputs with numeric input modes and client-side filtering to avoid browser spinner controls while still accepting numeric-only input.

Product, blog, and category image views use model `imageUrl()` helpers so local uploads under `public/assets/images/...` and legacy external URLs render consistently.

## View Maintenance Notes

- Several controller methods reference missing edit views: `admin.products.edit` and `admin.measurements.edit`.
- Some routes expose resource create/show/edit actions that are empty or not represented by views.
