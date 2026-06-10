# AGENTS.md

## Purpose

The `storage` folder holds runtime files, logs, cached views, sessions, and uploaded public files.

## Responsibilities

- Preserve Laravel runtime storage behavior.

## Rules

- Do not commit logs, sessions, cached views, or private runtime files.
- Do not place private data in publicly served storage.

## Best Practices

- Use `.gitignore` placeholders for runtime directories.
- Use `php artisan storage:link` for public disk serving.

## Allowed Changes

- Documentation guidance files and required placeholder files.

## Forbidden Changes

- Do not delete runtime directories needed by Laravel.
- Do not expose private uploads.

## AI Agent Instructions

- Avoid editing runtime-generated files unless explicitly requested.

