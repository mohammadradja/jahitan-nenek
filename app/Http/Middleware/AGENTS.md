# AGENTS.md

## Purpose

Middleware applies cross-cutting request behavior.

## Responsibilities

- Maintain locale selection, role authorization, and guest visitor tracking.

## Rules

- Keep middleware fast and side effects intentional.
- Do not perform heavy queries on every request without caching.
- Preserve JSON/API expectations where middleware currently checks them.

## Best Practices

- Keep role names synchronized with user seeders and docs.
- Avoid logging sensitive request data.

## Allowed Changes

- Focused middleware fixes.
- New aliases registered in `bootstrap/app.php`.

## Forbidden Changes

- Do not weaken role checks.
- Do not track authenticated users without explicit requirement.

## AI Agent Instructions

- If middleware registration changes, update `bootstrap/app.php` docs and route docs.

