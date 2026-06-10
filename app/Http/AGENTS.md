# AGENTS.md

## Purpose

The `app/Http` folder contains web request handling code.

## Responsibilities

- Route requests through controllers, middleware, and validation requests.
- Preserve user, admin, and superadmin access behavior.

## Rules

- Validate request data before persistence.
- Keep role checks consistent with `RoleMiddleware`.
- Do not rely on frontend-only validation.

## Best Practices

- Use Form Request classes for repeated validation.
- Keep controllers thin enough to read quickly.
- Return named views that exist under `resources/views`.

## Allowed Changes

- Controllers, middleware, and request validators required by a feature.
- Authorization checks that preserve existing roles.

## Forbidden Changes

- Do not expose admin/superadmin behavior to public routes.
- Do not remove authentication middleware from protected workflows.

## AI Agent Instructions

- Inspect route definitions before editing controllers.
- Check missing-view issues in `docs/TECHNICAL-DEBT.MD`.

