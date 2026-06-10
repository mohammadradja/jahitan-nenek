# AGENTS.md

## Purpose

Checkout views render order creation, payment instructions, proof upload, success, and tracking.

## Responsibilities

- Keep customer payment/order status UX aligned with `CheckoutController` and `Order`.

## Rules

- Use checkout and order tracking route names.
- Keep payment proof upload form multipart and CSRF protected.
- Do not trust hidden inputs for critical financial calculations without backend validation.

## Best Practices

- Show invoice/order identifiers clearly.
- Preserve customer ownership assumptions in links/forms.

## Allowed Changes

- Checkout UI improvements and views for implemented flow changes.

## Forbidden Changes

- Do not imply online payment is live until backend integration exists.

## AI Agent Instructions

- Inspect `docs/BUSINESS-LOGIC.MD` before changing checkout views.

