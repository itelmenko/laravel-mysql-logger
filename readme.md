## Laravel Monolog MySQL Handler.

This package will log errors into MySQL database instead storage/log/laravel.log file.

### Installation

~~~
composer require itelmenko/laravel-mysql-logger
~~~

If you wish to change default table name to write the log into or database connection use following definitions in your .env file

~~~
DB_LOG_TABLE=logs
DB_LOG_CONNECTION=mysql
~~~

Open up `config/app.php` and find the `providers` key.

~~~
'providers' => array(
    // ...
    Logger\Laravel\Provider\MonologMysqlHandlerServiceProvider::class,
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

### config/logging.php
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
            'via' => App\Logging\MySQLLogger::class,
        ],
    ],
```

### app/Logging/MySQLLogger.php

```php
<?php
namespace App\Logging;

use Exception;
use Monolog\Logger;
use Logger\Monolog\Handler\MysqlHandler;

class MySQLLogger
{
    /**
     * Create a custom Monolog instance.
     *
     * @param  array $config
     * @return Logger
     * @throws Exception
     */
    public function __invoke(array $config)
    {
        $channel = $config['name'] ?? env('APP_ENV');
        $monolog = new Logger($channel);
        $monolog->pushHandler(new MysqlHandler());
        return $monolog;
    }
}

```

### Somewhere in your application

```php
Log::channel('mysql')->info('Something happened!');
```

## Credits

Based on:

- [N.M. Gilg4mesh](https://raw.githubusercontent.com/Gilg4mesh/monolog-mysql/) 
