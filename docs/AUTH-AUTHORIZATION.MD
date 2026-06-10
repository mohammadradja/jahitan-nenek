# Authentication and Authorization

## Authentication

Authentication is Breeze-style and uses Laravel's `web` guard.

Implemented routes/controllers cover:

- Registration.
- Login/logout.
- Forgot password and reset password.
- Password confirmation.
- Password update.
- Email verification.

Login throttling is implemented in `App\Http\Requests\Auth\LoginRequest` with 5 attempts per email/IP throttle key.

## User Roles

Roles are stored as strings in `users.role`.

Current roles:

- `user`
- `admin`
- `superadmin`

Default role in the migration is `user`.

## Authorization Model

Authorization is route middleware based.

`RoleMiddleware` checks:

```php
if (!$request->user() || !in_array($request->user()->role, $roles)) {
    abort(403, 'Unauthorized action.');
}
```

Protected route groups:

- Customer routes: `auth`, `role:user,admin,superadmin`.
- Admin routes: `auth`, `role:admin,superadmin`.
- Superadmin routes: `auth`, `role:superadmin`.
- Dashboard redirect route: `auth`, `verified`.

No model policies were found. No authorization gates were found except Telescope's `viewTelescope` gate, whose allowlist is empty.

## Ownership Checks

Checkout payment/proof pages explicitly restrict customer users:

- If the order does not belong to the current user and the current role is `user`, abort 403.
- Admin and superadmin users can view/upload payment proof for any order through this path.

Public order tracking uses order ID and customer email. It does not require authentication.

## Security Considerations

- Uploaded payment proof must be an image and max 2 MB.
- Session cart operations are authenticated because customer routes are protected.
- `shipping_cost` and `courier` are trusted from the checkout request.
- Admin CRUD controllers frequently use `$request->all()`.
- Seeded demo passwords should never be used in production.
- `payments/midtrans-notification` is excluded from CSRF checks, but no route currently handles it.

