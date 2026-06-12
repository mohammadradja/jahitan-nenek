# Technical Debt and Known Issues

This list documents observed implementation issues. It is not a request to change code automatically; use it to prioritize future maintenance.

## Schema and Model Mismatches

- `database/migrations/2026_05_16_125832_create_wishlists_table.php` defines `run()` instead of `up()`, so Laravel will not create the `wishlists` table.
- `Product` and `Blog` fillable arrays include `meta_keywords`, but migrations do not create `meta_keywords`.
- `Order` fillable includes `shipping_status`, but the `orders` table does not define it.
- The `orders` table defines `order_status`, but the model/controllers do not use it.
- `FeedController` queries `products.status`, but the products migration has no `status` column.

## Missing or Empty Resource Actions

- `Admin\ProductController@edit` references `admin.products.edit`, but that view is absent.
- `Admin\MeasurementController@edit` references `admin.measurements.edit`, but that view is absent.
- Several resource routes expose empty create/show/edit/store/destroy methods, especially for blogs and orders.

## Payment and Integrations

- Midtrans config and test-connection code exist, and CSRF excludes `payments/midtrans-notification`, but no matching route/controller exists.
- `PaymentTransaction` model/table exists, but checkout does not create transaction rows.
- RajaOngkir and QRISLY config/seed settings exist, but no active service/controller code was found.
- Checkout trusts `shipping_cost` and `courier` from the request.

## Order and Inventory Logic

- Checkout does not decrement product stock.
- Checkout does not increment `sales_count`.
- Loyalty point awards are not idempotent; repeated calls to `approve()` or `markAsPaid()` can award points repeatedly.
- Seeded order statuses include `paid` in `orders.status`, while runtime code treats paid as a `payment_status` value and uses order statuses like `pending`, `processing`, `shipped`, `completed`, `cancelled`.
- Dashboard pending counts use `payment_status` values `unpaid` and `pending`, but manual payment upload sets `pending_manual_approval`.

## Settings and CMS

- `SiteSetting::getTranslatabled()` appears misspelled.

## Security and Maintainability

- Several admin controllers use `$request->all()` for create/update.
- No policies are defined; authorization is mostly route-role middleware.
- Activity logging schema/model exists but no active logging calls were found.
- Staff creation validation uses `max-255` instead of `max:255`.
- `README.md` is still the default Laravel README and does not describe this project.
