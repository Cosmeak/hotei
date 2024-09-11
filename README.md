# Hotei

## Tech Stack

- Laravel: https://laravel.com/docs/11.x/
- Inertia: https://inertiajs.com/
- VueJS: https://vuejs.org/
- TypeScript: https://www.typescriptlang.org/docs/
- TailwindCSS: https://tailwindcss.com/docs
- Shadcn: https://www.shadcn-vue.com/

## Conventions

- Git: https://www.conventionalcommits.org/en/v1.0.0/
- PHP & Laravel: https://spatie.be/guidelines/laravel-php
- TS: https://google.github.io/styleguide/tsguide.html
- VueJS: _voir doc_

## Installation

0. Requirements:

- unix system
- php v8.2 at least
- composer v2.7
- node v20 (LTS)

1. Download:

```bash
  git clone git@github.com:Cosmeak/hotei.git && cd hotei
```

2. Install dependencies

```bash
  composer install && npm install
```

3. Environnement variables

```bash
  cp .env.example .env.local
```

4. Start Docker

```bash
  ./vendor/bin/sail up -d
```

> [!NOTE]
> You need to have docker desktop open.

5. Migrate database

```bash
  ./vendor/bin/sail artisan migrate
```

6. Frontend build

```bash
  ./vendor/bin/sail npm run dev
```

7. Code

You are ready to go!
