init: docker-up app-init
start: docker-up app-start
restart: docker-down docker-up app-start
build: docker-build
stop: docker-down
migrate: app-migrate
rollback: app-rollback
seed: app-seed
test: app-tests

docker-up:
	docker compose up -d

docker-build:
	docker compose exec php-fpm composer install
	docker compose build

docker-down:
	docker compose down --remove-orphans

app-init:
	cp .env.example .env
	docker compose exec php-fpm composer install
	docker compose exec php-fpm php artisan key:generate
	docker compose exec php-fpm php artisan migrate
	docker compose exec php-fpm php artisan storage:link
	docker compose exec php-fpm php artisan db:seed
	docker compose exec node yarn install
	docker compose restart

app-start:
	docker compose exec node yarn run dev

php-bash:
	docker compose exec php-fpm bash

node-bash:
	docker compose exec node bash

permissions:
	sudo chmod -R 777 storage
	sudo chmod -R 777 bootstrap/cache

clear:
	docker compose exec php-fpm php artisan cache:clear
	docker compose exec php-fpm php artisan config:clear
	docker compose exec php-fpm php artisan view:clear
	docker compose exec php-fpm php artisan route:clear

app-migrate:
	docker compose exec php-fpm php artisan migrate --force

app-rollback:
	docker compose exec php-fpm php artisan migrate:rollback

app-seed:
	docker compose exec php-fpm php artisan db:seed

app-tests:
	docker compose exec php-fpm php artisan test --stop-on-failure

