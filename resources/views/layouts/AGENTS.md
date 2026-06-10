# AGENTS.md

## Purpose

Layouts define shared page shells for public, dashboard, guest, and navigation views.

## Responsibilities

- Maintain global navigation, footer, asset loading, toasts, and layout slots/sections.

## Rules

- Keep `@vite` inputs valid.
- Preserve CSRF meta tag where forms/AJAX rely on it.
- Avoid database-heavy repeated calls in global layout changes.

## Best Practices

- Use `SiteSetting` for CMS-driven brand values.
- Keep mobile and desktop nav behavior synchronized.

## Allowed Changes

- Layout updates needed by design or route changes.

## Forbidden Changes

- Do not remove global toast/session message handling without replacement.

## AI Agent Instructions

- Test public and dashboard pages after layout edits.

