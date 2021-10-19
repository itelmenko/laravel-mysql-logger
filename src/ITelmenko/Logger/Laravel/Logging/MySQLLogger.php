<?php
namespace ITelmenko\Logger\Laravel\Logging;

use Exception;
use ITelmenko\Logger\Monolog\Handler\ExceptionsProcessor;
use Monolog\Logger;
use ITelmenko\Logger\Monolog\Handler\MysqlHandler;

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
