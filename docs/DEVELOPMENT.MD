# Development Conventions

## Local Setup

Typical setup from the repository root:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run dev
```

The Composer `setup` script runs install, `.env` creation, key generation, forced migration, npm install, and Vite build.

The Composer `dev` script runs Laravel server, queue listener, pail logs, and Vite concurrently.

## Code Style

Available tooling:

- `vendor/bin/pint` through `laravel/pint`.
- `php artisan test`.
- `npm run build`.
- `npm run dev`.

Follow existing Laravel conventions:

- Keep controller methods focused on request orchestration.
- Move reusable external API logic into `app/Services`.
- Keep Eloquent relationship names consistent with model names.
- Prefer Form Request classes for validation that is reused or grows complex.
- Use route names in redirects and links.
- Update migrations and models together when adding columns.
- Update docs and `AGENTS.md` files when changing architecture or conventions.

## Data and State Conventions

- User roles are string values.
- Order lifecycle currently uses `orders.status`.
- Payment lifecycle currently uses `orders.payment_status`.
- Cart state is session-based.
- CMS/settings state is database-backed through `site_settings`.
- Uploaded payment proofs use the public storage disk.

## Frontend Conventions

- Use Blade and Tailwind utility classes.
- Shared component styles live in `resources/css/app.css`.
- Alpine is the default lightweight interaction layer.
- Public layout currently uses external CDNs for icons, fonts, animation, and AOS.
- Prefer existing Blade components under `resources/views/components` before creating new UI fragments.

## Documentation Conventions

- Every substantial code change should update the relevant doc in `docs/`.
- Document observed behavior, not intended behavior.
- If a known issue is fixed, remove or update it in `TECHNICAL-DEBT.MD`.

