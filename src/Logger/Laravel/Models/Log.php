<?php

namespace Logger\Laravel\Models;

use Illuminate\Database\Eloquent\Model;


class Log extends Model {

    protected $fillable = [
        'instance',
        'channel',
        'message',
        'level',
        'context'
    ];

    protected $casts = [
        'context' => 'array',
        'extra'   => 'array'
    ];

    public function __construct(array $attributes = array())
    {
        $this->table      = config('logging.channels.mysql.table');
        $this->connection = config('logging.channels.mysql.connection');

        parent::__construct($attributes);
    }

    public function changeConnection(string $db_connection)
    {
        $this->connection = $db_connection;
    }

    public function changeTable(string $table_name)
    {
        $this->table = $table_name;
    }
}
