# AGENTS.md

## Purpose

The `database` folder defines schema, seed data, and factories.

## Responsibilities

- Keep migrations, seeders, factories, and model fields aligned.

## Rules

- Migrations must use `up()` and `down()`.
- Do not edit old migrations in deployed projects unless explicitly requested.
- Do not seed production secrets or permanent passwords.

## Best Practices

- Add new migrations for schema changes.
- Update model fillable/casts with schema changes.
- Add factories/tests for new persistent behavior.

## Allowed Changes

- New migrations, seeders, and factories required by features.
- Documentation-only schema notes.

## Forbidden Changes

- Do not delete existing migrations.
- Do not rely on demo seed credentials in production.

## AI Agent Instructions

- Check `docs/DATABASE.MD` and `docs/TECHNICAL-DEBT.MD` before schema work.

