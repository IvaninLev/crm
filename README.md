## CRM (Laravel 12 + Inertia/Vue 3)

Lightweight CRM-style app with auth, role-based user management, and personal task tracking. Backend is Laravel 12, frontend is Inertia + Vue 3 with Vite. Sessions/caching default to Redis when running via Sail; fall back options are documented below.

### Features
- Authentication with email verification flow and user profiles.
- Admin-only user CRUD with avatar upload.
- Personal todo/tasks with status tracking (list, create, edit, view, delete).    
- Inertia single-page experience; toast notifications; Tailwind utility styling.

### 📦 Quick Start (Local Setup)

1. **Prepare environment:**
   bash
   cp .env.example .env
   # If not using Docker, update DB_* credentials in .env
Install PHP dependencies:
If you have PHP/Composer installed locally:

Bash
composer install
Build & Seed:
Bash
make up
make install-node-packages
make refresh
(to just seed database use make seed-db)
Run Application:

Bash
make start
Login with seeded admin: test@admin.com / abcd1234

### Tech Stack
- PHP 8.4+, Laravel 12, Sanctum, InertiaJS, Vue 3, Vite, Tailwind utility classes, Redis/MySQL (via Sail), Mailpit for mail capture.

### Known Local Setup Pitfalls
- If you are not running Redis, set `SESSION_DRIVER=array` and `CACHE_STORE=array` (as in the quick start) to avoid `getaddrinfo redis` errors.
- If using SQLite, keep `FILESYSTEM_DISK=local` and ensure `storage/` is writable.

### For Recruiters
- Purpose: demo-grade CRM with auth, role-based access, and task management.
- Entry points: `/login` then dashboard at `/` (Inertia SPA). Admins can manage users at `/users`; tasks live under `/tasks`.
- Seeded admin: `test@admin.com` / `abcd1234` after `make seed-db`.

## 📸 Previews
<details>
    <summary>Click to view screenshots</summary>
    <img width="1875" height="933" alt="image" src="https://github.com/user-attachments/assets/f8671ad6-fed8-4fbd-a3fb-32f79ad1d02b" />
    <img width="1875" height="933" alt="image" src="https://github.com/user-attachments/assets/4ede62b8-723b-4658-9a3a-0af537f2c2e1" />    
    <img width="1875" height="933" alt="image" src="https://github.com/user-attachments/assets/f253c24b-dc73-418a-a60f-2fd3644bac18" />
    <img width="1875" height="933" alt="image" src="https://github.com/user-attachments/assets/7be2960c-01b8-49d7-a28b-892a7b619491" />
    <img width="1875" height="933" alt="image" src="https://github.com/user-attachments/assets/e5424cc9-f69b-4e64-893c-baca5c4ca01c" />
    <img width="1875" height="933" alt="image" src="https://github.com/user-attachments/assets/2add112a-b2f0-4785-94be-4cbbbfccad58" />

</details>
