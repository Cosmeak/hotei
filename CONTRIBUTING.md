## Our technical stack

- Laravel     - [Doc](https://laravel.com/docs/11.x/) 
- Inertia     - [Doc](https://inertiajs.com/)
- VueJS       - [Doc](https://vuejs.org/)
- TypeScript  - [Doc](https://www.typescriptlang.org/docs/)
- TailwindCSS - [Doc](https://tailwindcss.com/docs)
- Shadcn      - [Doc](https://www.shadcn-vue.com/)

We also use:
- **Docker** for local development and environment consistency
- **Makefile** for streamlined developer commands

## Conventions

- **Git commits** follow [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/)
- **PHP & Laravel** follow [Spatie’s guidelines](https://spatie.be/guidelines/laravel-php)
- **TypeScript** follows the [Google Style Guide](https://google.github.io/styleguide/tsguide.html)
- **VueJS** aligns with Vue's official documentation

## Installation

0. Requirements:

- Unix-based OS (Linux/macOS)
- PHP ≥ 8.2
- Composer v2.7+
- Node v20 (LTS)
- Docker + Docker Desktop

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
