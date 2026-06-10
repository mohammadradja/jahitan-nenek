# Models and Relationships

## `User`

Location: `app/Models/User.php`

Purpose: authenticated account and profile record.

Important fields: `name`, `email`, `password`, `role`, `phone`, `address`, `province_id`, `city_id`, `postal_code`, `loyalty_points`.

Relationships:

- `measurements()` has many `Measurement`.
- `activityLogs()` has many `ActivityLog`.
- `orders()` has many `Order`.

Notes:

- Uses PHP attributes for fillable/hidden fields.
- Casts `password` as `hashed` and `email_verified_at` as datetime.

## `Product`

Purpose: storefront catalog item.

Relationships:

- `category()` belongs to `Category`.
- `reviews()` has many `ProductReview`.

Notes:

- Uses Laravel Scout `Searchable`, but controllers currently use SQL `like` searches.
- Fillable includes `meta_keywords`, but the migration does not create a `meta_keywords` column.
- No `status` column exists, but `FeedController` queries `Product::where('status', 'published')`.

## `Category`

Purpose: product grouping.

Relationships:

- `products()` has many `Product`.

Notes:

- Fillable fields are aligned with the migration: `name`, `slug`, `image_url`, `description`, `meta_title`, and `meta_description`.

## `Order`

Purpose: order header and lifecycle state.

Relationships:

- `productionStages()` has many `ProductionStage`.
- `paymentTransactions()` has many `PaymentTransaction`.
- `user()` belongs to `User`.
- `items()` has many `OrderItem`.

Domain methods:

- `isPaid()` checks `payment_status === 'paid'`.
- `markAsPaid()` sets `payment_status=paid`, `status=processing`, and awards loyalty points.
- `markAsShipped()` sets `status=shipped`.
- `markAsCancelled()` sets `status=cancelled` and `payment_status=cancelled`.
- `approve()` sets `payment_status=paid`, `status=processing`, and awards loyalty points.
- `reject()` sets `payment_status=rejected` and `status=cancelled`.

Notes:

- `shipping_status` is fillable but does not exist in the migration.
- `order_status` exists in the migration but is not fillable or used in controllers.
- Loyalty points can be awarded by both `markAsPaid()` and `approve()`; avoid calling both for the same order unless idempotency is added.

## `OrderItem`

Purpose: line-item snapshot for an order.

Relationships:

- `order()` belongs to `Order`.
- `product()` belongs to `Product`.

Notes:

- Casts `measurements` as an array.
- Stores both live `product_id` and snapshot fields (`product_name`, `product_price`, `price`, `subtotal`).

## `Blog`

Purpose: blog article with localized fields.

Relationships:

- `author()` belongs to `User` using `author_id`.

Accessors:

- `getTitleAttribute()`
- `getContentAttribute()`
- `getExcerptAttribute()`

These return English values on public pages when locale is `en` and fallback values otherwise. Admin/superadmin paths always receive the base values.

Notes:

- Uses Laravel Scout `Searchable`.
- Fillable includes `meta_keywords`, but the migration does not create that column.

## `SiteSetting`

Purpose: key/value settings for CMS, localization, payment, logistics, brand assets, and integrations.

Methods:

- `get($key, $default = null)`
- `set($key, $value, $type = 'string', $group = 'general')`
- `getTranslatabled($key, $default = null)`

Notes:

- `value` is cast as JSON. Keep all writes through the model helper to keep encoding consistent.
- `getTranslatabled` appears to be a typo, but it is the existing method name.

## Supporting Models

| Model | Purpose | Relationships |
| --- | --- | --- |
| `Measurement` | Body measurements for customization. | belongs to `User`. |
| `ProductReview` | User review and rating for a product. | belongs to `User`, belongs to `Product`. |
| `ProductionStage` | Manual timeline entry for an order. | belongs to `Order`. |
| `PaymentTransaction` | Payment gateway transaction record. | belongs to `Order`. |
| `ActivityLog` | Generic user/system activity log. | belongs to `User`, morphs to `subject`. |
| `Visitor` | Guest visitor record. | none. |
