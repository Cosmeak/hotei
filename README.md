# Hotei

> E-learning platform for creative hobbies, built with artisans, for curious minds.
> Learn at your own pace, from your home, with expert-led, project-based video courses in crafts like embroidery, leatherwork, crochet, and more.

##  What is Hotei?

Hotei is a e-learning platform focused on DIY and creative arts. We help users learn artisanal skills through structured, accessible video courses designed by professional artisans.

- 📚 Each course is split into clear, progressive steps
- 🎨 No prior experience required
- 🎥 Learn from real artisans, at your own pace
- 💡 Use "craftouts" (our internal credit system) to access content
- 💬 Ask artisans questions directly, engage with the community

## Core Features

- 🎬 Access on-demand artisan video courses  
- 🛍️ Purchase courses using internal credits ("Craftouts")  
- 🧑‍🎨 Artisan profiles & direct Q&A  
- 🔍 Smart filtering & course search  
- 🧵 Free trial courses per category  
- 📦 Material recommendations via affiliate partners  
- 🏆 Gamification system (badges, milestones) *(coming soon)*  

## Vision & Roadmap

- ✅ MVP developed and tested with real users  
- 🔜 Artisan onboarding, video production & marketing launch  
- 🚀 Version 2: More features, broader content, and refined UX  


## 📣 Social & Brand

Follow us and stay in the loop:
- Instagram: [@hotei_learning](https://www.instagram.com/hotei_learning/)

---

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
