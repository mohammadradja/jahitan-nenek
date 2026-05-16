# 📋 Project Planning: Jahitan Nenek (Premium Dashboard & System)

> [!IMPORTANT]
> This planning document serves as the source of truth for all administrative and operational enhancements. All tasks follow the **Handcrafted Premium** design philosophy.

## 🛠️ Phase 1: Operational Stability (COMPLETED)
Focus: Reliability, security, and seamless API integrations.

- [x] **RajaOngkir Error Handling**: Implement robust try-catch blocks in `RajaOngkirService` to handle API downtime gracefully.
- [x] **WhatsApp Notification**: Finalize `WhatsAppService` to send real status updates for `shipped` and `completed` orders.
- [x] **Proper API & System Settings**:
    - [x] **Midtrans Expansion**: Add `midtrans_client_key` and dynamic `midtrans_base_url` configurations.
    - [x] **QRISLY Enhancements**: Add `qrisly_base_url` for real-time payment notifications.
    - [x] **Logistics (RajaOngkir)**: Implement `rajaongkir_type` selection and courier toggles.
    - [x] **API Connectivity Test**: Implement a "Test Connection" button for each API section in Superadmin.
- [x] **Email (SMTP)**: Add `mail_from_address` and full SMTP encryption settings for production-ready notifications.
- [x] **Operational Logging**: Implement robust error logging for RajaOngkir/Midtrans failures.

## ✨ Phase 2: Customer Experience (COMPLETED)
Focus: Personalization, loyalty, and transparency.

- [x] **Wishlist Feature**: Implement a "Wishlist" for registered users to save their favorite handcrafted items.
- [x] **Custom Measurement (Tailoring)**: Add input for specific products (chest, waist, hip, etc.) for a truly personalized experience.
- [x] **Production Timeline**: Develop a tracker so customers can see which stage of "Handmade" their item is in (e.g., *Selecting Yarn*, *Knitting*, *Finishing*).

## 🚀 Phase 3: Scaling & Marketing (COMPLETED)
Focus: Global reach and social commerce.

- [x] **Multi-language Support**: Implement Indonesian/English toggle for international premium appeal.
- [x] **Instagram Shopping Integration**: Generate a dynamic XML/JSON product feed for Instagram/Facebook Catalog.

## 💎 Phase 4: UI Refinement & Data Consolidation (COMPLETED)
Focus: Dashboard centralization, structural cleanup, and professional aesthetics.

- [x] **Dashboard Consolidation**: Move all KPI cards from "Penjualan" (Sales), "Inventaris" (Inventory), and other modules into the main Dashboard for a centralized command center.
- [x] **Button Standardization**: Refine all buttons across the application to be "proper" (consistent size, padding proportional to text, and matching the premium design language).
- [x] **Layout Polish**: Fix gaps and z-index issues in all sections to ensure clean layering and professional spacing.
- [x] **Pagination Standardization**: Implement a consistent, premium pagination design across all modules (Admin, Superadmin, and Public), ensuring support for query string persistence.
- [x] **Migration Squashing**: Clean up `database/migrations` by merging all "add_" migrations into their respective "create_" migrations for a cleaner schema history.
- [x] **Modular & Specific Reporting**: Expand the "Laporan" (Reports) module to be more granular (Sales, Inventory, Stock, Customers, etc.) with specific menus for each.
- [x] **Admin Profile Access**: Ensure Superadmins and Admins can manage their own profile information through a centralized route.

---

## 📊 Phase 5: Advanced Intelligence (COMPLETED)
Focus: Retention, personalization, and deep data insights.

- [x] **Loyalty Program**: Points system (1 pt / 10k IDR) implemented and visible on user dashboard.
- [x] **AI Recommendation**: Dynamic product suggestions based on user wishlist and popular trends.
- [x] **Advanced Analytics**: CLV (Customer Lifetime Value), Retention Rate, and Loyalty tracking in admin reports.

## 🎨 Phase 6: Premium UX & Language Fix (DONE)
Focus: Localization, UI cleanup, and professional aesthetics.

- [x] **Language Toggle Fix**: Robust locale switching with persistent session and SiteSetting fallback.
- [x] **Z-Index & Layout Polish**: Refactored to a stable `h-screen` layout with distinct layers (Sidebar `z-110` > Backdrop `z-100` > Topbar `z-50`).
- [x] **UI Professionalism**: Refined spacing, standardized buttons, and implemented "Handcrafted Premium" aesthetics.
- [x] **Modular Reports**: Separated Sales, Stock, Customer, and Financial reports in the sidebar for specific data analysis.
- [x] **Sidebar Toggle**: Fully functional and prominent toggle button with state-aware styling.
- [x] **SiteSetting Seeder Update**: Centralized all localization and system defaults.

## 🏁 Phase 7: System Finalization & Quality Assurance (ACTIVE)
Focus: Standardization, bug-fixing, and documentation integrity.

- [x] **UI Standardization (STRICT)**: Audited all Z-index layers and Gaps to strictly follow `DESIGN.md` tokens. Increased Guest Nav Z-index to `500` and Dashboard Sidebar to `z-[999]`.
- [x] **Guidelines Consolidation**: Updated `GUIDELINES.md` with explicit rules for layering (Sidebar MUST be `z-[999]`), spacing, and mandatory localization.
- [x] **Cross-Layout Sync**: Synchronized Dashboard and Guest layouts to use the same design logic and tokens.
- [x] **Localization Audit**: Removed hardcoded strings from ALL views (Hero, Features, Gallery, Guest, About, Contact, Blog, Dashboard), moving them to modular `lang/` files.
- [x] **Sidebar Toggle Perfection**: Implemented a fully collapsible desktop/mobile sidebar that expands the main content area when closed. Fixed Z-index layering (`z-[999]`) to ensure it always overlays content when toggled.
- [x] **Language Toggle Fix**: Refined the language switcher UI to a pill-style design and improved the route persistence.
- [ ] **Final Bug Audit**: Perform a deep check of all interactive elements (Filters, Modals, Toggles) for pixel-perfection.
