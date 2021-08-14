## Описание

Laravel MVC приложение с CRUD операциями и REST API.

- Аутентификация:
    - Laravel/Fortify - WEB
    - Laravel/Sanctum - API
- Администратор /admin/*:
    - username: admin 
    - password: admin
- Обычный пользователь:
    - username: user
    - password: user

## Установка

Install [Composer](https://getcomposer.org/download/)
```sh
git clone https://github.com/aci30/laravel-mvc.git
cd laravel-mvc
composer install
```
If composer install fails
> sudo apt install php-xml
> 
> sudo apt install php-mbstring

***

Copy `.env` and generate key
```sh
cp .env.example .env
php artisan key:generate
```
Change default database from MySQL to SQLite in `.env`
```
...
DB_CONNECTION=sqlite
DB_FOREIGN_KEYS=true
...
```

Prepare database file
```sh
touch database/database.sqlite
```

***

Migrate and seed database
```sh
php artisan migrate --seed
```
If migration fails
> sudo apt-get install php-sqlite3

***

And finally start
```sh
php artisan serve
```
Go to `localhost:8000`
