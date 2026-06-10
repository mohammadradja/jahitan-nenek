# Services and Integrations

## `LoyaltyService`

Location: `app/Services/LoyaltyService.php`

Responsibilities:

- Award loyalty points based on paid/approved order total.
- Deduct loyalty points when explicitly called.
- Write log entries for point changes.

Formula: one point per Rp 10,000 of `orders.total_price`.

Current callers:

- `Order::markAsPaid()`
- `Order::approve()`

## `WhatsAppService`

Location: `app/Services/WhatsAppService.php`

Responsibilities:

- Read Fonnte-style WhatsApp settings from `SiteSetting`.
- Send a message with `Authorization` header to configured `whatsapp_base_url`.
- Send order status update messages in Indonesian.

Settings used:

- `whatsapp_api_token`
- `whatsapp_base_url`
- `whatsapp_enabled`
- `whatsapp_number` for connection tests

Current callers:

- `Admin\OrderController@update`
- `Admin\OrderController@approve`
- `Superadmin\SiteSettingController@testConnection`

## Mail

`app/Mail/OrderReceipt.php` sends `resources/views/emails/order-receipt.blade.php`.

Subject format:

```text
Konfirmasi Pesanan #{invoice_number}
```

Current callers:

- `Admin\OrderController@update`
- `Admin\OrderController@approve`

The current implementation sends synchronously, not queued.

## Midtrans

Configuration exists in:

- `config/midtrans.php`
- `composer.json` dependency `midtrans/midtrans-php`
- `SiteSettingSeeder` settings
- `Superadmin\SiteSettingController@testConnection`

Current active behavior:

- Superadmin/admin settings can test connection by requesting a Snap token.
- `bootstrap/app.php` excludes `payments/midtrans-notification` from CSRF validation.

No route/controller for an actual Midtrans notification endpoint was found. Current checkout uses manual bank transfer proof upload.

## RajaOngkir and QRISLY

`config/services.php` contains settings for:

- `rajaongkir`
- `qrisly`

`SiteSettingSeeder` also defines related settings.

No controllers/services were found that call RajaOngkir or QRISLY APIs in the current implementation.

## Laravel Scout

`Product` and `Blog` use the `Searchable` trait. Current controllers perform SQL searches and do not call Scout search APIs.

## Telescope

Telescope is registered through `TelescopeServiceProvider`.

Behavior:

- Local environment records all entries.
- Non-local records reportable exceptions, failed requests, failed jobs, scheduled tasks, and monitored tags.
- Sensitive request parameters/headers are hidden outside local.
- `viewTelescope` gate has an empty email allowlist.

