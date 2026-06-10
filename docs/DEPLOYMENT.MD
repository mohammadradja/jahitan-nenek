# Deployment Requirements

## Runtime Requirements

From `composer.json` and `package.json`:

- PHP `^8.3`
- Composer
- Node.js/npm compatible with Vite 6
- Laravel 13
- A database supported by Laravel; `.env.example` defaults to SQLite
- Writable `storage` and `bootstrap/cache`
- Public storage link when serving uploaded payment proofs and CMS/brand files

## Build Steps

Recommended deployment steps:

```bash
composer install --no-dev --optimize-autoloader
npm ci
npm run build
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Run a queue worker if `QUEUE_CONNECTION` is not `sync`, especially because `.env.example` uses `QUEUE_CONNECTION=database`.

## Environment Variables

Important variables from `.env.example` and config files:

- `APP_NAME`
- `APP_ENV`
- `APP_KEY`
- `APP_DEBUG`
- `APP_URL`
- `APP_LOCALE`
- `APP_FALLBACK_LOCALE`
- `DB_CONNECTION` and related `DB_*`
- `SESSION_DRIVER`
- `QUEUE_CONNECTION`
- `CACHE_STORE`
- `FILESYSTEM_DISK`
- `MAIL_*`
- `MIDTRANS_SERVER_KEY`
- `MIDTRANS_CLIENT_KEY`
- `MIDTRANS_IS_PRODUCTION`
- `RAJAONGKIR_API_KEY`
- `QRISLY_API_KEY`
- `AWS_*` when using S3

Some integration values are also stored in `site_settings`, not only `.env`.

## Storage

Payment proofs are stored with:

```php
$file->storeAs('payment_proofs', $filename, 'public')
```

This requires:

```bash
php artisan storage:link
```

CMS uploads are currently split:

- `CMSController` writes directly to `public/assets/brand` and `public/assets/cms`.
- `Superadmin\SiteSettingController` writes to the public storage disk under `storage/app/public`.

Ensure both public paths and storage symlink strategy are supported by the deployment target.

## Database Seeding

Do not seed demo credentials in production unless they are changed immediately. `DatabaseSeeder` does not call `SiteSettingSeeder`; run it explicitly if production needs default settings:

```bash
php artisan db:seed --class=SiteSettingSeeder
```

## Operational Notes

- Disable `APP_DEBUG` in production.
- Configure mail delivery; current `.env.example` uses log mailer.
- Configure Fonnte/WhatsApp settings through site settings before enabling notifications.
- Confirm whether Midtrans is intended to be live; no notification route exists in current code.
- Configure Telescope access before enabling it outside local. The current gate allowlist is empty.

