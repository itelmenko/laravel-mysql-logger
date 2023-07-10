<?php

namespace ITelmenko\Logger\Monolog\Handler;

use Monolog\Handler\AbstractProcessingHandler;
use ITelmenko\Logger\Laravel\Models\Log;

class MysqlHandler extends AbstractProcessingHandler
{
    /**
     * @param array|Monolog\LogRecord $record
     * @return void
     */
    protected function write($record): void
    {
        Log::create([
            'instance'    => gethostname(),
            'channel'     => $record['channel'],
            'message' => $record['message'],
            'level'   => $record['level_name'],
            'context' => $record['context']
        ]);
    }
}
