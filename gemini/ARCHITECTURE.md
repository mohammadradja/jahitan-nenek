# 🏗️ ARCHITECTURE

## System Overview
Before diving into the architecture, ensure you understand the [CONTEXT](file:///Users/macbook/Documents/jahitan-nenek/gemini/CONTEXT.md) and [GUIDELINES](file:///Users/macbook/Documents/jahitan-nenek/gemini/GUIDELINES.md). Major architectural shifts are recorded in [DECISIONS](file:///Users/macbook/Documents/jahitan-nenek/gemini/DECISIONS.md).

## Tech Stack
- **Framework**: Laravel 13.x (PHP 8.3+)
- **Frontend Logic**: Alpine.js (Lightweight reactive components)
- **Styling**: Tailwind CSS (Utility-first, customized for premium aesthetic)
- **Database**: MySQL / SQLite (Development)
- **Payments**: Midtrans & QRISLY
- **Logistics**: RajaOngkir (Integrated via Service Layer)

## System Design
The project follows a modular Laravel architecture with clear separation of concerns.

### 1. Controllers
- **Public**: Handles landing page, product catalog, and checkout.
- **Admin**: Manages inventory, orders, and blogs.
- **Superadmin**: Handles site settings, staff management, and global reports.

### 2. Service Layer (`app/Services`)
Business logic for third-party integrations is encapsulated in services:
- `RajaOngkirService`: Shipping cost calculations and tracking.
- `QrislyService`: QRIS payment generation.
- `MidtransService`: Gateway integration.

### 3. Settings System (`SiteSetting`)
Instead of relying solely on `.env` files, the platform uses a `SiteSetting` model and table to store dynamic configurations (API Keys, SEO meta, general site info). This allows Superadmins to update the system without code changes.

### 4. Layout System
- `layouts.app`: Main public layout.
- `layouts.dashboard`: Shared layout for Admin and Superadmin with a collapsible sidebar.

### 5. Authentication & Authorization
- Powered by Laravel Breeze.
- Custom middleware for role-based access (`superadmin`, `admin`, `user`).

### 6. Modular Reporting System
The reporting architecture is split into specific, granular domains:
- **Sales Reports**: Transaction volume, revenue, and trends.
- **Inventory Reports**: Product movement, stock levels, and low-stock alerts.
- **Customer Reports**: Acquisition, geographic distribution, and behavior.
- **Financial Reports**: Payment gateway settlements and manual approvals.

## Data Flow & Consolidation
1. **Consolidated Dashboard**: The main dashboard controllers (`DashboardController`) aggregate data from multiple models (Order, Product, Visitor) to provide a unified "Command Center" view.
2. **Request Handling**: Handled by Laravel Routing.
3. **Middleware**: Validates user role and authentication.
4. **Controller**: Fetches data from Models, uses Services for external APIs.
5. **View**: Renders Blade templates with Alpine.js for interactivity.
