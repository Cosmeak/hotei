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




## laravel jobs
- video optimization to webm with h.264 codec
- separate audio and video
- transcription


# enter the docker container

```
docker compose exec  app sh

```

# terminal 1 , start the queue worker

```
pkill -f "queue:work" || true
```
```
php artisan queue:flush  
``` 
```
php artisan queue:work database \
    --queue=video,transcription \
    --timeout=0 \
    -vvv
```

# terminal 2, start the job with tinker

```
php artisan tinker
```

```
use App\Jobs\VideoOptimization;
VideoOptimization::dispatch(
    storage_path('app/videos/test.mp4'),
    'videos'
);
```


#  display active ffmpeg processes
```
ps -o pid,etime,args | grep '[f]fmpeg'
```

# display logs recorded in laravel.log with timestamps during job execution
```
tail -F storage/logs/laravel.log | grep -E '\[OPT\]|\[TRS\]'
```

# display the first 30 lines of the transcription 
```
head -n 30 storage/app/public/videos/en/transcription.txt 
```