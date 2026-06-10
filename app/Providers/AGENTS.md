# AGENTS.md

## Purpose

Providers bootstrap framework-level behavior.

## Responsibilities

- Maintain app-wide pagination, dynamic app name setting, and Telescope registration.

## Rules

- Keep provider boot code safe during migrations and fresh installs.
- Avoid expensive startup work.

## Best Practices

- Wrap database-dependent boot logic defensively.
- Keep Telescope access explicit in non-local environments.

## Allowed Changes

- Provider registration and bootstrapping required by a feature.

## Forbidden Changes

- Do not expose Telescope broadly in production.

## AI Agent Instructions

- Update deployment docs when provider behavior affects runtime requirements.

