# AGENTS.md

## Purpose

JavaScript source bootstraps Axios and Alpine.js.

## Responsibilities

- Maintain lightweight client interactions.

## Rules

- Keep Alpine available globally if views depend on it.
- Keep Axios CSRF/AJAX defaults intact.

## Best Practices

- Prefer small Alpine components in views for page-specific interactions.
- Move repeated JS behavior into source files only when reused.

## Allowed Changes

- JS needed for UI behavior or API calls.

## Forbidden Changes

- Do not introduce a frontend framework migration without explicit request.

## AI Agent Instructions

- Run `npm run build` after JS changes when feasible.

