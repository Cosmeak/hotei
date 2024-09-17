up:
	./vendor/bin/sail up -d

build:
	./vendor/bin/sail build --no-cache

down:
	./vendor/bin/sail down -v

migrate:
	./vendor/bin/sail php artisan migrate

key-gen:
	./vendor/bin/sail php artisan key:generate

npm-install:
	./vendor/bin/sail npm install

run-dev:
	./vendor/bin/sail npm run dev
