<?php

namespace ITelmenko\Logger\Monolog\Handler;

use Exception;
use Monolog\Handler\AbstractProcessingHandler;
use ITelmenko\Logger\Laravel\Models\Log;
use ITelmenko\Logger\Laravel\Exceptions\MysqlLoggerInsertException;

class MysqlHandler extends AbstractProcessingHandler
{
    /**
     * @param array|Monolog\LogRecord $record
     * @return void
     */
    protected function write($record): void
    {
        try {
            Log::create([
                'instance'    => gethostname(),
                'channel'     => $record['channel'],
                'message' => $record['message'],
                'level'   => $record['level_name'],
                'context' => $record['context']
            ]);
        } catch (Exception $e) {
            throw new MysqlLoggerInsertException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
