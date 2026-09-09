
# Monster CRUD

A simple Laravel CRUD application for managing monsters with image uploads.

## Requirements

* PHP 8.2+
* Composer
* Node.js & npm
* MySQL

## Installation

Clone the repository:

```bash
git clone <repository-url>
cd monster-crud
```

Install dependencies:

```bash
composer install
npm install
```

Create the environment file and generate the application key:

```bash
cp .env.example .env
php artisan key:generate
```

Configure your database in `.env`, then run:

```bash
php artisan migrate
php artisan storage:link
```

## Run the project

Start the Laravel server:

```bash
php artisan serve
```

Compile frontend assets:

```bash
npm run dev
```

The application will be available at:

<text size=sm>`http://127.0.0.1:8000`</text>

## Useful Commands

| Command                      | Purpose                   |
| ---------------------------- | ------------------------- |
| `php artisan serve`          | Start development server  |
| `php artisan migrate`        | Run database migrations   |
| `php artisan migrate:fresh`  | Recreate the database     |
| `php artisan storage:link`   | Create storage symlink    |
| `php artisan route:list`     | View registered routes    |
| `php artisan optimize:clear` | Clear Laravel caches      |
| `npm run dev`                | Compile frontend assets   |
| `composer install`           | Install PHP dependencies  |
| `npm install`                | Install Node dependencies |
