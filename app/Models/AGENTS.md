# AGENTS.md

## Purpose

Models represent database-backed domain entities and relationships.

## Responsibilities

- Keep relationships, casts, fillable fields, and domain helpers consistent with migrations and controllers.

## Rules

- Verify migrations before adding fillable fields or casts.
- Keep status/payment transitions documented.
- Be careful with model accessors that depend on request path or locale.

## Best Practices

- Prefer relationship methods over ad hoc joins in controllers.
- Keep model methods small and deterministic.
- Add tests for lifecycle methods such as order approval/payment.

## Allowed Changes

- Relationships, casts, scopes, and domain methods that match schema.
- Fillable updates after schema verification.

## Forbidden Changes

- Do not add columns only in fillable without migrations.
- Do not make loyalty awards non-idempotent in new flows.

## AI Agent Instructions

- Cross-check `docs/MODELS.MD` and `docs/DATABASE.MD` after model edits.

