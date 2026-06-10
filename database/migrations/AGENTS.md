# AGENTS.md

## Purpose

Migrations define database schema.

## Responsibilities

- Keep table definitions, foreign keys, indexes, and rollback behavior reliable.

## Rules

- Use `up()` and `down()` methods.
- Keep foreign key behavior intentional.
- Do not edit historical migrations in deployed environments without explicit approval.

## Best Practices

- Add new migrations for schema changes.
- Update related models, factories, seeders, tests, and docs.

## Allowed Changes

- New migrations for requested schema changes.

## Forbidden Changes

- Do not remove columns used by current code without migration strategy and tests.

## AI Agent Instructions

- Check `docs/DATABASE.MD` and model fillables before schema work.

