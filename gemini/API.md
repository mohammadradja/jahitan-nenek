# API & Third-Party Integrations

This document details the external services, APIs, and third-party integrations used within the Jahitan Nenek platform.

---

# 💳 Midtrans Payment Gateway

## Integration Type

- Midtrans Snap (Pop-up Checkout)
- Dynamic Webhook Notifications

## Features

- Secure online payments
- Real-time payment verification
- Automatic order status synchronization
- Multi-payment method support

## Supported Payment Methods

- Bank Transfer
- QRIS
- E-Wallets
- Credit/Debit Cards
- Virtual Accounts

## Environment Configuration

- Sandbox Mode
- Production Mode

## Settings Path

```txt
Superadmin > Settings > Payment Configuration
```

## Configuration Fields

- `midtrans_server_key`
- `midtrans_client_key`
- `midtrans_environment`
- `midtrans_merchant_id`

## Webhook Events

- `pending`
- `settlement`
- `expire`
- `cancel`
- `deny`

## Security Measures

- Signature key validation
- Webhook verification
- Server-side payment validation

---

# 🚛 RajaOngkir Logistics API

## Integration Type

REST API integration for shipping calculation and courier management.

## Features

- Real-time shipping calculation
- Multi-courier support
- Province & city synchronization
- Dynamic delivery estimation

## Supported Couriers

- JNE
- J&T
- SiCepat
- POS Indonesia
- TIKI
- Ninja Xpress

## Provider Plan

- Starter
- Basic
- Pro

## Settings Path

```txt
Superadmin > Settings > Logistics Configuration
```

## Configuration Fields

- `rajaongkir_api_key`
- `rajaongkir_origin_city`
- `rajaongkir_origin_province`
- `default_courier`

## API Usage

- Shipping cost calculation
- Destination validation
- Courier service retrieval

---

# 💬 WhatsApp Notification Service

## Providers

- Fonnte
- Wablas

## Notification Type

Outbound transactional notifications.

## Triggered Events

- Order created
- Payment confirmed
- Order processing
- Shipment dispatched
- Order completed

## Settings Path

```txt
Superadmin > Settings > Notification Drivers
```

## Configuration Fields

- `whatsapp_api_token`
- `whatsapp_sender`
- `whatsapp_enabled`
- `whatsapp_provider`

## Message Features

- Dynamic template variables
- Order summary injection
- Shipment tracking links
- Auto-generated invoice references

## Delivery Strategy

- Queue-based asynchronous delivery
- Retry mechanism for failed messages
- Delivery logging & status tracking

---

# ✉️ Transactional Email Service

## Providers

- Mailgun
- SMTP

## Email Types

- Order receipts
- Payment confirmation
- Password reset
- Shipment notifications
- Promotional campaigns

## Features

- HTML email templates
- Queue-based email dispatch
- Email retry handling
- Template personalization

## Environment Configuration

Configured through:

```txt
.env
```

## Configuration Fields

- `MAIL_MAILER`
- `MAIL_HOST`
- `MAIL_PORT`
- `MAIL_USERNAME`
- `MAIL_PASSWORD`
- `MAIL_FROM_ADDRESS`

---

# 🔎 Search Engine Integration

## Providers

- Meilisearch
- Typesense

## Integration Layer

- Laravel Scout

## Searchable Resources

- Products
- Blogs
- Categories
- Galleries

## Features

- Full-text search
- Typo tolerance
- Fast indexing
- Real-time search updates

---

# 📊 Analytics & Monitoring Services

## Monitoring Providers

- Laravel Telescope
- Laravel Pulse
- Sentry

## Features

- Error monitoring
- Queue monitoring
- Performance profiling
- Request inspection
- Exception tracking

## Tracked Metrics

- Revenue trends
- Visitor activity
- Failed jobs
- API latency
- Payment failures

---

# ☁️ Storage & Asset Management

## Storage Drivers

- Local Storage
- S3-Compatible Storage (Optional)

## Features

- CDN-ready assets
- Secure uploads
- Signed URLs
- Image optimization
- WebP conversion

## Supported Uploads

- Product images
- Customer reference images
- Invoice exports
- Gallery assets

---

# 🔐 Authentication & Security Services

## Authentication Stack

- Laravel Breeze
- Laravel Sanctum

## Security Features

- CSRF protection
- API token authentication
- Password reset flow
- Session protection
- Login throttling

## Optional Enhancements

- Two-factor authentication
- Device/session management
- Social login providers

---

# 📡 Internal API Architecture

## API Standard

RESTful JSON API

## Endpoint Structure

```txt
/api/v1
```

## Authentication

- Sanctum Token Authentication
- Session Authentication

## Response Structure

```json
{
    "success": true,
    "message": "Request successful",
    "data": {}
}
```

## API Modules

- Authentication
- Products
- Orders
- Cart
- Shipping
- Payments
- Customer Measurements
- Analytics

---

# ⚡ Queue & Background Services

## Queue Drivers

- Redis Queue

## Queue Monitoring

- Laravel Horizon

## Background Processes

- WhatsApp delivery
- Email sending
- Webhook processing
- Analytics aggregation
- PDF/Excel export generation

---

# 📦 Asset & Design Resources

## Design Assets

- Bespoke product photography
- Unsplash curated assets

## Typography

- Playfair Display (Editorial Serif)
- Poppins (Body Sans)

## Icons

- FontAwesome 6
- Lucide Icons

## Design Tokens

Defined in:

```txt
tailwind.config.js
```

## UI Principles

- Utility-first styling
- Responsive-first layouts
- Component-based design
- Accessible interaction states

---

# 🧠 Future Integration Roadmap

Potential future integrations planned for scalability and feature expansion.

## Planned Integrations

- POS System Integration
- Mobile App API
- ERP/Accounting Software
- AI-based product recommendations
- Fabric inventory synchronization
- SMS Gateway provider
- Customer loyalty platform

---
