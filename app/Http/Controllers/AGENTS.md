# AGENTS.md

## Purpose

Controllers orchestrate requests, validation, model queries, services, and Blade responses.

## Responsibilities

- Keep storefront, checkout, profile, dashboard, admin, superadmin, and auth flows working.
- Redirect with named routes and session messages where existing code does.

## Rules

- Validate input before create/update.
- Use eager loading when views need relationships.
- Keep route model binding behavior consistent with route parameters.

## Best Practices

- Extract repeated integration calls to services.
- Avoid broad `$request->all()` in new code; prefer validated arrays.
- Keep notification failures non-fatal when existing behavior expects that.

## Allowed Changes

- Focused controller methods and helper extraction.
- New controllers for new route groups.

## Forbidden Changes

- Do not silently alter order/payment status semantics.
- Do not remove customer ownership checks.
- Do not add views names that do not exist.

## AI Agent Instructions

- Cross-check controller-returned views with `resources/views`.
- For order changes, also inspect `Order`, `LoyaltyService`, `WhatsAppService`, and order views.

