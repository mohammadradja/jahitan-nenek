# Design System: Jahitan Nenek

This document defines the visual language, design principles, UI standards, and Tailwind-based design tokens used across the Jahitan Nenek platform to ensure a cohesive, elegant, premium, and modern handcrafted digital experience.

---

# 🎨 Brand Identity

Jahitan Nenek combines:

- Traditional craftsmanship
- Premium editorial aesthetics
- Modern digital minimalism
- Warm emotional storytelling
- Futuristic glassmorphism

The visual identity emphasizes warmth, softness, elegance, and artisan authenticity while maintaining modern scalability and UI consistency.

---

# 🌈 Color System

## Primary Color Palette

| Token         | Hex / Utility            | Usage                    |
| ------------- | ------------------------ | ------------------------ |
| Vintage Cream | `#F8F3EC`                | Main background          |
| Soft Rose     | `#D8A7B1`                | Primary accent           |
| Dark Wool     | `#2E2A27`                | Headings & dark sections |
| Warm Beige    | `#E7D7C9`                | Secondary surfaces       |
| Dusty Pink    | `#C98F9F`                | Interactive highlights   |
| Soft Sage     | `#A8B5A2`                | Success states           |
| Muted Gold    | `#C8A96B`                | Premium accents          |
| Frost White   | `rgba(255,255,255,0.75)` | Glass surfaces           |

---

# 🧊 Glassmorphism System

## Glass Utility

```txt
glass-effect
```

## Composition

```css
background: rgba(255, 255, 255, 0.8);
backdrop-filter: blur(24px);
border: 1px solid rgba(255, 255, 255, 0.4);
```

## Usage

- Navigation bars
- Modal windows
- Floating cards
- Toast notifications
- Analytics widgets

---

# 🖋️ Typography System

## Primary Typeface

### Headings

```txt
Playfair Display
```

### Tailwind Utility

```txt
font-serif
```

### Characteristics

- Elegant
- Editorial
- Luxury-inspired
- Heritage-focused

---

## Secondary Typeface

### Body Text

```txt
Poppins
```

### Tailwind Utility

```txt
font-sans
```

### Characteristics

- Clean
- Modern
- Readable
- Neutral

---

# 🔠 Typography Scale

| Element       | Tailwind Class               |
| ------------- | ---------------------------- |
| Hero Title    | `text-6xl md:text-7xl`       |
| Section Title | `text-4xl md:text-5xl`       |
| Card Title    | `text-2xl`                   |
| Body Text     | `text-base leading-7`        |
| Small Text    | `text-sm tracking-wide`      |
| Metadata      | `tracking-[0.3em] uppercase` |

---

# 📏 Spacing System

The design prioritizes generous whitespace and breathable layouts.

## Section Spacing

```txt
py-24 md:py-32
```

## Container Width

```txt
max-w-7xl mx-auto px-6 lg:px-10
```

## Grid Gap

```txt
gap-6 md:gap-10
```

---

# 🧱 Border Radius System

Rounded corners create a soft handcrafted aesthetic.

| Usage          | Tailwind Utility   |
| -------------- | ------------------ |
| Buttons        | `rounded-full`     |
| Cards          | `rounded-[2.5rem]` |
| Large Sections | `rounded-[4rem]`   |
| Modals         | `rounded-[3rem]`   |

---

# 🌑 Shadow System

## Soft Shadow

```txt
shadow-xl shadow-soft-rose/10
```

## Premium Shadow

```txt
shadow-2xl shadow-dark-wool/10
```

## Floating Shadow

```txt
shadow-[0_20px_80px_rgba(0,0,0,0.08)]
```

---

# ✨ Animation System

The platform uses subtle motion for premium interaction feedback.

## Animation Principles

- Soft motion
- Fast response
- Minimal distraction
- Elegant transitions

---

# 🎞️ Transition Utilities

## Standard Transition

```txt
transition-all duration-300 ease-out
```

## Hover Scale

```txt
hover:scale-[1.02]
```

## Floating Interaction

```txt
hover:-translate-y-1
```

---

# 🧩 Core UI Components

---

# 🪟 Modal System

## Design

- Fixed centered layout
- Large internal spacing
- Glassmorphism styling
- Smooth animations

## Tailwind Structure

```txt
fixed inset-0 z-50 flex items-center justify-center
```

## Modal Card

```txt
rounded-[3rem] bg-white/90 backdrop-blur-xl p-10
```

## Overlay

```txt
bg-dark-wool/40 backdrop-blur-sm
```

## Animation

```txt
animate__animated animate__zoomIn animate__faster
```

---

# 🔔 Toast Notifications

Powered by Alpine.js.

## Position

```txt
bottom-6 right-6
```

## Style

- Pill-shaped
- Semi-transparent
- Glass effect
- Floating animation

## Variants

### Success

- Soft green border
- Check icon

### Error

- Soft red border
- Alert icon

### Info

- Rose/blue accents

---

# 🃏 Card Components

## Design Philosophy

Cards should feel:

- Floating
- Soft
- Premium
- Layered

## Standard Card

```txt
rounded-[2.5rem]
bg-white
shadow-2xl
transition-all
duration-300
```

## Hover State

```txt
hover:scale-[1.02]
hover:border-soft-rose/40
```

---

# 🛍️ Product Card System

## Structure

- Large imagery
- Soft gradients
- Minimal text clutter
- Floating action buttons

## Features

- Wishlist button
- Quick view interaction
- Smooth hover zoom
- Product tags

---

# 🧭 Navigation System

## Desktop Navbar

- Transparent floating glass effect
- Rounded-full container
- Sticky scrolling behavior

## Mobile Navigation

- Slide-in drawer
- Backdrop blur overlay
- Large touch targets

---

# 📊 Dashboard Design Language

Admin and Superadmin dashboards use:

- Large analytics cards
- Minimal chart clutter
- Glass widgets
- High readability spacing

## Chart System

Powered by:

```txt
Chart.js
```

## Analytics Cards

```txt
rounded-[2rem]
bg-white/80
backdrop-blur-xl
```

---

# 🧵 Tailoring Workflow UI

Specialized workflow visualization for production stages.

## Production Stages

```txt
Pending
→ Cutting
→ Sewing
→ Finishing
→ QC
→ Packaging
→ Shipping
```

## Visual Indicators

- Progress timeline
- Status pills
- Color-coded workflow stages

---

# 🖼️ Image & Media Standards

## Image Style

- Editorial photography
- Soft lighting
- Warm color grading
- Neutral backgrounds

## Aspect Ratios

| Usage        | Ratio  |
| ------------ | ------ |
| Product Card | `4:5`  |
| Hero Banner  | `16:9` |
| Gallery      | `1:1`  |

## Optimization

- Lazy loading
- WebP conversion
- Responsive image sizes

---

# 📱 Responsive Design Standards

The platform follows a mobile-first responsive approach.

## Breakpoints

| Device        | Tailwind |
| ------------- | -------- |
| Mobile        | `sm:`    |
| Tablet        | `md:`    |
| Laptop        | `lg:`    |
| Desktop       | `xl:`    |
| Large Screens | `2xl:`   |

---

# ♿ Accessibility Standards

Accessibility is integrated into the design system.

## Standards

- Keyboard navigability
- Focus-visible states
- WCAG contrast awareness
- Semantic HTML usage
- Screen-reader friendly labels

## Focus State

```txt
focus:outline-none
focus:ring-2
focus:ring-soft-rose
```

---

# 🌟 Visual Principles

## 1. Generous Whitespace

Avoid clutter and prioritize readability.

## 2. Soft Interactions

Interactions should feel elegant and natural.

## 3. Editorial Layouts

Use magazine-inspired spacing and typography hierarchy.

## 4. Human-Centered Design

The UI should feel warm, approachable, and personal.

## 5. Futuristic Heritage

Blend handcrafted traditions with modern digital aesthetics.

---

# 🧠 UX Principles

## Simplicity First

Interfaces should remain intuitive and uncluttered.

## Emotional Commerce

Every page should reinforce warmth and storytelling.

## Seamless Checkout

Minimize friction throughout purchase flows.

## Feedback Visibility

Every action should provide visual feedback.

---

# 🛠️ Tailwind Configuration Philosophy

## Design Tokens

All reusable tokens are centralized in:

```txt
tailwind.config.js
```

## Token Categories

- Colors
- Shadows
- Border radius
- Font families
- Animations
- Z-index layers

---

# 🚀 Future Design Expansion

Planned future design enhancements include:

- Dark mode support
- Dynamic theme switching
- Motion-based storytelling
- 3D product previews
- AI-generated outfit recommendations
- Advanced microinteractions
- Interactive tailoring visualizer

---

# 📌 Design Summary

The Jahitan Nenek design system is built around:

- Warmth
- Elegance
- Heritage
- Minimalism
- Glassmorphism
- Editorial luxury
- Human-centered storytelling

Every interface element should reinforce the feeling of handcrafted premium experiences combined with modern digital sophistication.

---
