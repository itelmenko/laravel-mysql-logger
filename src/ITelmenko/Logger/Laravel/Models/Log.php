<?php

namespace ITelmenko\Logger\Laravel\Models;

use Illuminate\Database\Eloquent\Model;
use Rorecek\Ulid\HasUlid;


class Log extends Model {

    use HasUlid;

    protected $fillable = [
        'instance',
        'channel',
        'message',
        'level',
        'context'
    ];

    protected $casts = [
        'context' => 'array',
    ];

    protected $dateFormat = 'Y-m-d H:i:s.u';

    const UPDATED_AT = null;

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
