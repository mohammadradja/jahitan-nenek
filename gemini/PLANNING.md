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
- [x] **Production Timeline**: Develop a tracker so customers can see which stage of "Handmade" their item is in (e.g., _Selecting Yarn_, _Knitting_, _Finishing_).

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
- [x] **Migration Squashing**: Clean up `database/migrations` by merging all "add*" migrations into their respective "create*" migrations for a cleaner schema history.
- [x] **Modular & Specific Reporting**: Expand the "Laporan" (Reports) module to be more granular (Sales, Inventory, Stock, Customers, etc.) with specific menus for each.
- [x] **Admin Profile Access**: Ensure Superadmins and Admins can manage their own profile information through a centralized route.

---

## 📊 Phase 5: Advanced Intelligence (COMPLETED)

Focus: Retention, personalization, and deep data insights.
``

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

## 🏁 Phase 7: System Finalization & Quality Assurance (COMPLETED)

Focus: Standardization, bug-fixing, and documentation integrity.

- [x] **UI Standardization (STRICT)**: Audited all Z-index layers and Gaps to strictly follow `DESIGN.md` tokens. Increased Guest Nav Z-index to `500` and Dashboard Sidebar to `z-[999]`.
- [x] **Guidelines Consolidation**: Updated `GUIDELINES.md` with explicit rules for layering (Sidebar MUST be `z-[999]`), spacing, and mandatory localization.
- [x] **Cross-Layout Sync**: Synchronized Dashboard and Guest layouts to use the same design logic and tokens.
- [x] **Localization Audit**: Removed hardcoded strings from ALL views (Hero, Features, Gallery, Guest, About, Contact, Blog, Dashboard), moving them to modular `lang/` files.
- [x] **Sidebar Toggle Perfection**: Implemented a fully collapsible desktop/mobile sidebar that expands the main content area when closed. Fixed Z-index layering (`z-[999]`) to ensure it always overlays content when toggled.
- [x] **Language Toggle Fix**: Refined the language switcher UI to a pill-style design and improved the route persistence.
- [x] **Final Bug Audit**: Perform a deep check of all interactive elements (Filters, Modals, Toggles) for pixel-perfection.

## 💎 Phase 8: Premium UI Optimization & Collapsible Toggle Sidebar (COMPLETED)

Focus: Administrative UI adjustments, vertical border sidebar toggle, and strict button/profile refinements.

- [x] **Collapsible Sidebar (Desktop 80px Fallback)**: Upgraded sidebar so desktop collapse transitions from `280px` to a compact `80px` centered-icon bar instead of fully disappearing. Shows only clean centered emojis/icons and dynamic tooltips.
- [x] **Vertically Centered Gliding Toggle**: Implemented a floating border toggle button vertically centered (`fixed top-1/2 -translate-y-1/2`) that glides smoothly from `left: 264px` to `left: 64px` based on Alpine.js reactive bindings.
- [x] **Role-Based Profile Optimization**: Refactored the profile update forms to hide customer-specific inputs (delivery address, city ID, postal code) and account deletion widgets from Admins and Superadmins.
- [x] **Button Size & Width Standardization**: Unified small action, filter, modal, and report buttons across catalog, orders, and dashboard views with `.btn-sm` and custom `min-w-0` styles to prevent horizontal stretching.

## 📱 Phase 9: Manual Payment System, CMS integration, & Mobile Responsive Polish (COMPLETED)

Focus: Deprecation of automatic APIs, complete manual bank checkout, dynamic CMS landing page customization, and layered layout stacks.

- [x] **RajaOngkir & Payment Gateway Removal**: Deleted all automatic payment gateway webhooks, configuration options, and RajaOngkir integrations. Restructured the checkout process to be a 100% reliable manual bank transfer.
- [x] **Static Report Statistic Cards Clean up**: Removed all duplicate statistic cards from Laporan Keuangan, Laporan Penjualan, Laporan Stok, and Laporan Pelanggan so they exist solely on the central Dashboard page.
- [x] **Z-Index Layering Polish**: Added `.desktop-sidebar-toggle-btn` specific layering rules with `z-index: 2147483647 !important` and set sidebar container lower (`2147483640`) to ensure the center gliding button floats reliably in front of the sidebar border.
- [x] **Responsive Mobile Hamburger Navigation Drawer**: Fully disabled the sidebar on mobile devices and replaced it with a premium, native-app-like side-sliding navigation drawer overlay. Integrates large interactive touch links, active indicators, and a beautiful translucent glassmorphic backdrop.
- [x] **Standalone CMS Layout Boundary Fix**: Removed negative margin offsets from the CMS split viewport editor. This prevents the panel from being pulled under the fixed sidebar boundary, ensuring zero clipping or content cutoff when toggling states.
- [x] **Button Utility Design Overhaul**: Redesigned all button utility classes in `app.css` to enforce vibrant, professional color palettes (replacing boring gray border actions with custom soft-rose and pastel styles), eliminated awkward min-width constraints, and ensured 100% sizing consistency across small, standard, and large states.
- [x] **Checkout Price Field Mismatch Fix**: Whitelisted the `product_price` attribute in the `OrderItem` Eloquent model and mapped both `price` and `product_price` columns in `CheckoutController` to resolve the SQL 1364 Field 'price' doesn't have a default value exception, restoring seamless and reliable checkouts.
- [x] **2-Column Mobile Product Catalog Grid**: Optimized the guest product showcase to display in a highly efficient 2-column grid (`grid-cols-2`) on mobile devices, scaling card paddings, font sizes, heights, and hiding star reviews to maximize screen space and browsing comfort.
- [x] **Responsive Grid Mosaic Gallery**: Replaced the rigid fixed-height `h-[800px]` gallery container with a fluid `h-auto md:h-[600px] lg:h-[800px]` parent and set cards to `h-64 md:h-full`, creating a beautiful, naturally flowing stack on mobile viewports.
- [x] **Mobile Landing Navigation Access**: Enriched the public landing page mobile navigation drawer to provide seamless Dashboard and Logout options to authenticated users, resolving a severe navigation blockade for mobile customers.

### Phase 10: Advanced UX, Security, CMS Section Toggles & Admin Polish
- [x] **Transaction Receipt Display (Admin & Customer)**: Implemented payment proof receipt image previews in both the Admin's order detail view and the Customer's order tracking page.
- [x] **Eloquent User Orders Bug Fix**: Resolved the `BadMethodCallException: Call to undefined method App\Models\User::orders()` by defining the missing `orders()` has-many relationship on the `User` model.
- [x] **Polished Sales Report Button Styling**: Redesigned all search filter, reset, and export buttons in the Sales Report view with FontAwesome icons and matching vivid colors (Red-rose for PDF, Emerald-green for Excel, Soft-rose for Filters).
- [x] **Responsive Sidebar Content Breathing Room**: Shifted the dashboard content padding to `lg:pl-[300px]` (open) and `lg:pl-[100px]` (closed) to guarantee an airier 20px buffer gap that prevents overlap or clipping.
- [x] **Complex Modular CMS Toggles**: Restructured the CMS editor form into individual toggleable cards. Integrated backend boolean parsing in `CMSController.php` and conditional Blade checks in `home.blade.php` to allow turning landing sections on/off instantly.
- [x] **Admin Profile Success Toast Notifications**: Wired `ProfileController` and `PasswordController` redirects to pass standard success sessions, triggering the layout's premium slide-in toast notifications upon successful updates.
- [x] **Interactive Password Strength Meter & Field Disabler**: Integrated a client-side Alpine.js password state controller that keeps "New Password" inputs disabled until "Current Password" is typed. Displays a real-time multi-tiered password strength gauge (Lemah, Sedang, Kuat, Sangat Kuat).

## 📊 Phase 11: Dynamic Title Sync, Guest Iframe Preview, & Balanced Superadmin KPIs (COMPLETED)

Focus: Live preview precision, responsive layout toggles, global configuration binding, and balanced metrics.

- [x] **Dynamic Title & Config Sync**: Bounded the dynamic database setting `site_name` inside `AppServiceProvider.php` to the global Laravel `app.name` configuration with schema safe-guards. Upgraded browser titles in guest, public landing, and admin dashboard templates to automatically inherit values from settings.
- [x] **Guest-Mode Live Preview iframe**: Patched the CMS live preview editor in `admin/cms/index.blade.php` to load the homepage with a `?preview_as_guest=true` parameter. Updated the public layout navbar to bypass admin session UI overlays and render clean guest CTAs ("Login" & "Register") inside the editor iframe.
- [x] **Mobile Responsive CMS Preview Toggle**: Re-engineered the split CMS panel to show a high-fidelity "Editor" vs "Preview" switcher on mobile/tablet viewports, ensuring 100% full interactive preview capability on actual mobile screens. Restructured preview widths with `max-w-full` bounds to completely eliminate horizontal scrolling/overflows.
- [x] **Superadmin Balanced KPI Layout**: Extended the Superadmin Dashboard KPI system from a basic wrapping card list into a perfectly aligned 7-card two-row grid. Added highly actionable tiles for Total Orders, Asset Valuation (in IDR), and Blog & CMS active content statistics.

## 💎 Phase 12: Premium Mobile Scaling, Layering Fixes, & Duplicate Cleanups (COMPLETED)

Focus: Mobile fluid font sizes, modal z-index layering corrections, track-order route fix, duplicate controls removal, and dedicated close toggles.

- [x] **Responsive Mobile Scaling**: Normalized all static large font headings (such as `text-5xl` and `text-4xl`) on public views (home, cart, products, blog, success) and admin metric cards into fluid responsive bounds (`text-xl sm:text-2xl md:text-3xl lg:text-5xl`). This prevents awkward column wrapping and guarantees a flawless mobile experience.
- [x] **Modal z-index Layering Correction**: Removed the `z-0` stacking context restriction from the Main Content Wrapper in `layouts/dashboard.blade.php`. This allows nested edit and creation modals to correctly overlay the sidebar and topbar.
- [x] **RouteNotFoundException Resolved**: Mapped all instances of the tracking page in `WhatsAppService.php` and checkout success views to the correct registered `order.track` route name, resolving framework routing errors.
- [x] **Mobile Drawer Dedicated Close Button**: Added an elegant, circular close/cross button inside the mobile navigation menu drawer, enabling smooth, accessible drawer dismissal.
- [x] **Consolidated Sales Report Metrics**: Removed duplicate statistics grids from the Sales Report page, leaving metrics centrally governed and viewed on the main dashboards.
- [x] **Duplicate Payment Verifications Cleaned**: Removed redundant verification approval forms from the order details sidebar. The single source of truth for payment approval is now situated cleanly right beneath the uploaded receipt image.
- [x] **Removed Non-Standard Invoice Printing**: Dismissed the redundant "Cetak Invoice" action from the order details layout header.

## 🌸 Phase 13: Standardized Modal Layers, Friendly Status Badges, & Consolidated Order Workflows (COMPLETED)

Focus: Overlay z-index fixes, friendly Indonesian order status mapping, direct order tracking via GET query, and locked operational dropdown controls.

- [x] **Modal Layers Standardized Globals**: Promoted the standard Alpine-bound `<x-ui.modal>` component's z-index and all custom modals (`superadmin/staff`, `admin/categories`, `admin/blogs`, `admin/products`) to `z-[200000]`. They now render beautifully and float properly on top of all headers and side panels.
- [x] **Indonesian Status Badge Translation**: Replaced all raw snake_case database values (`pending_manual_approval`, `unpaid`, `pending`) with curated, premium Indonesian labels (`Menunggu Verifikasi Pembayaran`, `Belum Dibayar`, `Lunas`) on order details sidebar and master order tables.
- [x] **Consolidated Order Workflows**: Locked the operational status update select menu and resi tracking input form until payment is approved. If unpaid or pending verification, a highly clean, elegant descriptive locked placeholder card displays instead.
- [x] **Instant Order Tracking GET Support**: Upgraded `CheckoutController` tracking logic to accept optional GET query parameters (`order_id` and `email`), enabling direct tracking page rendering from customer history dashboards and automated WhatsApp links with one click.
- [x] **High Fidelity Visual Auditing**: Executed browser agents to audit landing pages, forms, and navigation drawer scaling on simulated mobile viewports, confirming 100% responsive precision and premium layout alignment.

## 🌸 Phase 14: Premium SweetAlert Dialogs, Purged Language Switches, Order Tracking Badges, & Structured Bank Toggle Panel (COMPLETED)

Focus: Custom SweetAlert modal triggers, removing administrative locale controls, prominent order ID indicators, bypassing nesting parent z-index boundaries, and modular Indonesian bank settings fields.

- [x] **Premium SweetAlert2 Confirmation Dialogs**: Replaced basic browser confirmation dialogs with gorgeous custom-styled, hardware-accelerated SweetAlert2 dialogs for both payment approvals ("Setujui Pembayaran") and rejections/cancellations ("Tolak / Batalkan Pesanan"), perfectly reflecting the Jahitan Nenek vintage aesthetic.
- [x] **Purged Administrative Language Switches**: Cleanly removed all English/Indonesian language toggles and flags from both Admin and Superadmin top bar layouts, keeping the administrator's working space completely clean and 100% focused on Indonesian.
- [x] **Prominent Order ID Badges**: Incorporated highly visible "ID PESANAN UNTUK LACAK: {order_id}" indicators on both the checkout payment page and tracking result layouts to let customers easily copy their tracking key for future checks.
- [x] **Bypassed Stacking Context Modal Lock**: Solved the lingering modal overlay layering bug by isolating CSS animations to a child wrapper inside the scrollable `<main>` area and removing inline 3D hardware-acceleration transform rules (`translateZ`) from the sidebar. High z-index overlays now float beautifully on top of headers and side panels.
- [x] **Modular Bank Transfer Input Grid**: Replaced the error-prone bank transfer raw textarea with a stunning togglable input panel for popular banks (BCA, Mandiri, BNI, BRI, BSI) inside `/superadmin/settings`. Admins can enable specific banks, input account numbers and names in separate fields, and submit to compile into a fully backwards-compatible format.
- [x] **Integrated Visual Verification**: Ran a full-scale browser agent validation to confirm flawless rendering, layout responsiveness, and modal stacking integrity across all administrative pages.

