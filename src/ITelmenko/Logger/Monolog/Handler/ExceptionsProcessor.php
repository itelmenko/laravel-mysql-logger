<?php

namespace ITelmenko\Logger\Monolog\Handler;

class ExceptionsProcessor {

    public function __invoke($record) {
        if(!empty($record['context']['exception'])) {
            $e = $record['context']['exception'];
            if($e instanceof \Exception) {
                $record['context']['trace'] = $e->getTrace();
            }
        }
        return $record;
    }
}
