# Frontend UI & Localization

## What was done
1. Set up Tailwind CSS configuration with Zeniqs Style: Background `#0A0A0A` (deep charcoal) and Accent `#9DFF20` (neon/lime green).
2. Created a global localization middleware (`SetLocale.php`) that uses the first URL segment to determine the locale (`en` or `id`) and configured `bootstrap/app.php` to register it.
3. Overhauled `routes/web.php` to include prefix grouping for `{locale}`.
4. Created `PublicLayout.vue` with a sticky glassmorphic navbar and language switcher.
5. Implemented `Welcome.vue` (Home page) with a high-end UI, impact stats, and gradient typography.
6. Created `Services.vue` and `Portfolio.vue` with placeholder content mapped to translations.
7. Updated Inertia shared props in `HandleInertiaRequests.php` to pass `locale` and `currentRouteName` globally.

## Results
- The application now supports `en` and `id` locales dynamically via URLs like `/en/services` or `/id/services`.
- The design strictly adheres to the requested premium tech feel.

## Concept of Development
- **Glassmorphism**: Achieved using `backdrop-blur-xl bg-white/5` across cards to give a modern, clean look.
- **Micro-interactions**: Added hover states `hover:-translate-y-2` on cards to make the UI feel alive.
- **Inertia Props**: Instead of passing locale to every component, we bind it to the Inertia root using `HandleInertiaRequests`, making it accessible globally via `$page.props.locale`.

## Suggestions for Next Steps
1. Create the `Posts/Index` and `Posts/Create` pages for the Admin dashboard.
2. Integrate TipTap or CKEditor for the rich text capability on dual-language fields.
