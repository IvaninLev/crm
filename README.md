## CRM (Laravel 12 + Inertia/Vue 3)

Lightweight CRM-style app with auth, role-based user management, and personal task tracking. Backend is Laravel 12, frontend is Inertia + Vue 3 with Vite. Sessions/caching default to Redis when running via Sail; fall back options are documented below.

### Features
- Authentication with email verification flow and user profiles.
- Admin-only user CRUD with avatar upload.
- Personal todo/tasks with status tracking (list, create, edit, view, delete).
- Inertia single-page experience; toast notifications; Tailwind utility styling.

### Quick Start (local, no Docker)
1. `cp .env.example .env`
2. Set `APP_KEY` via `php artisan key:generate`.
3. For a self-contained dev run, switch storage drivers in `.env`:
   - `SESSION_DRIVER=array`
   - `CACHE_STORE=array`
   - `QUEUE_CONNECTION=sync`
   - (Optional) set `DB_CONNECTION=sqlite` and `DB_DATABASE=database/database.sqlite` then `touch database/database.sqlite`.
4. Install deps: `composer install` and `npm install`.
5. Run migrations + seed admin: `php artisan migrate --seed`.
6. Start servers: in one terminal `php artisan serve`, in another `npm run dev`.
7. Login with seeded admin `test@admin.com` / `abcd1234`.

### Quick Start (Docker/Sail)
1. `cp .env.example .env` and set `APP_KEY` (`php artisan key:generate`).
2. Ensure `DB_CONNECTION=mysql`, `SESSION_DRIVER=redis`, `CACHE_STORE=database`, `REDIS_HOST=redis` (defaults already in `docker-compose.yml`).
3. `./vendor/bin/sail up -d`
4. `./vendor/bin/sail artisan migrate --seed`
5. Frontend: `./vendor/bin/sail npm install && ./vendor/bin/sail npm run dev` (or `build`).

### Tests
- Fast feature tests without external services: `DB_CONNECTION=sqlite DB_DATABASE=:memory: SESSION_DRIVER=array CACHE_STORE=array php artisan test --testsuite=Feature`.

### Tech Stack
- PHP 8.4+, Laravel 12, Sanctum, InertiaJS, Vue 3, Vite, Tailwind utility classes, Redis/MySQL (via Sail), Mailpit for mail capture.

### Known Local Setup Pitfalls
- If you are not running Redis, set `SESSION_DRIVER=array` and `CACHE_STORE=array` (as in the quick start) to avoid `getaddrinfo redis` errors.
- If using SQLite, keep `FILESYSTEM_DISK=local` and ensure `storage/` is writable.

### For Recruiters
- Purpose: demo-grade CRM with auth, role-based access, and task management.
- Entry points: `/login` then dashboard at `/` (Inertia SPA). Admins can manage users at `/users`; tasks live under `/tasks`.
- Seeded admin: `test@admin.com` / `abcd1234` after `php artisan migrate --seed`.
