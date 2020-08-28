<?php
namespace Logger\Laravel\Logging;

use Exception;
use Logger\Monolog\Handler\ExceptionsProcessor;
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
        $channel = $config['name'] ?? config('app.env');
        $monolog = new Logger($channel);
        $handler = new MysqlHandler();
        $handler->pushProcessor(new ExceptionsProcessor);
        $monolog->pushHandler($handler);
        return $monolog;
    }
}