# Testing

## Current Test Coverage

Tests are located in `tests`.

Feature coverage includes:

- Public home page smoke test.
- Settings value compatibility, dedicated promo setting updates, and click analytics event recording.
- Registration.
- Login/logout.
- Password reset.
- Password update.
- Password confirmation.
- Email verification.
- Profile display/update/delete.

Unit coverage currently contains only the default true assertion.

## Test Configuration

`phpunit.xml` sets:

- `APP_ENV=testing`
- SQLite in-memory database
- `MAIL_MAILER=array`
- `QUEUE_CONNECTION=sync`
- `SESSION_DRIVER=array`
- Telescope disabled

## Running Tests

```bash
php artisan test
```

Composer wrapper:

```bash
composer test
```

## Recommended New Tests

Add coverage for:

- Cart add/update/remove behavior, including customizable measurement keys.
- Checkout order and item creation.
- Payment proof upload authorization and validation.
- Admin approve/reject order behavior and loyalty point awards.
- Order status updates and production stage creation/deletion.
- Role middleware access for user/admin/superadmin routes.
- CMS setting update behavior and file upload paths.
- Blog localization accessors.
- Report calculations.
- Visitor tracking middleware.
- Missing integration boundaries, especially Midtrans if implemented.
