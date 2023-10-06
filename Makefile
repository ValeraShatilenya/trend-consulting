init: docker-up app-init
start: docker-up app-start
restart: docker-down docker-up app-start
build: docker-build
stop: docker-down

docker-up:
	docker compose up -d

docker-build:
	docker compose exec php-fpm composer install
	docker compose build

docker-down:
	docker compose down --remove-orphans

app-init:
	docker compose exec php-fpm composer install
	docker compose exec php-fpm php artisan key:generate
	docker compose exec php-fpm php artisan storage:link
	docker compose exec node yarn install
	docker compose restart

app-start:
	docker compose exec node yarn run dev

php-bash:
	docker compose exec php-fpm bash

node-bash:
	docker compose exec node bash

permissions:
	chmod -R 777 storage
	chmod -R 777 bootstrap/cache

clear:
	docker compose exec php-fpm php artisan cache:clear
	docker compose exec php-fpm php artisan config:clear
	docker compose exec php-fpm php artisan view:clear
	docker compose exec php-fpm php artisan route:clear
