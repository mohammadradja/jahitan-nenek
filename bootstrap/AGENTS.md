# AGENTS.md

## Purpose

The `bootstrap` folder configures Laravel startup, middleware, routing, and provider loading.

## Responsibilities

- Preserve route registration and middleware configuration.

## Rules

- Register route files intentionally.
- Keep CSRF exceptions documented and justified.

## Best Practices

- Use middleware aliases for reusable route protection.
- Avoid application-specific business logic in bootstrap files.

## Allowed Changes

- Middleware/provider/routing registration changes needed by a feature.

## Forbidden Changes

- Do not remove existing route modules accidentally.
- Do not add CSRF exceptions without a matching endpoint and docs.

## AI Agent Instructions

- If `bootstrap/app.php` changes, inspect all route files and update `docs/ARCHITECTURE.MD`.

