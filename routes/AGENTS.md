# AGENTS.md

## Purpose

The `routes` folder defines public, customer, admin, superadmin, auth, and console routes.

## Responsibilities

- Keep route grouping, middleware, prefixes, and route names stable.

## Rules

- Use named routes.
- Protect customer/admin/superadmin routes with appropriate middleware.
- Keep modular route files required from `web.php`.

## Best Practices

- Prefer explicit custom routes for non-CRUD actions.
- Use resource routes only when controller actions and views exist.

## Allowed Changes

- New routes for implemented controllers/views.
- Route cleanup when supported by tests and docs.

## Forbidden Changes

- Do not expose admin routes publicly.
- Do not add CSRF-exempt webhook paths without implementation and docs.

## AI Agent Instructions

- Run `php artisan route:list --except-vendor` after route changes.
- Update `docs/ROUTES.MD`.

