# AGENTS.md

## Purpose

The `public` folder is the web root for the Laravel application.

## Responsibilities

- Serve `index.php`, static assets, uploaded public files, and built frontend output.

## Rules

- Do not edit generated Vite build output manually.
- Do not store private files in public paths.
- Preserve uploaded asset paths used by CMS/settings.

## Best Practices

- Use `storage/app/public` plus `php artisan storage:link` for user uploads where possible.
- Keep brand/product assets organized.

## Allowed Changes

- Static assets requested by the user.
- Documentation guidance files.

## Forbidden Changes

- Do not add secrets, backups, or private documents.
- Do not remove `public/index.php`.

## AI Agent Instructions

- Be aware there is an existing untracked `public/assets/brand/` path; do not delete it.

