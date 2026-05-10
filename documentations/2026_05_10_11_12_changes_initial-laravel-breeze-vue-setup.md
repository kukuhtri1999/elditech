# Initial Project Setup & Architecture

## What was done
1. Initialized a new Laravel 11 project.
2. Installed Laravel Breeze with Vue & Inertia.js stack.
3. Enabled Dark Mode and SSR options during Breeze installation.
4. Installed required node dependencies (`npm install`) and fixed a build issue related to a missing `bootstrap.js`.
5. Created the database migration for `posts` table with JSON columns for multi-language support (English and Indonesian).
6. Created the `Post` model with `$fillable` array and `$casts` for `array` to seamlessly handle JSON attributes.
7. Ran the database migrations (using SQLite for initial development as it's default in Laravel 11).

## Results
- Project foundation is solid with the TALL/VILT stack.
- Database is prepared to store translated content using JSON columns, avoiding complex join tables for simple blog post translations.
- Front-end assets build successfully via Vite.

## Concept of Development
- **Database Strategy**: For multi-language support, storing content in JSON columns (`title`, `slug`, `content`, `excerpt`) within the main table is highly efficient for read-heavy operations like blog posts compared to separate translation tables. We can query `title->en` or `title->id`.
- **UI/UX Strategy**: Building upon the generated Tailwind setup to enforce a dark-centric theme, specifically configuring the requested `#0A0A0A` background and `#9DFF20` accent.
- **Routing Strategy**: We'll construct localization middleware that intercepts `/en/` and `/id/` prefixes, falling back to English default if absent.

## Suggestions for Next Steps
1. Configure Global Localization Middleware to read the locale from the URL.
2. Set up the Tailwind CSS customized config with Zeniqs Style colors and fonts.
3. Create the Main Layout for the Public Frontend with a language switcher.
4. Implement the Admin Dashboard using Laravel Breeze's authenticated scaffolding, introducing TipTap rich text editor.
