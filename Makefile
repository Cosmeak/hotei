up:
	./vendor/bin/sail up -d

build:
	./vendor/bin/sail build --no-cache

down:
	./vendor/bin/sail down -v

run-dev:
	./vendor/bin/sail npm run dev

migrate:
	./vendor/bin/sail php artisan migrate
