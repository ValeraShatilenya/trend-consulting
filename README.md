## Основые зависимости

-   PHP - 8.1.23
-   Composer - 2.6.4
-   Laravel - 10.26.2
-   MySQL - 8.0
-   Node - 18
-   Vue - 3.3.4

## Задача

Необходимо создать сервис, в котором будет отображаться информация о доступной мебели в указанный период времени на указанном складе.  
Возможные типы мебели:

1.  Стол
2.  Стул
3.  Кресло

Возможные цвета мебели:

1. Белый
2. Черный

Не больше 6 различных вариантов.  
Возможные склады:

1. Склад 1
2. Склад 2

БД необходимо заполнить тестовыми данными, также в ней зарегистрированы перемещения мебели между складами(суммарно не больше 30 перемещений).  
Необходимо реализовать API для работы с данным сервисом, все запросы к БД необходимо реализовать посредством ORM

## Реализация

Таблицы:

1.  **products** (Товары)  
    1.1 id  
    1.2 name  
    1.3 created_at  
    1.4 updated_at
2.  **warehouses** (Склады)  
    1.1 id  
    1.2 name  
    1.3 created_at  
    1.4 updated_at
3.  **product_colors** (Цвета товаров)  
    1.1 id  
    1.2 name  
    1.3 hex  
    1.4 created_at  
    1.5 updated_at
4.  **product_types** (Типы товаров)  
    1.1 id  
    1.2 name  
    1.3 created_at  
    1.4 updated_at
5.  **locations** (Нахождение продуктов)  
    1.1 id  
    1.2 product_id  
    1.3 warehouse_id  
    1.4 period_start  
    1.5 period_end - nullable  
    1.6 created_at  
    1.7 updated_at

В один момент времени товар может находиться только на 1 складе.

Создана единственная страница просмотра по маршруту http://localhost:8080/locations.  
Реализован поиск по названию товара, дате и времени нахождания товара, складу.
Также добавлена мультиязычность и тёмная тема.

## Разворачивание

git clone https://github.com/ValeraShatilenya/trend-consulting.git

Если присутствует make на устройстве:

1. make init
2. Введите пароль устройства для доступа к папкам storage, bootstrap/cache
3. make start
4. Перейдите по ссылке http://localhost:8080/

Запуск тестов:  
make test

Если отсутствует make на устройстве:

1.  docker compose up -d
2.  cp .env.example .env
3.  docker compose exec php-fpm composer install
4.  docker compose exec php-fpm php artisan key:generate
5.  docker compose exec php-fpm php artisan migrate
6.  docker compose exec php-fpm php artisan storage:link
7.  docker compose exec php-fpm php artisan db:seed
8.  docker compose exec node yarn install
9.  docker compose restart
10. sudo chmod -R 777 storage
11. sudo chmod -R 777 bootstrap/cache

Запуск тестов:  
docker compose exec php-fpm php artisan test --stop-on-failure
