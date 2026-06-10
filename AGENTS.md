# AGENTS.md

## Purpose

Guide AI agents and developers working in the Jahitan Nenek Laravel application.

## Responsibilities

- Preserve the storefront, customer, admin, and superadmin workflows.
- Keep documentation in `docs/` synchronized with implementation.
- Respect existing Laravel, Blade, Tailwind, Alpine, and Eloquent patterns.
- Treat `routes/*.php`, `database/migrations/*.php`, and `app/Models/*.php` as primary sources for behavior.

## Rules

- Inspect implementation before changing or documenting behavior.
- Do not modify application code when the task is documentation-only.
- Use route names and existing helpers where possible.
- Keep roles as `user`, `admin`, and `superadmin` unless a full authorization migration is requested.
- Update relevant docs and local `AGENTS.md` files after architectural changes.

## Best Practices

- Prefer Form Request validation for reusable or growing validation logic.
- Prefer services for external API calls and cross-controller workflows.
- Keep controllers focused on request handling and orchestration.
- Add tests for checkout, order lifecycle, role access, and integrations before risky changes.

## Allowed Changes

- Documentation updates.
- Focused Laravel code changes requested by the user.
- Tests that protect changed behavior.
- Migrations only when schema changes are required and documented.

## Forbidden Changes

- Do not delete user changes or reset the git worktree.
- Do not introduce unverified business rules.
- Do not commit secrets or read local `.env` values into docs.
- Do not change production credentials, seeded credentials, or app code during documentation tasks.

## AI Agent Instructions

- Start in `docs/README.md` for project context.
- Check `docs/TECHNICAL-DEBT.MD` before touching known fragile areas.
- For route changes, inspect `routes/web.php` and included route files.
- For schema changes, inspect migrations and model fillables/casts together.
- Keep final summaries concise and list verification commands run.

