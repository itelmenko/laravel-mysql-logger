## Laravel Monolog MySQL Handler.

This package will log errors into MySQL database instead `storage/log/laravel.log` file.

### Installation

~~~
composer require itelmenko/laravel-mysql-logger
~~~

If you wish to change default table name to write the log into or database connection use following definitions in your .env file

~~~
DB_LOG_TABLE=logs
DB_LOG_CONNECTION=mysql
~~~

For Laravel `< 5.5` open up `config/app.php` and find the `providers` key.

~~~
'providers' => array(
    // ...
    ITelmenko\Logger\Laravel\Providers\MonologMysqlHandlerServiceProvider::class,
);
~~~

Publish config using Laravel Artisan CLI.

~~~
php artisan vendor:publish
~~~

Migrate tables.

~~~
php artisan migrate
~~~

## Using

### In config/logging.php
```php
<?php
    // [...]

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['mysql'],
        ],

        // [...]

        'mysql' => [
            'driver' => 'custom',
            'via' => ITelmenko\Logger\Laravel\Logging\MySQLLogger::class,
            'connection' => env('DB_LOG_CONNECTION'),
            'table' => env('DB_LOG_TABLE'),
            'name' => 'my.channel' // optional
        ],
    ],
```

### Somewhere in your application

```php
Log::channel('mysql')->info('Something happened!');
```

## TODO

* Change `$table->bigIncrements('id')` to something like UIID.
* ~~Change root namespace to~~ `ITelmenko`
* ~~Remove `extra` fields from model~~
* ~~Remove updated_at?~~
* ~~Add microseconds for created_at~~
* Update version and readme.md (about a changing of migration, about vendor:publish)
* Add `php doc`
* Add phpcs

