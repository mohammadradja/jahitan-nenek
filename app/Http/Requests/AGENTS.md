# AGENTS.md

## Purpose

Form Request classes centralize validation and authorization for HTTP input.

## Responsibilities

- Keep validation rules explicit and aligned with database columns.

## Rules

- Use Laravel validation syntax exactly.
- Do not hide authorization requirements in controllers when a request class owns them.

## Best Practices

- Add request classes when validation is reused or complex.
- Keep user-facing validation messages translatable when adding custom messages.

## Allowed Changes

- New or updated validation rules tied to a controller change.

## Forbidden Changes

- Do not loosen auth-sensitive validation without tests.

## AI Agent Instructions

- Check tests after changing auth/profile request validation.

