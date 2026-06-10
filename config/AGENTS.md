# AGENTS.md

## Purpose

The `config` folder defines framework and integration configuration.

## Responsibilities

- Keep environment-driven settings clear and deployable.

## Rules

- Use `env()` only in config files.
- Do not hardcode production secrets.
- Keep new config documented in deployment docs.

## Best Practices

- Prefer config values for static environment settings.
- Prefer `SiteSetting` for CMS/runtime admin-editable settings.

## Allowed Changes

- New config keys for real features.
- Environment template updates when required.

## Forbidden Changes

- Do not commit secret keys.
- Do not change defaults in ways that break local setup without documentation.

## AI Agent Instructions

- Update `docs/DEPLOYMENT.MD` and `.env.example` together when adding required env vars.

