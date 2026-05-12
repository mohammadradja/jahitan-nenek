# System Architecture: Jahitan Nenek

This document outlines the structural and logical foundations of the Jahitan Nenek platform.

## 🛠️ Technology Stack

- **Framework**: Laravel 11
- **Styling**: Utility-First Tailwind CSS (Bespoke Design System)
- **Dashboard Layout**: Collapsible Sidebar Architecture with Alpine.js state management.
- **Interactivity**: Alpine.js (Modal-based CRUD, Dynamic UI States, Sidebar Toggle)
- **Database**: MySQL
- **Cache & Queue**: Redis
- **Analytics**: Chart.js for data visualization (Visitor & Revenue tracking)
- **Tracking**: Custom Visitor Tracking Middleware (IP, Path, User Agent)
- **Payments**: Midtrans Integration (Snap & Dynamic Notification Webhooks)
- **Logistics**: RajaOngkir API (Real-time shipping calculation)
- **Notifications**:
    - **WhatsApp**: Fonnte/Wablas (Order & Shipment updates)
    - **Email**: Mailgun/SMTP (Transactional receipts)
- **Authentication**: Laravel Breeze (Overhauled with Premium Split-Screen UI)
- **Monitoring**: Laravel Telescope / Sentry / Pulse
- **Background Jobs**: Laravel Queue + Horizon

# 🛣️ Routing Strategy

The application uses modular route files located in `routes/` to maintain clarity and separation of concerns:

- `web.php`: Public routes (Home, Gallery, Blog, Auth).
- `customer.php`: Standard e-commerce profile, Cart, and Order Tracking.
- `admin.php`: Operational management (Orders, Products, Categories, Blogs).
- `superadmin.php`: Global system configuration, Staff Management, and comprehensive Business Reports.
- `api.php`: Public and internal API endpoints (`/api/v1`).

---

# 🧱 Application Layer Architecture

The application follows a layered architecture pattern to improve maintainability and scalability.

## Structure

```txt
Controllers
   ↓
Services
   ↓
Repositories
   ↓
Models / Database
```

## Responsibilities

- **Controllers**
    - Handle HTTP requests & responses.
    - Validate incoming requests.
    - Delegate business logic to services.

- **Services**
    - Contain core business logic.
    - Coordinate workflows across multiple modules.

- **Repositories**
    - Centralize database queries.
    - Reduce duplicated query logic.

- **DTO / Data Objects**
    - Standardize payloads between layers.

- **Policies & Gates**
    - Handle fine-grained authorization rules.

- **Events & Listeners**
    - Power asynchronous workflows.

---

# 🔐 Role-Based Access Control (RBAC)

User roles are managed via a `role` column in the `users` table and enforced through `RoleMiddleware`.

## Roles

### User

- Standard customers
- Manage personal profile
- View order history
- Track shipments

### Admin

- Manage products
- Handle order fulfillment
- Process customer requests
- Manage blogs and categories

### Superadmin

- Full system access
- Manage API keys
- Access global reports
- Configure platform settings

---

# 📦 Modular Components

## Blade Components

Reusable UI elements:

- `x-product-card`: Responsive card with 'Buy Now' (direct to checkout) and 'Add to Cart' actions.
- `x-hero`: Split-screen hero section.
- `x-gallery`: Grid-based editorial gallery.
- `x-button`: Premium utility buttons.
- `x-modal`: Glassmorphism-based Alpine modals.
- `x-pagination`: Bespoke high-end navigation system.
- `x-mobile-overlay`: Backdrop component for safe sidebar closing on touch devices.

## Alpine.js Components

Interactive frontend modules:

- Administrative modals
- Toast notifications
- Dynamic filtering
- Cart state interactions

## Service Layer

Dedicated integrations:

- Payment Gateway Service
- Logistics API Service
- Notification Service
- Analytics Service

---

# ⚡ Queue & Background Jobs

Heavy processes are delegated to queues for improved performance.

## Queue Drivers

- Redis Queue
- Laravel Horizon

## Async Processes

- WhatsApp notifications
- Email receipts
- Shipment status sync
- Payment webhook processing
- Analytics aggregation
- Export PDF/Excel generation

---

# 📊 Caching Strategy

The platform uses Redis-based caching to reduce database load and improve response times.

## Cached Resources

- Featured products
- Homepage banners
- Categories
- Dashboard analytics
- Visitor statistics

## Cache Features

- Route cache
- Config cache
- Query cache
- Response cache

---

# 🔎 Search Architecture

The platform implements full-text search for scalable product discovery.

## Search Stack

- Laravel Scout
- Meilisearch / Typesense

## Searchable Resources

- Products
- Categories
- Blogs
- Galleries

---

# 📁 Media Management

Media assets are abstracted through Laravel storage drivers.

## Features

- Image optimization
- WebP conversion
- Lazy loading
- CDN-ready storage
- Secure file uploads
- Signed asset URLs

---

# 📈 Analytics & Visitor Tracking

A custom analytics system tracks business performance and visitor behavior.

## Visitor Tracking

- IP Address
- User Agent
- Referral source
- Device type
- Visited routes
- Session duration

## Dashboard Metrics

- Revenue trends
- Order statistics
- Conversion rate
- Visitor growth
- Product performance

---

# 🧾 Audit & Activity Logging

System activities are logged for transparency and accountability.

## Logged Activities

- Product updates
- Price changes
- Order status modifications
- Login attempts
- Failed payments
- Administrative actions

---

# 🧠 Domain-Specific Features

The platform includes custom tailoring workflows beyond standard e-commerce features.

## Measurement Management

- Customer body measurements
- Historical measurement records
- Size templates
- Measurement revisions

## Production Workflow

```txt
Pending
→ Fabric Preparation
→ Cutting
→ Sewing
→ Finishing
→ Quality Control
→ Packaging
→ Shipping
```

## Custom Order Features

- Fabric selection
- Embroidery customization
- Reference image upload
- Tailoring notes

## Appointment System

- Fitting schedules
- Pickup scheduling
- Consultation booking

---

# 💳 Financial Architecture

The system includes financial tracking and accounting support.

## Features

- Invoice numbering
- Refund handling
- Revenue ledger
- Expense tracking
- Profit margin analytics
- Transaction reporting

---

# 🌍 SEO & Marketing Architecture

SEO optimization is integrated directly into the platform structure.

## Features

- Dynamic meta tags
- OpenGraph support
- Structured Data JSON-LD
- XML Sitemap
- Canonical URLs
- Product schema markup

---

# 🔐 Security Architecture

Security is enforced across all application layers.

## Security Features

- CSRF protection
- XSS sanitization
- Rate limiting
- Secure headers
- Content Security Policy (CSP)
- Signed URLs
- Password policy enforcement
- Two-factor authentication (2FA)

## Administrative Security

- Admin-only route protection
- Role-based middleware
- Session monitoring
- Login throttling

---

# 🧪 Testing Strategy

Testing ensures platform reliability and maintainability.

## Testing Stack

- PestPHP
- PHPUnit
- Laravel Dusk

## Coverage

- Feature tests
- API tests
- Payment webhook tests
- Authentication tests
- Browser interaction tests

---

# 🚀 Deployment Architecture

The platform follows a modern deployment workflow.

## Infrastructure

- Dockerized environments
- Nginx
- Redis
- MySQL

## CI/CD

- GitHub Actions
- Automated deployment pipeline
- Environment-based deployment
- Zero-downtime deployment strategy

## Environments

```txt
Local
Staging
Production
```

---

# 📡 API Architecture

The platform exposes API endpoints for future integrations.

## Standards

- RESTful API design
- JSON responses
- Versioned endpoints (`/api/v1`)
- Token authentication via Laravel Sanctum

## Future Integrations

- Mobile apps
- POS systems
- Third-party marketplaces
- Internal dashboards

---

# 📚 Documentation Standards

The project maintains comprehensive technical documentation.

## Documentation Types

- Architecture Decision Records (ADR)
- API Documentation
- ERD (Entity Relationship Diagram)
- Sequence diagrams
- Deployment guides
- State diagrams

---

# 📌 Scalability Considerations

The architecture is designed for future scalability.

## Scalability Strategies

- Modular route separation
- Service-oriented architecture
- Queue-based processing
- Redis caching
- CDN-ready asset delivery
- Horizontal deployment readiness

---

# ✅ Core Business Differentiators

Jahitan Nenek differentiates itself from standard e-commerce platforms through:

- Tailoring production workflow tracking
- Customer measurement history
- Re-order based on saved measurements
- Tailor workload management
- Fabric inventory management
- Custom tailoring services
- Appointment & fitting scheduling

---
