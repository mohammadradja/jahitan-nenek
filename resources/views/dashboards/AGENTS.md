# AGENTS.md

## Purpose

Dashboard views render customer, admin, and superadmin summaries and navigation partials.

## Responsibilities

- Keep dashboard metrics and links aligned with `DashboardController` and route groups.

## Rules

- Use role-appropriate route names.
- Do not compute heavy metrics in views when controllers can provide them.

## Best Practices

- Keep chart data generated server-side or passed explicitly.
- Preserve sidebar/topbar partial compatibility.

## Allowed Changes

- Dashboard UI changes and metric display updates.

## Forbidden Changes

- Do not expose superadmin reports to lower roles.

## AI Agent Instructions

- Cross-check dashboard controller variables before editing.

