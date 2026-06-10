# AGENTS.md

## Purpose

Admin Blade views render catalog, order, measurement, blog, CMS, and report screens.

## Responsibilities

- Keep admin forms, tables, filters, and order/payment controls aligned with admin controllers.

## Rules

- Use `admin.*` route names.
- Include CSRF tokens and method spoofing for non-GET actions.
- Do not expose superadmin-only controls unless routes allow them.

## Best Practices

- Keep status labels synchronized with controller/model status values.
- Reuse dashboard layout and shared classes.

## Allowed Changes

- Admin views for implemented controller actions.

## Forbidden Changes

- Do not add forms for controller methods that do not exist.

## AI Agent Instructions

- Check missing edit view issues before adding links to edit routes.

