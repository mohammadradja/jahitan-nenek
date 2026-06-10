# AGENTS.md

## Purpose

Mail classes define outbound email messages.

## Responsibilities

- Keep order receipt mail rendering stable.

## Rules

- Do not include secrets or sensitive internal data in emails.
- Keep subjects and views aligned with customer-facing language.

## Best Practices

- Consider queueing mail for high-volume workflows.
- Test mailable rendering when changing email views.

## Allowed Changes

- Mailable content/view/subject changes requested by the user.

## Forbidden Changes

- Do not send emails synchronously from new bulk operations.

## AI Agent Instructions

- Inspect `resources/views/emails` with any mail class change.

