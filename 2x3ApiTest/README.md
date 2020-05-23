## 2x3ApiTest
API Test Laravel

### Requirements
- PHP >= 7.3.x
- Composer
- Mysql
- Laravel 6.x [Laravel Requirements](https://laravel.com/docs/6.x/installation)

### Install and Config

`sh
	$ composer install 
	$ composer dump-autoload
	$ cp .env.example .env
	$ mysql -u $USER -p -e ./database/utils/database.sql
	$ php artisan migrate
	$ php artisan serve
`


#### Execute a Queue Jons
`sh
	$ php artisan queue:work --stop-when-empty
`









