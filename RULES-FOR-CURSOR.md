# Rules for Local Development (Cursor)

This Laravel project is a **read-only snapshot** of the production site. You do **not** have access to the production database, backend services, or deployment environment. This project is configured for **local preview only** using Laravel Herd.

---

## ✅ What You _Can_ Do Locally

- Edit Blade templates (`resources/views`)
- Edit static assets (CSS/JS in `public/` or `resources/`)
- Use `npm run dev` to recompile front-end assets (Laravel Mix)
- Preview layout and style changes by running:
  ```bash
  php artisan serve
  ```
