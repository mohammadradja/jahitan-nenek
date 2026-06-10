# AGENTS.md

## Purpose

Seeders populate development/demo data and default settings.

## Responsibilities

- Provide safe, realistic local data without leaking secrets.

## Rules

- Do not seed real API keys or production credentials.
- Keep seed order aligned with foreign key dependencies.

## Best Practices

- Use idempotent seeders for default records when practical.
- Document demo credentials clearly if they remain.

## Allowed Changes

- New seed data required for development or tests.

## Forbidden Changes

- Do not rely on seeded passwords for production access.

## AI Agent Instructions

- Update `docs/DATABASE.MD` when seed behavior changes.

