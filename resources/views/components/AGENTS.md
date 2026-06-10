# AGENTS.md

## Purpose

Blade components provide reusable UI, product, blog, home, and layout fragments.

## Responsibilities

- Keep reusable templates small and compatible with parent views.

## Rules

- Define expected props clearly.
- Avoid hidden database queries in components unless already established and inexpensive.

## Best Practices

- Prefer components for repeated cards/buttons/forms.
- Keep component styling consistent with shared CSS classes.

## Allowed Changes

- New or updated reusable components.

## Forbidden Changes

- Do not make components depend on page-specific variables without props.

## AI Agent Instructions

- Search component usages before changing prop names.

