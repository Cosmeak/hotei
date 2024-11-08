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

2. Environment variables

```bash
  cp .env.example .env.local
```

3. Start Docker

```bash
  make up
```

4. Generate key-pair
```bash
  make key-gen
```

> [!NOTE]
> You need to have docker desktop open.

5. Migrate database

```bash
  make migrate
```

6. Frontend dependencies

```bash
  make npm-install
```

7. Run frontend server
```bash
  make run-dev
```

8. Code

You are ready to go!
