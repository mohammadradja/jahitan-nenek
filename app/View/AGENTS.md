# AGENTS.md

## Purpose

The `app/View` folder contains PHP-backed Blade component classes.

## Responsibilities

- Keep component classes aligned with their Blade templates.

## Rules

- Do not put page workflow logic in component classes.
- Keep component APIs simple and documented through constructor signatures.

## Best Practices

- Use components for reusable UI shells and layout primitives.

## Allowed Changes

- Component classes required by Blade components.

## Forbidden Changes

- Do not move controller responsibilities into components.

## AI Agent Instructions

- Inspect matching Blade component files before editing PHP component classes.

