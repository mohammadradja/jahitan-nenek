# Context: Jahitan Nenek Platform

Jahitan Nenek is a premium handcrafted fashion and tailoring platform focused on preserving traditional craftsmanship while delivering a modern digital commerce experience. The platform combines elegant storytelling, personalized tailoring workflows, and scalable e-commerce infrastructure into a unified ecosystem.

---

# 🧭 Documentation Hub

For detailed technical and system specifications, refer to the modular documentation below:

- [🎨 Design System](./DESIGN.md)  
  Colors, typography, spacing, design principles, and UI components.

- [🛠️ System Architecture](./ARCHITECTURE.md)  
  Tech stack, routing strategy, RBAC, services, scalability, and infrastructure.

- [📊 Database Schema](./DATABASE.md)  
  Database tables, relationships, indexing, and data architecture.

- [💳 API & Integrations](./API.md)  
  External services, payment gateways, logistics APIs, and notification systems.

- [📅 Implementation Planning](./PLANNING.md)  
  Development roadmap, milestones, feature planning, and execution phases.

---

# 🧵 Project Overview

## Core Identity

Jahitan Nenek is not simply an online store — it is a digital tailoring and handcrafted fashion ecosystem designed to deliver personalized products with emotional storytelling and artisan craftsmanship.

## Core Products

- Handmade knitwear
- Sweaters
- Cardigans
- Scarves
- Beanies
- Accessories
- Custom tailoring products

## Business Model

- Direct-to-consumer (D2C)
- Single-brand commerce platform
- No multi-vendor marketplace system
- Personalized production workflow

## Platform Goals

- Preserve traditional craftsmanship
- Provide premium shopping experiences
- Enable scalable tailoring operations
- Combine storytelling with commerce

---

# 🎯 Vision & Mission

## Vision

To become the leading digital destination for premium handcrafted fashion and tailoring services that preserve traditional craftsmanship while embracing modern technology and aesthetics.

## Mission

- Deliver warmth and personal storytelling in every product.
- Empower handcrafted production through digital systems.
- Create meaningful customer relationships through personalization.
- Build sustainable artisan-focused commerce.

---

# 🛍️ Customer Experience Philosophy

The platform emphasizes:

- Emotional product storytelling
- Personalized shopping journeys
- Elegant premium aesthetics
- Seamless checkout experiences
- Human-centered tailoring workflows

## Customer Expectations

- Fast and intuitive browsing
- Personalized product recommendations
- Transparent order tracking
- Real-time shipment updates
- Reliable customer communication

---

# 🧱 Platform Architecture Philosophy

The architecture prioritizes:

## Scalability

Designed to support:

- Large product catalogs
- High visitor traffic
- Future mobile applications
- API integrations
- Queue-based workloads

## Maintainability

Implemented through:

- Modular route structure
- Service-oriented architecture
- Component-based UI
- Centralized configuration

## Performance

Optimized with:

- Redis caching
- Queue workers
- Optimized database indexing
- Lazy loading
- Image optimization

## Security

Protected through:

- RBAC middleware
- CSRF protection
- API token authentication
- Secure webhook validation
- Rate limiting

---

# 👥 User Roles & Access Control

## Customer

Capabilities:

- Browse products
- Manage cart
- Place orders
- Save measurements
- Track shipments
- Manage profile

## Admin

Capabilities:

- Manage products
- Process orders
- Manage inventory
- Publish blogs
- Monitor transactions
- Handle production workflow

## Superadmin

Capabilities:

- Global system configuration
- API management
- Financial reporting
- Analytics access
- Security management
- Administrative oversight

---

# 🔄 Core User Journey

## 1. Product Discovery

Users browse:

- Product catalogs
- Categories
- Editorial blogs
- Featured collections

## 2. Product Selection

Users can:

- View product details
- Customize selections
- Add items to cart
- Save favorites

## 3. Checkout Process

Users provide:

- Shipping information
- Courier selection
- Payment method
- Tailoring notes

## 4. Payment Flow

Integrated with:

- Midtrans Snap Checkout
- Dynamic payment verification
- Real-time payment notifications

## 5. Production Workflow

Orders move through:

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

## 6. Shipment & Fulfillment

Customers receive:

- WhatsApp notifications
- Email receipts
- Tracking numbers
- Delivery updates

---

# 🧠 Core Business Differentiators

Jahitan Nenek differentiates itself from conventional e-commerce platforms through:

## Tailoring-Centric Features

- Customer measurement management
- Re-order from saved measurements
- Custom tailoring workflows
- Production stage tracking

## Personalized Commerce

- Handcrafted storytelling
- Artisan-focused branding
- Human-centered experiences
- Personalized order handling

## Operational Features

- Manual order overrides
- Integrated logistics calculation
- Real-time analytics dashboard
- Queue-based notification systems

---

# 📊 Analytics & Business Intelligence

The platform includes advanced business monitoring features.

## Analytics Features

- Revenue tracking
- Order statistics
- Product performance
- Visitor behavior analysis
- Conversion tracking

## Visitor Tracking

Custom middleware captures:

- IP address
- Device type
- Referral source
- Session activity
- Route visits

## Visualization

Powered by:

- Chart.js
- Custom dashboard metrics
- Real-time reporting

---

# 💳 Payment & Logistics Ecosystem

## Payments

Integrated with:

- Midtrans Snap
- Webhook verification
- Multi-payment support

## Logistics

Integrated with:

- RajaOngkir API
- Real-time shipping calculation
- Courier estimation
- Tracking synchronization

## Notifications

Integrated with:

- WhatsApp Gateway
- Transactional Email
- Queue-based delivery system

---

# 📚 Content & Editorial System

The platform includes a built-in CMS for storytelling and branding.

## Content Types

- Blogs
- Editorial articles
- Product stories
- Craftsmanship insights

## SEO Features

- Dynamic metadata
- Structured data
- OpenGraph support
- Sitemap generation

---

# 🛠️ Technology Stack

## Backend

- Laravel 11
- PHP 8+
- MySQL
- Redis

## Frontend

- Blade Components
- Tailwind CSS
- Alpine.js
- Chart.js

## Infrastructure

- Queue Workers
- Redis Cache
- Docker-ready environment
- GitHub Actions CI/CD

## Integrations

- Midtrans
- RajaOngkir
- Fonnte/Wablas
- Mailgun/SMTP

---

# 📂 Project Structure

## Backend Structure

```txt
app/
├── Http/
├── Models/
├── Services/
├── Repositories/
├── Policies/
├── Events/
└── Jobs/
```

## Frontend Structure

```txt
resources/
├── views/
├── css/
├── js/
└── components/
```

## Database Structure

```txt
database/
├── migrations/
├── seeders/
└── factories/
```

## Route Structure

```txt
routes/
├── web.php
├── customer.php
├── admin.php
├── superadmin.php
└── api.php
```

---

# 🚀 Scalability Roadmap

Future platform expansion plans include:

## Planned Features

- Mobile applications
- POS integration
- AI recommendation systems
- Fabric inventory management
- Loyalty programs
- Multi-language support
- Advanced tailoring analytics

## Infrastructure Evolution

- Read replica databases
- CDN integration
- Horizontal scaling
- Event-driven architecture
- Microservice readiness

---

# 🌟 Brand Philosophy

Jahitan Nenek represents:

- Warmth
- Heritage
- Craftsmanship
- Elegance
- Personal connection

Every product is designed not only as apparel, but as a story woven through craftsmanship and meaningful human touch.

---
