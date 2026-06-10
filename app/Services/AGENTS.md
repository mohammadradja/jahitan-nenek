# AGENTS.md

## Purpose

Services hold reusable business workflows and external API calls.

## Responsibilities

- Maintain loyalty point logic and WhatsApp/Fonnte messaging.
- Keep integration failures logged and safe for controllers.

## Rules

- Read integration settings through `SiteSetting` or config consistently.
- Do not throw user-facing failures from notification helpers unless requested.
- Avoid embedding real secrets.

## Best Practices

- Inject dependencies in new services when complexity grows.
- Keep API timeouts explicit.
- Log enough context for operations without exposing credentials.

## Allowed Changes

- Integration improvements.
- New services for Midtrans/RajaOngkir/QRISLY if those features are implemented.

## Forbidden Changes

- Do not make external API calls from Blade views.
- Do not store tokens in source code.

## AI Agent Instructions

- Update `docs/SERVICES-INTEGRATIONS.MD` after service changes.

