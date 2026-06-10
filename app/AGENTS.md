# AGENTS.md

## Purpose

The `app` folder contains first-party Laravel application code.

## Responsibilities

- Keep domain behavior, request handling, middleware, models, services, mail, providers, and view components cohesive.
- Maintain compatibility with route definitions and database schema.

## Rules

- Follow Laravel conventions and current namespace structure.
- Verify fillable fields against migrations before mass assignment changes.
- Do not move business logic across boundaries without updating docs.

## Best Practices

- Put reusable workflows in `app/Services`.
- Put database relationships and small domain methods in models.
- Put request-specific behavior in controllers and validation requests.

## Allowed Changes

- Focused application changes requested by the user.
- New classes that match existing folder responsibilities.
- Tests and docs for changed behavior.

## Forbidden Changes

- Do not add framework-level abstractions without a clear need.
- Do not bypass middleware/authorization checks.
- Do not add secrets or environment-specific values.

## AI Agent Instructions

- Inspect the relevant subfolder `AGENTS.md` before editing.
- Keep changes scoped to the feature or bug.
- Update `docs/` when behavior changes.

