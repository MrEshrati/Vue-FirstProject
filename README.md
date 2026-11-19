# Vue First Project

A full-stack practice project with a Vue 3 dashboard built using Quasar, TypeScript, and Pinia. The client includes sign-in, profile, user-list, and post-management screens. The Laravel 9 server includes Passport OAuth, role and permission models, and database migrations.

## Project layout

| Directory | Contents |
| --- | --- |
| [clientSide](clientSide/) | Quasar application, router, stores, and dashboard components |
| [serverSide](serverSide/) | Laravel application, models, configuration, and database setup |

## Local development

In `clientSide`, install dependencies with `npm install` and launch Quasar with `npx quasar dev`. The package declares Node.js 14.19, 16, or 18 compatibility.

In `serverSide`, install Composer dependencies, copy `.env.example` to `.env`, configure a local MySQL database, and run `php artisan key:generate` and `php artisan migrate`. The project requires PHP 8.0.2 or later within the Composer constraint. Use freshly generated Passport keys and local OAuth configuration. The client expects a local HTTPS API, and some dashboard calls require routes beyond the server's checked-in API route file.
