# AGENTS.md

## Purpose

The `lang` folder contains translation strings for English and Indonesian.

## Responsibilities

- Keep localized UI labels and messages consistent across public and dashboard views.

## Rules

- Add keys to both `en` and `id` when used by shared views.
- Keep key names stable unless all usages are updated.

## Best Practices

- Prefer translation keys for repeated navigation and public-facing labels.
- Keep tone consistent with the Jahitan Nenek brand.

## Allowed Changes

- Translation additions and corrections.

## Forbidden Changes

- Do not remove keys without searching all Blade/PHP usages.

## AI Agent Instructions

- Use `rg \"__('\"` and `rg \"@lang\"` to find usages before renaming keys.

