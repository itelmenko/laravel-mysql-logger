<?php

namespace Logger\Monolog\Handler;

use DB;
use Illuminate\Support\Facades\Auth;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use Logger\Laravel\Models\Log;

class MysqlHandler extends AbstractProcessingHandler
{

    protected function write(array $record)
    {
        Log::create([
            'instance'    => gethostname(),
            'env'     => $record['channel'],
            'message' => $record['message'],
            'level'   => $record['level_name'],
            'context' => $record['context'] // 'context'     => json_encode(array_map("utf8_encode", $record['context'] )),
        ]);
    }
} 
