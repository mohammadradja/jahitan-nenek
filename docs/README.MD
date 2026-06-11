# Jahitan Nenek Documentation

This documentation was generated from the implementation in this repository. Treat the codebase as the source of truth and update these files whenever behavior changes.

## Project Summary

Jahitan Nenek is a Laravel storefront and operations dashboard for handmade stitched garments and brocade clothing. It includes:

- Public product catalog, blog, locale switcher, order tracking, and Instagram/Google-style product feed.
- Authenticated customer dashboard, profile management, session cart, checkout, manual bank-transfer proof upload, and order history.
- Admin dashboard for products, categories, orders, measurements, blogs, CMS settings, and reports.
- Superadmin dashboard for site settings, CMS settings, reports, staff management, and customer exports.
- Supporting services for loyalty points, WhatsApp/Fonnte notifications, mail receipts, visitor tracking, localization, and Telescope diagnostics.

## Documentation Index

- [Architecture](ARCHITECTURE.MD)
- [Folder Structure](FOLDER-STRUCTURE.MD)
- [Database Structure](DATABASE.MD)
- [Models and Relationships](MODELS.MD)
- [Routes](ROUTES.MD)
- [Controllers](CONTROLLERS.MD)
- [Views and Frontend](VIEWS-FRONTEND.MD)
- [Business Logic](BUSINESS-LOGIC.MD)
- [Authentication and Authorization](AUTH-AUTHORIZATION.MD)
- [Services and Integrations](SERVICES-INTEGRATIONS.MD)
- [Development Conventions](DEVELOPMENT.MD)
- [Deployment Requirements](DEPLOYMENT.MD)
- [Testing](TESTING.MD)
- [Technical Debt and Known Issues](TECHNICAL-DEBT.MD)
- [Diagrams](DIAGRAMS/SYSTEM-OVERVIEW.MD)

## Quick Maintenance Rules

- Do not document assumptions as facts. Verify behavior in the relevant PHP, Blade, route, migration, or config file first.
- Keep route, schema, and model docs synchronized with `routes/*.php`, `database/migrations/*.php`, and `app/Models/*.php`.
- The application currently uses string roles (`user`, `admin`, `superadmin`) and route middleware rather than policies.
- The active checkout implementation uses manual bank transfer proof uploads; Midtrans exists as configuration/test-connection support but no live notification route is implemented.
- Review [Technical Debt and Known Issues](TECHNICAL-DEBT.MD) before changing related areas.
