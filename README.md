## Используемые технологии
- PHP 8.3
- MySQL
- Laravel 11

## Установка
1. Клонируйте репозиторий
```
git clone https://github.com/artnovikov/vigilant-spork.git
```
2. Перейдите в папку проекта:
```
cd vigilant-spork
```
3. Установите зависимости:
```
composer install
```
4. Снегерируйте ключ:
```
php artisan key:generate
```
5. Настройте файл `.env`, указав доступ к базе данных.
```
DB_CONNECTION=mysql
DB_HOST=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
6. Выполните миграции:
```
php artisan migrate
```
7. Для наполнения вашей базы данных, выполните команду:
```
php artisan db:seed
```