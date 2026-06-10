# AGENTS.md

## Purpose

Factories generate test data.

## Responsibilities

- Keep test setup deterministic and aligned with model fields.

## Rules

- Do not use real external data or credentials.
- Keep defaults valid for migrations and validation rules.

## Best Practices

- Add states for roles and lifecycle conditions.
- Use factories in tests instead of hand-building repeated data.

## Allowed Changes

- Factory updates required by tests or schema changes.

## Forbidden Changes

- Do not make factories depend on network calls.

## AI Agent Instructions

- Run tests after factory changes.

