# 🧠 DECISIONS

## 1. Database-Driven Settings (SiteSetting)
- **Status**: Accepted
- **Context**: Relying on `.env` files makes it difficult for non-technical Superadmins to update API keys or site info.
- **Decision**: Create a `site_settings` table to store all system configurations.
- **Consequences**: `SiteSetting::get('key')` is now the primary way to fetch configurations. This adds a minor DB query overhead, which is mitigated by static caching within the model.

## 2. Premium Radius System (`rounded-[2.5rem]`)
- **Status**: Accepted
- **Context**: The default Tailwind radius (e.g., `rounded-2xl`) felt too generic for a premium handmade brand.
- **Decision**: Standardized on a very large radius (`2.5rem`) for main containers to create a soft, artisanal feel.
- **Consequences**: Requires custom Tailwind utilities or specific arbitrary values in Blade files.

## 3. Alpine.js for Dashboard Interactivity
- **Status**: Accepted
- **Context**: Full SPA (React/Vue) was deemed too complex for the current project scope, while standard jQuery/JS was too messy.
- **Decision**: Use Alpine.js for modals, sidebar toggles, and simple data binding.
- **Consequences**: Keeps the frontend lightweight and easy to maintain within Blade files.

## 4. Simplified Export System
- **Status**: Accepted
- **Context**: The project lacked complex reporting packages (e.g., Maatwebsite Excel).
- **Decision**: Use native PHP streams for CSV export and a "Printable HTML" view for PDF fallback.
- **Consequences**: Fast implementation without extra dependencies, though PDF quality depends on browser print engines.

## 5. Global Transactions Limit
- **Status**: Accepted
- **Context**: Showing 10-20 transactions on the dashboard made the UI feel cluttered.
- **Decision**: Limit global transactions to the 5 most recent items.
- **Consequences**: Cleaner dashboard, but requires a "View All" link for deeper inspection.

## 6. Migration Squashing (Clean Schema)
- **Status**: Accepted
- **Context**: Multiple "add_column" migrations were cluttering the `database/migrations` directory.
- **Decision**: Merge all column additions into their original table creation migrations.
- **Consequences**: Cleaner repository, but requires a database reset (`migrate:fresh`) for existing environments.

## 7. Dashboard KPI Centralization
- **Status**: Accepted
- **Context**: Important metrics were scattered across different modules (Sales, Inventory), requiring multiple clicks to see the full state of the business.
- **Decision**: Consolidate all critical KPI cards from all modules into the main Dashboard index.
- **Consequences**: Provides a "Command Center" experience. Module-specific pages now serve as detailed data grids rather than overview summaries.
