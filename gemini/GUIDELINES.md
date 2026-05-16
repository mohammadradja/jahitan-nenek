# 📜 GUIDELINES

## Coding Standards
- **PHP**: Follow PSR-12 coding standards. Use type hinting for function arguments and return types where possible.
- **Blade**: Keep logic inside controllers. Views should only handle presentation. Use Alpine.js for simple UI interactivity.
- **Tailwind**: Use custom tokens defined in `tailwind.config.js`. Avoid hardcoding arbitrary values in templates.

## Naming Conventions
- **Controllers**: `[Feature]Controller.php`
- **Models**: Singular CamelCase (e.g., `SiteSetting.php`).
- **Views**: Kebab-case, organized by role/feature (e.g., `admin/products/index.blade.php`).
- **Routes**: Descriptive and grouped by role (e.g., `admin.products.index`).

## UI & Design Rules
- **Radius**: Use `rounded-[2.5rem]` for main dashboard widgets and cards.
- **Colors**: Prioritize `dark-wool` for text/bg and `soft-rose` for accents.
- **Buttons**:
    - **Large (Hero/Primary)**: `py-4.5 px-12 text-xs tracking-[0.2em] rounded-[1.5rem]`
    - **Standard (CTA/Main)**: `py-3.5 px-10 text-[11px] tracking-[0.1em] rounded-2xl`
    - **Small (Secondary)**: `py-2.5 px-6 text-[10px] tracking-[0.1em] rounded-xl`
    - **Icon Only**: `w-10 h-10 rounded-xl`
    - **Aesthetics**: Padding MUST be proportional to text. Avoid "tight" buttons. Always include hover (`-translate-y-0.5 shadow-lg`) and active (`scale-95`) states.
- **Modals**: Must be centered, use glassmorphism effects, and have a `max-w-2xl` or `max-w-4xl` width.
    - Base: `z-0` | Sidebar (Dashboard): `z-[99999]` (MUST overlay all content) | Navbar (Guest): `z-[99999]` (MUST be above all scroll animations) | Mobile Backdrop: `z-[99998]` | Modals: `z-[100000]` | Toasts: `z-[200000]`.
    - **Pro Tip**: Use `style="transform: translateZ(0); -webkit-transform: translateZ(0);"` on fixed navigation elements to ensure they maintain their stacking context over 3D-transformed scroll animations (like AOS).
- **Gap & Spacing (STRICT)**:
    - **Dashboard Grid**: Use `gap-8 md:gap-10` for main card layouts.
    - **Dashboard Cards**: Use `p-8` for desktop and `p-6` for mobile.
    - **Guest Grid**: Use `gap-12 md:gap-16` for sections and `gap-8` for product grids.
- **Sidebar Behavior**:
    - Must be fully collapsible on both mobile and desktop.
    - MUST be the topmost layer on the dashboard (`z-[99999]`).
    - On desktop, use a `fixed` positioning with a responsive padding/margin on the content area to prevent overlap unless intended.
    - Ensure the parent container of the sidebar does NOT have `relative` or `transform` if the sidebar is `fixed`, to avoid stacking context traps.
    - When hidden, the main content MUST expand to fill the entire viewport.
- **Localization**:
    - Use pill-style toggles for language switching.
    - Forbid hardcoded strings in Blade views; always use `__('messages.key')`.
- **Pagination**:
    - **Logic**: Always use `withQueryString()` in controllers to maintain filters.
    - **UI**: Use the standardized square button design (`w-11 h-11`).
    - **Persistence**: Ensure pagination remains consistent even after filtering or searching.

## Database Standards
- **Schema**: Use migrations for all schema changes.
- **Migration Squashing**: To keep the `database/migrations` directory clean, all "add_column" or "alter_table" migrations should be merged into their original "create_table" migrations before final deployment.
- **Seeding**: Use `updateOrCreate` in seeders to prevent duplicates.
- **Naming**: Tables use snake_case plural (e.g., `site_settings`). Columns use snake_case.
- **Soft Deletes**: Enable `SoftDeletes` for critical models (Products, Orders, Blogs).
- **Indexing**: Always index slugs and foreign keys used in frequent lookups.

## API Integration Standards
- **Service Encapsulation**: Third-party APIs (RajaOngkir, QRISLY, Midtrans) must be encapsulated in the `app/Services` namespace.
- **SiteSetting Integration**: Always fetch API keys via `SiteSetting::get('key')` instead of `env()`.
- **Response Format**: Use the unified JSON format for internal AJAX calls:
    ```json
    { "success": true, "message": "...", "data": { ... } }
    ```
- **Error Handling**: Implement try-catch blocks in services with logging to `failed_jobs` or `activity_logs`.

## Documentation Hierarchy & Interconnection
Before performing any task, the agent MUST review the following documentation in order:
1. [CONTEXT.md](file:///Users/macbook/Documents/jahitan-nenek/gemini/CONTEXT.md) - Project vision and background.
2. [ARCHITECTURE.md](file:///Users/macbook/Documents/jahitan-nenek/gemini/ARCHITECTURE.md) - System design and tech stack.
3. [DECISIONS.md](file:///Users/macbook/Documents/jahitan-nenek/gemini/DECISIONS.md) - Architectural Decision Records (ADR).
4. [DESIGN.md](file:///Users/macbook/Documents/jahitan-nenek/gemini/DESIGN.md) - UI/UX tokens and aesthetics.
5. [GUIDELINES.md](file:///Users/macbook/Documents/jahitan-nenek/gemini/GUIDELINES.md) - Implementation rules (this file).
6. [PLANNING.md](file:///Users/macbook/Documents/jahitan-nenek/gemini/PLANNING.md) - Current task list and roadmap.

> [!IMPORTANT]
> Always verify that your plan aligns with the **ARCHITECTURE** and **DESIGN** guidelines before execution.
