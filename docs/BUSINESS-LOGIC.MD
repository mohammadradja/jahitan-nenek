# Business Logic

## Product Browsing

`HomeController@index` starts with `Product::with('category')`.

Supported query parameters:

- `search`: matches product `name` or `description` with SQL `like`.
- `category`: matches category slug through `whereHas('category')`.
- `sort=popular`: orders by `sales_count` descending.

Default ordering is latest products. Results are paginated by 9 and preserve query string values.

## Product Detail

`HomeController@show` loads a product by slug and fetches up to four related products from the same category.

Product storefront prices are display estimates when `price_min` and `price_max` are present. Cart and checkout still use `products.price` as the transaction price.

## Session Cart

Cart state lives in the session under `cart`.

Cart item shape:

- `product_id`
- `name`
- `quantity`
- `price`
- `image`
- `category`
- `measurements`

For customizable products, measurement fields are copied from the request. The cart key becomes `{product_id}-{md5(measurements_json)}` so the same product can be ordered with different measurement sets.

## Checkout

Checkout is manual bank-transfer based in the current implementation.

Flow:

1. Customer must be authenticated and have a non-empty session cart.
2. `CheckoutController@process` validates customer name, email, phone, address, shipping cost, and courier.
3. Creates an invoice number like `JN-YYYYMMDD-RANDOM`.
4. Creates an order with `status=pending`, `payment_status=unpaid`, and `payment_method=bank_transfer`.
5. Creates order item snapshots.
6. Clears the session cart.
7. Redirects to payment instructions.
8. Customer uploads a PNG/JPG/WEBP/GIF/AVIF payment proof image up to 5 MB.
9. Order is updated to `payment_status=pending_manual_approval`.
10. Admin approves or rejects payment.

Important: stock and `sales_count` are not updated by checkout in the current code.

## Payment Approval and Order Status

Admin approval calls `Order::approve()`:

- Sets `payment_status=paid`.
- Sets `status=processing`.
- Awards loyalty points.
- Attempts WhatsApp status update.
- Attempts `OrderReceipt` email.

Admin rejection calls `Order::reject()`:

- Sets `payment_status=rejected`.
- Sets `status=cancelled`.

Admin status updates can set `status`, `tracking_number`, `shipped_at`, and `completed_at`. Status updates also attempt WhatsApp and email notifications.

## Loyalty Points

`LoyaltyService::awardPoints(Order $order)`:

- Exits if order has no user.
- Finds the user.
- Awards `floor(total_price / 10000)` points.
- Increments `users.loyalty_points`.
- Logs the award.

`deductPoints(User $user, int $points, string $reason = '')` deducts only if the user has enough points.

## Production Stages

Admins can add production stages to orders. Stage rows include:

- `order_id`
- `stage`
- `notes`
- `started_at=now()`

The tracking result page displays production stage timeline entries when present.

## CMS and Settings

`SiteSetting` backs CMS, brand, integration, localization, and payment values.

There are two update paths:

- `CMSController` validates uploaded CMS content images up to 5 MB and stores files directly under `public/assets/images/settings`.
- `Superadmin\SiteSettingController` validates uploaded brand/CMS images up to 5 MB and stores files directly under `public/assets/images/settings`.

Both write settings through `SiteSetting::set()`.

Promo settings are managed from the dedicated promo dashboard. When `promo_enabled` is active, the storefront product section displays the configured label, description, and estimate values stored in `promo_original_price` and `promo_real_price`. The promo dashboard also controls the initial storefront popup through `promo_popup_*` keys and optional announcement text through `notification_*` keys.

The CMS dashboard manages hero/about content, gallery text/images, section visibility, and a live storefront preview displayed above the content editor. Settings manage brand assets, social/footer links, SEO metadata, Open Graph/Twitter values, Google Tag Manager, Google Analytics, Google Ads, verification tags, and average-position analytics input.

## Localization

Locale is selected from the session or from `site_settings.default_language`.

Blog model accessors automatically serve English title/content/excerpt values on public pages when locale is `en`.

## Visitor Tracking

`TrackVisitors` records unauthenticated non-JSON GET requests. It stores IP address, user agent, and path in `visitors`.

## Storefront Analytics

Dashboard analytics combines two local data sources:

- `visitors` supplies traffic and impression/page-view counts.
- `analytics_events` supplies click counts from public layout click tracking.

CTR is calculated as clicks divided by impressions. Average position is a CMS/settings value (`analytics_average_position`) intended for manually entering Search Console-style SEO position data. Dashboard top traffic groups visitor paths into user-facing menu labels such as Beranda, Artikel, Produk, Kelola Konten, and Pengaturan instead of displaying raw URL paths.

## Reports

Reports are implemented in `Admin\ReportController` and reused by superadmin routes:

- Sales: paid orders in date range.
- Stock: all products, inventory value, low stock.
- Customers: user role `user`, paid-order count/sum, retention metrics.
- Finance: paid orders, gross revenue, shipping cost, net revenue.
