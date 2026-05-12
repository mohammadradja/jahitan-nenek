# Database Schema: Jahitan Nenek

This document describes the core entities, relationships, and database architecture used within the Jahitan Nenek platform.

---

# 📊 Database Overview

## Database Engine

- MySQL 8+

## ORM

- Laravel Eloquent ORM

## Architecture Principles

- Relational database design
- UUID-ready architecture (future scalability)
- Soft delete support for critical entities
- Timestamp-based auditing
- Indexed search optimization

---

# 🧑 Users

## Table

```txt
users
```

## Purpose

Stores customer accounts, administrators, and superadmin access credentials.

## Roles

- `user`
- `admin`
- `superadmin`

## Key Fields

| Field             | Type      | Description         |
| ----------------- | --------- | ------------------- |
| id                | bigint    | Primary key         |
| name              | varchar   | Full name           |
| email             | varchar   | Unique email        |
| password          | varchar   | Hashed password     |
| role              | enum      | User role           |
| phone             | varchar   | Contact number      |
| address           | text      | Full address        |
| province_id       | varchar   | Province identifier |
| city_id           | varchar   | City identifier     |
| postal_code       | varchar   | Postal code         |
| email_verified_at | timestamp | Email verification  |
| remember_token    | varchar   | Auth session token  |
| created_at        | timestamp | Created timestamp   |
| updated_at        | timestamp | Updated timestamp   |

## Relationships

- Has many Orders
- Has many Blogs
- Has many Measurements
- Has many Visitor Sessions

---

# 🗂️ Categories

## Table

```txt
categories
```

## Purpose

Groups products into logical collections.

## Key Fields

| Field            | Type      | Description          |
| ---------------- | --------- | -------------------- |
| id               | bigint    | Primary key          |
| name             | varchar   | Category name        |
| slug             | varchar   | SEO slug             |
| image            | varchar   | Category thumbnail   |
| description      | text      | Category description |
| meta_title       | varchar   | SEO title            |
| meta_description | text      | SEO description      |
| created_at       | timestamp | Created timestamp    |
| updated_at       | timestamp | Updated timestamp    |

## Relationships

- Has many Products

---

# 📦 Products

## Table

```txt
products
```

## Purpose

Stores product catalog and tailoring service products.

## Key Fields

| Field             | Type      | Description           |
| ----------------- | --------- | --------------------- |
| id                | bigint    | Primary key           |
| category_id       | bigint    | Category reference    |
| name              | varchar   | Product name          |
| slug              | varchar   | SEO slug              |
| sku               | varchar   | Product SKU           |
| description       | longtext  | Product description   |
| short_description | text      | Short summary         |
| price             | decimal   | Product price         |
| stock             | integer   | Available stock       |
| weight            | integer   | Weight in grams       |
| image             | varchar   | Primary image         |
| gallery           | json      | Additional images     |
| is_featured       | boolean   | Featured product flag |
| status            | enum      | Draft/Published       |
| meta_title        | varchar   | SEO title             |
| meta_description  | text      | SEO description       |
| created_at        | timestamp | Created timestamp     |
| updated_at        | timestamp | Updated timestamp     |

## Relationships

- Belongs to Category
- Has many Order Items
- Has many Product Reviews

---

# 🛒 Carts

## Table

```txt
carts
```

## Purpose

Temporary customer shopping cart storage.

## Key Fields

| Field      | Type      | Description       |
| ---------- | --------- | ----------------- |
| id         | bigint    | Primary key       |
| user_id    | bigint    | User reference    |
| product_id | bigint    | Product reference |
| quantity   | integer   | Product quantity  |
| created_at | timestamp | Created timestamp |
| updated_at | timestamp | Updated timestamp |

## Relationships

- Belongs to User
- Belongs to Product

---

# 📑 Orders

## Table

```txt
orders
```

## Purpose

Stores customer order transactions.

## Key Fields

| Field           | Type      | Description          |
| --------------- | --------- | -------------------- |
| id              | bigint    | Primary key          |
| user_id         | bigint    | Customer reference   |
| invoice_number  | varchar   | Invoice identifier   |
| total_price     | decimal   | Total order price    |
| shipping_cost   | decimal   | Shipping fee         |
| payment_status  | enum      | Payment state        |
| shipping_status | enum      | Shipment state       |
| order_status    | enum      | Workflow state       |
| payment_method  | varchar   | Payment provider     |
| courier         | varchar   | Courier service      |
| tracking_number | varchar   | Shipment tracking    |
| snap_token      | text      | Midtrans token       |
| notes           | text      | Customer notes       |
| paid_at         | timestamp | Payment timestamp    |
| shipped_at      | timestamp | Shipment timestamp   |
| completed_at    | timestamp | Completion timestamp |
| created_at      | timestamp | Created timestamp    |
| updated_at      | timestamp | Updated timestamp    |

## Relationships

- Belongs to User
- Has many Order Items
- Has one Payment Transaction

---

# 📦 Order Items

## Table

```txt
order_items
```

## Purpose

Stores product snapshots within an order.

## Key Fields

| Field         | Type      | Description       |
| ------------- | --------- | ----------------- |
| id            | bigint    | Primary key       |
| order_id      | bigint    | Order reference   |
| product_id    | bigint    | Product reference |
| product_name  | varchar   | Snapshot name     |
| product_price | decimal   | Snapshot price    |
| quantity      | integer   | Ordered quantity  |
| subtotal      | decimal   | Total line price  |
| created_at    | timestamp | Created timestamp |
| updated_at    | timestamp | Updated timestamp |

## Relationships

- Belongs to Order
- Belongs to Product

---

# 💳 Payment Transactions

## Table

```txt
payment_transactions
```

## Purpose

Stores payment gateway transaction data.

## Key Fields

| Field              | Type      | Description            |
| ------------------ | --------- | ---------------------- |
| id                 | bigint    | Primary key            |
| order_id           | bigint    | Order reference        |
| transaction_id     | varchar   | Gateway transaction ID |
| payment_type       | varchar   | Payment method         |
| transaction_status | varchar   | Payment status         |
| gross_amount       | decimal   | Total payment          |
| payload            | json      | Raw API payload        |
| paid_at            | timestamp | Payment timestamp      |
| created_at         | timestamp | Created timestamp      |
| updated_at         | timestamp | Updated timestamp      |

## Relationships

- Belongs to Order

---

# 🧵 Customer Measurements

## Table

```txt
measurements
```

## Purpose

Stores customer tailoring measurements.

## Key Fields

| Field         | Type      | Description        |
| ------------- | --------- | ------------------ |
| id            | bigint    | Primary key        |
| user_id       | bigint    | Customer reference |
| chest         | decimal   | Chest size         |
| waist         | decimal   | Waist size         |
| hip           | decimal   | Hip size           |
| shoulder      | decimal   | Shoulder width     |
| sleeve_length | decimal   | Sleeve size        |
| body_length   | decimal   | Body length        |
| notes         | text      | Tailoring notes    |
| created_at    | timestamp | Created timestamp  |
| updated_at    | timestamp | Updated timestamp  |

## Relationships

- Belongs to User

---

# 🧵 Production Tracking

## Table

```txt
production_stages
```

## Purpose

Tracks tailoring workflow stages.

## Workflow

```txt
Pending
→ Cutting
→ Sewing
→ Finishing
→ QC
→ Packaging
→ Shipping
```

## Key Fields

| Field        | Type      | Description       |
| ------------ | --------- | ----------------- |
| id           | bigint    | Primary key       |
| order_id     | bigint    | Order reference   |
| stage        | enum      | Production stage  |
| notes        | text      | Production notes  |
| started_at   | timestamp | Stage start       |
| completed_at | timestamp | Stage completion  |
| created_at   | timestamp | Created timestamp |
| updated_at   | timestamp | Updated timestamp |

## Relationships

- Belongs to Order

---

# ⭐ Product Reviews

## Table

```txt
product_reviews
```

## Purpose

Stores customer reviews and ratings.

## Key Fields

| Field      | Type      | Description       |
| ---------- | --------- | ----------------- |
| id         | bigint    | Primary key       |
| user_id    | bigint    | Reviewer          |
| product_id | bigint    | Product reference |
| rating     | integer   | Rating score      |
| review     | text      | Review content    |
| created_at | timestamp | Created timestamp |
| updated_at | timestamp | Updated timestamp |

## Relationships

- Belongs to User
- Belongs to Product

---

# 📰 Blogs

## Table

```txt
blogs
```

## Purpose

Stores blog articles and editorial content.

## Key Fields

| Field            | Type      | Description       |
| ---------------- | --------- | ----------------- |
| id               | bigint    | Primary key       |
| author_id        | bigint    | Author reference  |
| title            | varchar   | Blog title        |
| slug             | varchar   | SEO slug          |
| excerpt          | text      | Short summary     |
| content          | longtext  | Article content   |
| image            | varchar   | Featured image    |
| views            | integer   | View counter      |
| status           | enum      | Draft/Published   |
| published_at     | timestamp | Publish date      |
| meta_title       | varchar   | SEO title         |
| meta_description | text      | SEO description   |
| created_at       | timestamp | Created timestamp |
| updated_at       | timestamp | Updated timestamp |

## Relationships

- Belongs to User

---

# 👀 Visitors

## Table

```txt
visitors
```

## Purpose

Tracks anonymous traffic and visitor behavior.

## Key Fields

| Field       | Type      | Description             |
| ----------- | --------- | ----------------------- |
| id          | bigint    | Primary key             |
| user_id     | bigint    | Optional user reference |
| ip_address  | varchar   | Visitor IP              |
| user_agent  | text      | Browser/device          |
| device_type | varchar   | Device category         |
| referrer    | text      | Referral source         |
| path        | varchar   | Visited route           |
| session_id  | varchar   | Visitor session         |
| visited_at  | timestamp | Visit timestamp         |
| created_at  | timestamp | Created timestamp       |
| updated_at  | timestamp | Updated timestamp       |

---

# ⚙️ Site Settings

## Table

```txt
site_settings
```

## Purpose

Stores dynamic system configurations.

## Key Fields

| Field      | Type      | Description         |
| ---------- | --------- | ------------------- |
| id         | bigint    | Primary key         |
| key        | varchar   | Configuration key   |
| value      | longtext  | Configuration value |
| group      | varchar   | Setting category    |
| created_at | timestamp | Created timestamp   |
| updated_at | timestamp | Updated timestamp   |

## Example Groups

- Payment
- Logistics
- Notifications
- SEO
- General

---

# 📝 Activity Logs

## Table

```txt
activity_logs
```

## Purpose

Tracks administrative and system actions.

## Key Fields

| Field        | Type      | Description        |
| ------------ | --------- | ------------------ |
| id           | bigint    | Primary key        |
| user_id      | bigint    | Actor reference    |
| action       | varchar   | Activity name      |
| description  | text      | Detailed activity  |
| subject_type | varchar   | Model type         |
| subject_id   | bigint    | Related model      |
| ip_address   | varchar   | User IP            |
| created_at   | timestamp | Activity timestamp |

---

# 🔑 Failed Jobs

## Table

```txt
failed_jobs
```

## Purpose

Stores failed queue jobs for debugging.

## Key Fields

| Field      | Type      | Description        |
| ---------- | --------- | ------------------ |
| id         | bigint    | Primary key        |
| uuid       | varchar   | Job UUID           |
| connection | text      | Queue connection   |
| queue      | text      | Queue name         |
| payload    | longtext  | Serialized payload |
| exception  | longtext  | Exception trace    |
| failed_at  | timestamp | Failure timestamp  |

---

# 📊 Database Indexing Strategy

## Indexed Columns

- `products.slug`
- `categories.slug`
- `blogs.slug`
- `orders.invoice_number`
- `users.email`
- `visitors.ip_address`

## Full-text Search

Implemented on:

- Product names
- Blog content
- Product descriptions

---

# 🔄 Soft Delete Strategy

Soft deletes are enabled for critical entities:

- Products
- Categories
- Orders
- Blogs
- Users

---

# 🚀 Scalability Considerations

## Optimization Strategies

- Query indexing
- Eager loading
- Database caching
- Queue processing
- Pagination on large datasets

## Future Improvements

- UUID migration
- Read replica databases
- Table partitioning
- Multi-tenant architecture support

---
