# AGENTS.md

## Purpose

Blade views render the public storefront, auth screens, dashboards, admin pages, emails, and errors.

## Responsibilities

- Keep UI routes, variables, components, and localization keys correct.

## Rules

- Ensure every controller-returned view exists.
- Escape output by default with Blade `{{ }}`.
- Keep forms protected with `@csrf` and method spoofing where needed.

## Best Practices

- Use existing layouts and components.
- Use translation keys for repeated public text when practical.
- Keep Alpine interactions local and readable.

## Allowed Changes

- New or updated Blade views for implemented routes.
- Component extraction when it reduces duplication.

## Forbidden Changes

- Do not introduce queries that belong in controllers.
- Do not remove payment/order status indicators without updating flows.

## AI Agent Instructions

- Cross-check controller compact variables before editing a view.
- Update `docs/VIEWS-FRONTEND.MD` for structural UI changes.

