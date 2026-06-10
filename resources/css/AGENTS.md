# AGENTS.md

## Purpose

CSS source defines Tailwind layers and shared component classes.

## Responsibilities

- Maintain visual conventions and reusable utility classes.

## Rules

- Keep Tailwind class names valid.
- Do not edit built CSS in `public/build` manually.

## Best Practices

- Prefer existing classes like `btn-premium`, `input-premium`, and `card-premium`.
- Keep responsive behavior explicit in Blade/Tailwind classes.

## Allowed Changes

- Tailwind component utilities and theme refinements.

## Forbidden Changes

- Do not remove shared classes without auditing views.

## AI Agent Instructions

- Run `npm run build` after CSS changes when feasible.

