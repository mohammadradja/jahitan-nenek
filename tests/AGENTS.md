# AGENTS.md

## Purpose

The `tests` folder contains PHPUnit feature and unit tests.

## Responsibilities

- Protect auth, profile, storefront, checkout, admin, and integration behavior.

## Rules

- Use `RefreshDatabase` for database-dependent feature tests.
- Keep tests deterministic and avoid real external API calls.

## Best Practices

- Fake notifications, mail, HTTP, and queues for external effects.
- Add regression tests for every fixed bug.
- Cover role authorization and order/payment lifecycle changes.

## Allowed Changes

- New or updated tests tied to code changes.

## Forbidden Changes

- Do not weaken assertions to hide failures.
- Do not require real credentials for tests.

## AI Agent Instructions

- Run `php artisan test` after test or application changes when feasible.

