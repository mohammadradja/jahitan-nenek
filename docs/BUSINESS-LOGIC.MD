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
8. Customer uploads a payment proof image.
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

- `CMSController` stores uploaded brand/CMS files directly under `public/assets/brand` and `public/assets/cms`.
- `Superadmin\SiteSettingController` stores uploaded brand/CMS files on the `public` disk under `storage/app/public`.

Both write settings through `SiteSetting::set()`.

## Localization

Locale is selected from the session or from `site_settings.default_language`.

Blog model accessors automatically serve English title/content/excerpt values on public pages when locale is `en`.

## Visitor Tracking

`TrackVisitors` records unauthenticated non-JSON requests. It stores IP address, user agent, and path in `visitors`.

## Reports

Reports are implemented in `Admin\ReportController` and reused by superadmin routes:

- Sales: paid orders in date range.
- Stock: all products, inventory value, low stock.
- Customers: user role `user`, paid-order count/sum, retention metrics.
- Finance: paid orders, gross revenue, shipping cost, net revenue.

