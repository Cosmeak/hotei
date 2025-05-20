
<h1 align="center">Hotei</h1>

The platform to learn a lot of craftmanship hobbies.

## Table of Contents

- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [Commands](#commands)
- [Standards / Guidelines](#standard-guidelines)

## Tech Stack

**Client:** [VueJS](https://vuejs.org/), [Inertia](https://inertiajs.com/), [TypeScript](https://www.typescriptlang.org/docs/), [Shadcn](https://www.shadcn-vue.com/), [TailwindCSS](https://tailwindcss.com/docs)

**Server:** PHP 8.3, [Laravel](https://laravel.com/docs/), PostgreSQL


## Installation

0. **Prerequisites**

All you need is Docker and git (+ a Code Editor if you want to contribute).

*optional: [just](https://github.com/casey/just) for command helper*

1. **Fork the Repository**

```sh
git clone git@github.com:cosmeak/hotei.git
cd hotei
```
    
2. **Development Environment**

```bash
docker compose up -d 
```

## Commands

You can get all recipes using the `just` command and running one of the available commands below with `just <command>`:

```sh
Available recipes:
  start                       # Start development servers (inside docker)
  stop                        # Stop all containers
  install                     # Run all needed scripts/command on the first installation
```

## Standards / Guidelines

### a. Code Style Guidelines

- PSR-12.
- Laravel guidelines (with pint) + [Laraverse](https://laraverse.net/wiki).
- Official VueJS and TypeScript style guides.

### b. Commit Message Guidelines

This project follow the "[Conventional Commits](https://www.conventionalcommits.org/)" specifications:

```
<type>(<scope>): <description>

[optional body]

[optional footer(s)]
```

Types include:
- `feat`: A new feature
- `fix`: A bug fix
- `docs`: Documentation changes
- `style`: Code style changes (formatting, etc.)
- `refactor`: Code changes that neither fix bugs nor add features
- `test`: Adding or modifying tests
- `chore`: Changes to the build process or auxiliary tools

### c. Branch Guidelines

Like the commit guideline, the branches must follow the type pattern:

```
<type>/<reason>
```

Types are the same as commits.

The `reason` can be the feature name, the bug fix, etc... So make it clear on what you are :)

On top of all this, there is two branches always present: 
- `production`: branches used for continuous deployements 
- `develop`: central branch of development

### d. Pull Request Process

1. Push all your code on one branch.
2. Open the Pull Request compared to `develop`.
3. CIs must be validated (tests and lint).
4. PRs require approval from at least one maintainer.
5. Once approuved, squash and merge.

### e. Production deployments

1. Create a PR from `develop` to `production`.
2. This PR need to be approved by `cosmeak`.
3. Merge it to production.
4. Let the CD make it's magic (but keep an eye on it, we're never safe from a remaining bug).
5. Enjoy your coffee (most important part).