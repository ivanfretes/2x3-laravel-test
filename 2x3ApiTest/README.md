## 2x3ApiTest
API Test Laravel

### Requirements
- PHP >= 7.3.x
- Composer
- Mysql
- Laravel 6.x [Laravel Requirements](https://laravel.com/docs/6.x/installation)


#### Create database
```sh 
	$ mysql -u $USER -p < ./database/utils/database.sql 
```

where $USER is your user of the database or copy the below statements

```sql
	DROP DATABASE IF EXISTS dos_x_tres_test;
	CREATE DATABASE dos_x_tres_test CHARACTER SET UTF8mb4 COLLATE utf8mb4_bin;
```


#### Install and Config environment

```sh
	$ composer install 
	$ composer dump-autoload
	$ cp .env.example .env
	$ php artisan migrate
	$ php artisan serve
```


#### Execute a Queue Jobs
```sh
	$ php artisan queue:work --stop-when-empty
```









