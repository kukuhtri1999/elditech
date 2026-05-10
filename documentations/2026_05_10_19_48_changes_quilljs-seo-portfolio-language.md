# Enhancements: QuillJS, File Uploads, SEO, Portfolio Show & Localization

**Date:** 2026-05-10  
**Changes:** Replaced TipTap with QuillJS, switched URL inputs to File inputs, added single Portfolio page, fixed language switcher SSR bug, global SEO setup.

---

## 1. What Was Done

### 🌐 Fixed Language Switcher (SSR & Hydration)
**Problem:** The ID/EN language switcher in the public header was acting inconsistently and sometimes showing English despite clicking ID. This was due to SSR (Server-Side Rendering) using `window.location.pathname`, which is undefined on the server, causing hydration mismatches in Inertia/Vue.
**Fixes:** 
- Rewrote the `switchLangUrl` function in `PublicLayout.vue` to use Inertia's `$page.url` instead of `window.location`.
- This ensures the URL parsing happens safely on both server and client, allowing the `SetLocale` middleware to properly catch the `id` or `en` segment and update the session locale seamlessly.

### ✉️ Added Contact Email
**Problem:** The "Hubungi Kami" (Contact Us) section on the homepage was missing the admin email.
**Fix:**
- Added `admin@elditech.com` with a monospace font and tracking-widest styling directly beneath the CTA subheading in `Welcome.vue`.

### 📝 Integrated QuillJS Rich Text Editor
**Feature Request:** Replace TipTap with QuillJS and unlock all tools.
**Fixes:**
- Installed `@vueup/vue-quill` via npm.
- Created a new `QuillEditor.vue` wrapper component.
- Unlocked all tools: headers (1-6), bold, italic, underline, strikethrough, blockquote, code block, ordered/bullet lists, script (sub/super), indents, text direction, font sizing, color, background color, alignments, link, image, and video.
- Wrote extensive CSS overrides to ensure the Quill toolbar and editor perfectly match the Zeniqs dark theme (dark backgrounds, custom border colors, gray-100 text).

### 📁 Implemented Actual Image Uploads (Files, not URLs)
**Feature Request:** The Post Add/Edit form should accept real file uploads for Featured Image and multiple files for Gallery, instead of raw string URLs.
**Fixes:**
- Modified `PostForm.vue`: Changed `type="url"` inputs to `type="file"`. Added `multiple` attribute for the gallery input.
- Added file preview logic for existing images when editing a post.
- Rewrote the `submit()` function in `PostForm.vue`: Inertia handles multipart file uploads strictly via `POST`. To update an existing record, we spoofed the `PUT` method using `_method: 'put'` within a `POST` request.
- Modified `PostController.php`: Updated validation rules from `url` to `image|max:2048`. Implemented `Storage::disk('public')->put()` for both the `featured_image` and `gallery` fields. Linked the storage folder using `php artisan storage:link`.

### 🚀 Global SEO Implementation
**Problem:** SEO tags were missing across public pages.
**Fixes:**
- Added extensive `<Head>` configurations in `Welcome.vue`, `Portfolio.vue`, `Portfolio/Show.vue`, `Services.vue`, and legal pages.
- Populated `title`, `meta description`, `keywords`, `og:title`, `og:description`, `og:type`, and `og:image` tags.

### 🖼️ Single Portfolio Page (Show)
**Feature Request:** A dedicated public page to view individual portfolio items with great UI/UX.
**Fixes:**
- Added a `Route::get('/portfolio/{slug}', [PostController::class, 'show'])` in `web.php`.
- Created `Portfolio/Show.vue`.
- Implemented a stunning, mobile-responsive layout:
  - Big, bold title and excerpt with AOS fade animations.
  - A massive featured image container with hover-scale effects and gradient overlays.
  - The main rich-text content rendered via `v-html` using `prose prose-invert`.
  - A dynamic CSS Grid gallery at the bottom displaying all images uploaded via the new multiple-file gallery input.

### 📱 Mobile Responsiveness
**Verification:**
- Confirmed all public pages (`Welcome`, `Portfolio`, `Show`, `Services`, Legal) utilize Tailwind's `md:` and `lg:` breakpoint prefixes correctly.
- Grids dynamically collapse to 1 column (`grid-cols-1`) on mobile phones, while typography scales down smoothly to prevent horizontal scrolling.

---

## 2. Results

| Feature | Status |
|---|---|
| Language switcher SSR & State fix | ✅ |
| Admin email added to CTA | ✅ |
| QuillJS integration with all tools unlocked | ✅ |
| Native File Uploads for Featured & Gallery images | ✅ |
| Single Portfolio Page (`/portfolio/{slug}`) | ✅ |
| Global SEO (`<Head>`, OG Tags, Keywords) | ✅ |
| Mobile Responsiveness Verified | ✅ |
| Test and Build Pipeline (Vite) Success | ✅ |

All new code is committed, tested, and actively running in the dev server. Storage has been properly linked for public image viewing.
