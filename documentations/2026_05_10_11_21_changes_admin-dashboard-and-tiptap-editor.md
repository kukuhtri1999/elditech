# Admin Dashboard & Multilingual Content Management

## What was done
1. Installed `@tiptap/vue-3` and `@tiptap/starter-kit` to integrate a modern Rich Text Editor.
2. Created a custom `TipTap.vue` component that wraps the editor logic and provides a beautiful toolbar with Bold, Italic, and Heading toggles, adhering to the dark theme.
3. Designed the `Posts/Create.vue` page utilizing a tabbed interface (English / Bahasa Indonesia) to allow seamless bilingual content entry side-by-side without cluttering the UI.
4. Bound the Input fields and the TipTap editor directly to a Laravel Inertia `useForm` object, passing dual language arrays (e.g., `title.en`, `title.id`).
5. Implemented the `Posts/Index.vue` page which lists the posts in an elegant table, showing both language titles and publishing status.
6. Compiled all assets utilizing Vite (`npm run build`).

## Results
- A functional, aesthetically pleasing admin interface for managing bilingual posts.
- The TipTap editor provides a seamless writing experience matching the exact design spec.
- The Vue composition structure cleanly separates concerns, making it modular and PSR-12/Vue-best-practices compliant.

## Concept of Development
- **Tabbed Interface**: Rather than having all inputs in one long scrollable page, wrapping the EN/ID specific fields in Vue `v-show` tabs drastically improves UX for content managers.
- **TipTap Headless Architecture**: By using TipTap, we maintain full control over the UI, easily styling the toolbar buttons to use the `text-accent` (`#9DFF20`) active state, perfectly aligning with the brand identity.

## Suggestions for Next Steps
1. In the `PostController`, write logic to handle Image Uploads (Feature Image & Gallery) and store them via Spatie Media Library or Laravel Storage.
2. Add validation rules in a Laravel Form Request for the Posts.
3. In `Welcome.vue` and `Portfolio.vue`, query the `Post` model to dynamically fetch published projects/articles and feed them as Inertia props.
