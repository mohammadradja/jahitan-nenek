# AGENTS.md

## Purpose

PHP component classes for application and guest layouts.

## Responsibilities

- Render layout components used by Breeze-style views.

## Rules

- Keep render methods pointed at existing Blade views.

## Best Practices

- Keep layout component classes minimal.

## Allowed Changes

- Layout component adjustments required by view changes.

## Forbidden Changes

- Do not add business logic here.

## AI Agent Instructions

- Cross-check `resources/views/layouts` before changing render targets.

