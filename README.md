# Vue First Project

A full-stack practice project with a Vue 3 dashboard built using Quasar, TypeScript, and Pinia. The client includes sign-in, profile, user-list, and post-management screens. The Laravel 9 server includes Passport OAuth, role and permission models, and database migrations.

## Project layout

| Directory | Contents |
| --- | --- |
| [clientSide](clientSide/) | Quasar application, router, stores, and dashboard components |
| [serverSide](serverSide/) | Laravel application, models, configuration, and database setup |

## Local development

In `clientSide`, install dependencies with `npm install` and launch Quasar with `npx quasar dev`. The package declares Node.js 14.19, 16, or 18 compatibility.

In `serverSide`, install Composer dependencies, copy `.env.example` to `.env`, configure a local MySQL database, and run `php artisan key:generate` and `php artisan migrate`. The project requires PHP 8.0.2 or later within the Composer constraint. Set up Passport using the steps below. The client expects the Laravel API at `http://localhost:8000`. Some dashboard calls require routes beyond the server's checked-in API route file.

## Configure local sign-in

1. In `serverSide`, run `php artisan passport:keys` to generate a local signing key pair in the ignored `storage` directory.
2. Run `php artisan passport:client --password` and add the resulting client ID and secret to the server's `.env` as `AUTH_WEB_CLIENT_ID` and `AUTH_WEB_CLIENT_SECRET`.
3. Set `SEED_ADMIN_EMAIL` and `SEED_ADMIN_PASSWORD` before running `php artisan db:seed` on a fresh database. Choose a distinct local password between 12 and 72 bytes.
4. Start Laravel with `php artisan serve` from `serverSide`. The Quasar client sends login requests to Laravel, which adds the Passport client secret on the server.
