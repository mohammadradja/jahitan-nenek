# AGENTS.md

## Purpose

The `resources` folder contains Blade templates and source frontend assets.

## Responsibilities

- Maintain customer-facing and dashboard UI source files.

## Rules

- Keep Blade route names synchronized with route files.
- Do not put business logic-heavy database queries in views.
- Keep assets compiled through Vite.

## Best Practices

- Reuse existing components before creating new fragments.
- Keep CMS-driven values sourced from `SiteSetting`.
- Test responsive states for UI changes.

## Allowed Changes

- Blade, CSS, and JS changes requested by the user.

## Forbidden Changes

- Do not hardcode secrets or admin-only data in public views.
- Do not edit `public/build` manually for source changes.

## AI Agent Instructions

- Inspect `resources/views/AGENTS.md`, `resources/css/AGENTS.md`, or `resources/js/AGENTS.md` before edits.

