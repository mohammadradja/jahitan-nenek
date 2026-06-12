# Controllers

## Public and Customer Controllers

### `HomeController`

- `index(Request)` builds product query with category eager-loading.
- Supports `search`, `category`, and `sort=popular`.
- Returns `home` with paginated products.
- `show($slug)` loads one product by slug and up to four related products from the same category.

### `BlogController`

- `index()` lists blogs with `published_at` set, newest first.
- `show($slug)` loads a blog by slug, increments `views`, and loads five other published posts.

### `CartController`

- Uses `session('cart')` as the cart store.
- `add()` stores product ID, name, quantity, price, image, category, and optional measurements.
- Customizable products use measurement fields to create a unique cart key.
- `buyNow()` adds the item and redirects to checkout.
- `update()` changes quantity when greater than zero.
- `remove()` deletes a cart entry.

### `CheckoutController`

- `index()` requires a non-empty session cart.
- `process()` validates customer/shipping fields, creates an `Order`, creates `OrderItem` rows, clears cart, and redirects to payment.
- `payment(Order)` allows the owning customer or non-user roles; shows bank transfer info.
- `uploadPaymentProof()` validates a PNG/JPG/WEBP/GIF/AVIF image up to 5 MB, stores it on the public disk, and sets `payment_status=pending_manual_approval`.
- `success()` renders the success page.
- `track()` and `trackOrder()` look up orders by internal order ID and customer email.

### `ProfileController`

- Displays and updates the authenticated user's profile via `ProfileUpdateRequest`.
- Resets `email_verified_at` when email changes.
- Deletes the authenticated user's account after password confirmation.
- Provides `verifyPassword()` JSON response for real-time password validation.

### `DashboardController`

- `user()` shows customer orders and top-selling recommendations.
- `admin()` calculates order/product/customer/revenue/stock stats, latest orders, top products, 7-day order chart data, and 30-day storefront analytics with user-facing traffic menu labels.
- `superadmin()` calculates broader stats including visitor, blog, category, average order value, 7-day visitor/click/revenue chart data, and 30-day storefront analytics with user-facing traffic menu labels.

### `AnalyticsController`

- `click()` validates a public click event payload and stores an `AnalyticsEvent` row with path, target, IP address, and user agent.

### `CMSController`

- `index()` loads all settings as `key => value` for `admin.cms.index`.
- `update()` writes CMS content/gallery settings, validates CMS image uploads up to 5 MB, stores files into `public/assets/images/settings`, handles section visibility flags, and supports JSON/AJAX responses.

### `FeedController`

- Builds an RSS/XML product feed.
- Current query filters `Product::where('status', 'published')`, but the products table does not define `status`.

## Admin Controllers

### `Admin\ProductController`

- Lists products with search/category filters.
- Creates and updates products using request validation, including the compatibility transaction `price`, estimate range fields, and required local image upload on create.
- Deletes products.
- References `admin.products.edit`, which is not present in `resources/views`.

### `Admin\CategoryController`

- Lists categories with product counts.
- Creates, edits, updates, and deletes categories through validated fields: `name`, `slug`, optional local image upload, `description`, `meta_title`, and `meta_description`.

### `Admin\OrderController`

- Lists orders with user eager-loading, search, and status filter.
- Shows an order with user, item/product, and production stage relationships.
- Updates order `status` and `tracking_number`; sets shipped/completed timestamps.
- Sends WhatsApp and email notifications in a try/catch after status updates.
- Approves manual payment through `Order::approve()`.
- Rejects manual payment through `Order::reject()`.
- Adds and deletes production stages.

### `Admin\MeasurementController`

- Lists measurements with user eager-loading.
- Creates measurements for `role=user` accounts.
- Shows, updates, and deletes measurements.
- References `admin.measurements.edit`, which is not present in `resources/views`.

### `Admin\BlogController`

- Lists all blogs with authors.
- Creates and updates localized blog content with optional local cover image uploads.
- Publishes by setting `published_at` when status is `published`; clears it for drafts.
- Deletes blogs.
- Resource create/show/edit methods are empty.

### `Admin\ReportController`

- `sales()` filters paid orders by date and calculates sales, revenue, and average ticket.
- `stock()` calculates stock counts, inventory value, and low-stock count.
- `customers()` calculates paid-order counts/sums, average customer lifetime value, retention rate, and loyal customer count.
- `finance()` calculates gross revenue, shipping cost, and net revenue for paid orders.

## Superadmin Controllers

### `Superadmin\SiteSettingController`

- Loads and updates site settings.
- Validates brand/CMS image uploads up to 5 MB and stores them under `public/assets/images/settings`.
- Serves and updates the dedicated promo dashboard, including storefront estimate display keys, popup keys, and notification keys.
- Updates SEO, metadata, Open Graph, Twitter card, Google Tag Manager, Google Analytics, verification, and analytics average-position settings.
- Tests WhatsApp by sending a Fonnte message to the configured center number.
- Tests Midtrans by posting a minimal transaction to the sandbox or production Snap token endpoint.

### `Superadmin\StaffController`

- Lists admin/superadmin users.
- Creates staff users with role `admin` or `superadmin`.
- Updates staff profile/role and optional password.
- Prevents a user from deleting their own account.

### `Superadmin\CustomerController`

- Lists `role=user` accounts with optional search.
- Exports customers as CSV.
- Provides a printable HTML "PDF fallback" view.

## Auth Controllers

Auth controllers are Breeze-style and cover login/logout, registration, password reset, password update, password confirmation, and email verification. Login throttling is implemented in `LoginRequest`.
