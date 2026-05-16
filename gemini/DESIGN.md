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

| Type            | Tailwind Utility   |
| --------------- | ------------------ |
| Section Gap     | `gap-16 md:gap-24` |
| Grid Gap        | `gap-8 md:gap-10`  |
| Component Gap   | `gap-4 md:gap-6`   |
| Content Gap     | `gap-2 md:gap-4`   |

---

# 📑 Layering & Z-Index System

To avoid visual overlaps and ensure proper interaction flows:

| Layer           | Z-Index    | Usage                         |
| --------------- | ---------- | ----------------------------- |
| Base            | `0`        | Backgrounds, static content   |
| Sticky Header   | `z-[100]`  | Table headers, sticky sub-nav |
| Sidebar Overlay | `z-[99999]` | Sidebar (Dashboard)           |
| Navbar Overlay  | `z-[99999]` | Navbar (Guest)                |
| Backdrop        | `z-[99998]` | Mobile menu backdrop          |
| Modal           | `z-[100000]`| System popups, forms          |
| Toast           | `z-[200000]`| Success/Error notifications   |

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

## Primary Premium Button
- **Structure**: `inline-flex items-center justify-center gap-2 font-bold uppercase tracking-widest transition-all`.
- **Proper Padding**: Padding MUST be proportional to text size to prevent "tight" text.
    - **XS (Action Icons)**: `w-10 h-10 rounded-xl` (No text).
    - **SM (Secondary Actions)**: `py-2.5 px-6 text-[10px] rounded-xl`.
    - **MD (Standard CTA)**: `py-3.5 px-10 text-[11px] rounded-2xl`.
    - **LG (Primary Hero)**: `py-4.5 px-12 text-xs rounded-[1.5rem]`.
- **Style**: High-contrast shadow, elegant transition, premium gradient.
- **Micro-interactions**: Hover: `-translate-y-0.5 shadow-xl`, Active: `scale-95`.

## Secondary Button
- **Standard Size**: Same as MD/LG above.
- **Style**: `border border-soft-rose/20 bg-white/50 backdrop-blur-sm text-soft-rose`.
- **Hover**: `bg-soft-rose text-white shadow-lg shadow-soft-rose/20`.

---

# 📊 Dashboard Standards

## Data Consolidation (Command Center)
All critical KPIs—including Sales (Revenue, Orders), Inventory (Stock, Low Stock), and Customer Growth—MUST be centralized on the main Dashboard index. Module-specific pages (Sales/Inventory) should focus on detailed tables and filters, not redundant summary cards.
- **Stats Cards (Overview)**: `p-8 rounded-[2.5rem] shadow-2xl border border-white/10`. Use for high-level summaries like Revenue.
- **Stats Cards (Standard)**: `p-6 rounded-[2rem] shadow-sm border border-gray-100 hover:border-soft-rose transition-all`.
- **Typography**: 
    - Value: `text-2xl md:text-4xl font-serif font-bold tracking-tight`.
    - Label: `text-[10px] font-bold uppercase tracking-[0.2em]`.
- **Layout**: 4-column grid with `gap-6` for better breathability.
- **Boxes/Containers**: `rounded-[2.5rem]` for main dashboard widgets to match the soft handcrafted aesthetic.
- **Micro-interactions**: Subtle `scale-105` on icons and `hover:translate-y-[-4px]` for cards.

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

# 🔢 Pagination System

## Design
- **Dimensions**: Square buttons (`w-11 h-11` or `w-12 h-12`).
- **Radius**: `rounded-xl` or `rounded-2xl`.
- **Active State**: `bg-soft-rose text-white shadow-lg shadow-soft-rose/20`.
- **Inactive State**: `bg-white text-gray-400 hover:bg-gray-50 hover:text-dark-wool border border-gray-100`.
- **Icons**: Use minimalist FontAwesome icons (`fa-chevron-left`, `fa-chevron-right`).
- **Interaction**: Subtle `hover:-translate-y-0.5` and `active:scale-95`.

## Implementation
- All paginated links MUST be wrapped in a container with `flex items-center justify-center gap-2`.
- Ensure appropriate spacing (`mt-12`) from the content grid or table.

---

# 🧭 Navigation System

## Desktop Navbar

- Transparent floating glass effect
- Rounded-full container
- Sticky scrolling behavior

### Admin/Superadmin Sidebar
- Collapsible architecture (Alpine.js)
- Responsive overlay on mobile
- Transition-all duration-300
- Custom bar-staggered toggle

---

## Analytics & Summary Widgets
- Compact summary cards (3-column horizontal on desktop)
- Iconic indicators with color-coded accents
- High-contrast value display

---

# 📱 Mobile Experience

## Mobile Overlay
- Backdrop blur (blur-sm)
- Semi-transparent dark wool (bg-dark-wool/20)
- Smooth fade transition
- Global tap-to-close behavior for sidebar

---

# 📊 Dashboard Design Language

Admin and Superadmin dashboards use:

- Large analytics cards
- Detailed report categorization (Sales, Stock, Activity)
- Export-focused UI with visual feedback
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
| Product Card | `1:1` (Mobile) / `4:5` (Desktop) |
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
