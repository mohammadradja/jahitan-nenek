# AGENTS.md

## Purpose

Auth views render login, register, password, and email verification screens.

## Responsibilities

- Keep Breeze-style auth forms compatible with auth controllers and requests.

## Rules

- Preserve CSRF tokens.
- Keep input names aligned with auth request validation.

## Best Practices

- Use existing UI components for fields and errors.
- Keep redirects/status messages consistent with controllers.

## Allowed Changes

- Auth UI copy and layout changes that preserve form behavior.

## Forbidden Changes

- Do not remove password confirmation or email verification affordances without backend changes.

## AI Agent Instructions

- Run auth feature tests after changes.

