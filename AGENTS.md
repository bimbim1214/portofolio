# AGENTS — Laravel Portfolio ORBIS.NFT

## Quick commands

| Action | Command |
|--------|---------|
| Install / bootstrap fresh | `composer setup` then `npm run dev` |
| Run dev server (Laravel + Vite + queue) | `composer dev` |
| Run tests | `composer test` (clears config first) |
| Lint (pint) | `composer pint` |
| Type / style check | — (Laravel Pint handles formatting) |
| Clear config/cache | `php artisan config:clear` then `php artisan cache:clear` |

## Architecture

- **Laravel 13** (PHP 8.3) with Blade + Tailwind (Vite) frontend, MySQL.
- **Public entry**: `routes/web.php` defines public pages (`/`, `/projects`, `/download-cv`) and admin auth routes.
- **Models**: `Profile` (single row, injected into views), `Experience`, `Project`, `Certification`, `User` (admin Auth).
- **Controllers**: `AdminController` (login/logout/dashboard), `Admin\ProfileController`, `Admin\ExperienceController`, `Admin\ProjectController` — CRUD for portfolio content.
- **Views**: `resources/views/welcome.blade.php` (main ORBIS.NFT portfolio), `projects.blade.php` (archive table), `admin/login`, `admin/dashboard`.
- **Certificate modal**: Click any cert card → opens 150×150px square liquid-glass modal with image + close (X). Close via X button, overlay click, or ESC. Animates fade + zoom.
- **Data flow**: route → model query → `view('welcome', compact(...))`. Cards use `$cert->title`, `$cert->issuer`, `$cert->imageUrl` (derived from title: `images/certificates/{UPPER_CASE}_{UNDERSCORE}.jpg`).
- **File naming**: cert images in `public/images/certificates/` must match title-derived names (SENIOR_WEB_DEVELOPER.jpg, SOFTWARE_DEVELOPMENT.jpg). A typo was fixed: `SOFWARE_DEVELOPMENT.jpg` → `SOFTWARE_DEVELOPMENT.jpg`.

## Key directories

- `app/Models/` — Eloquent models (Profile, Experience, Project, Certification, User).
- `app/Http/Controllers/` — admin CRUD + auth.
- `database/migrations/` — schema (profiles, experiences, projects, certifications, users).
- `database/seeders/PortfolioSeeder.php` — seeders for Profile, Experiences, Projects, Certifications.
- `resources/views/welcome.blade.php` — main portfolio page (dynamic + modal).
- `resources/views/admin/` — admin UI.
- `public/images/certificates/` — certificate JPGs (must match cert titles).
- `routes/web.php` — all route definitions.

## Dev workflow

```bash
# Fresh setup (one-time)
composer setup   # installs deps, generates key, runs migrations, npm install + build

# Daily development
composer dev     # runs: php artisan serve, queue:listen, pail, npm run dev (concurrently)

# Iterate views
# Edit resources/views/welcome.blade.php → changes appear immediately (Laravel auto-compiles).

# Run tests (clears config first)
composer test

# Lint
composer pint    # runs Laravel Pint
```

## Common gotchas

- **Certificate image filenames** must derive from title: uppercase, spaces → underscores, `.jpg`. The `SOFWARE_DEVELOPMENT.jpg` typo was corrected to `SOFTWARE_DEVELOPMENT.jpg` — keep any new cert filenames consistent.
- **`$profile`** is always `Profile::first()`; the view crashes if no profile row exists.
- The welcome page reads `$experiences`, `$homeProjects`, `$certifications` from DB — all are optional; the UI has `@empty` fallbacks.
- **Admin login**: default credentials from seeder or check `database/seeders/PortfolioSeeder.php`; login uses `Auth::attempt(['name' => $username, 'password' => $password])`.
- **Modal click handling**: cert cards have `data-cert-src` and `data-cert-title` attributes. JS `openCertModal(el)` reads them and shows the 150×150px square modal. If you modify the modal markup, also update the JS listeners in `welcome.blade.php` DOMContentLoaded block.
- **Tailwind/Pint**: `composer pint` formats Blade and CSS. Run after editing views/JS.
- **No `resources/js/app.js` logic** beyond `lucide.createIcons()` — all interactivity lives inline in `welcome.blade.php`.

## What to avoid

- Don't add new Laravel routes without also adding them to `routes/web.php` middleware groups.
- Don't change certificate filenames without updating the `imageUrl` accessor in `app/Models/Certification.php` (or the modal will show broken images).
- Don't forget `php artisan view:cache` after bulk view edits if not using auto-reload in dev.