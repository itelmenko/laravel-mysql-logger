<?php

namespace ITelmenko\Logger\Laravel\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Log extends Model {

    use HasUuids;

    const UPDATED_AT = null;

    protected $dateFormat = 'Y-m-d H:i:s.u';

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

    public function __construct(array $attributes = array())
    {
        $this->table      = config('logging.channels.mysql.table');
        $this->connection = config('logging.channels.mysql.connection');

        parent::__construct($attributes);
    }

    public function newUniqueId()
    {
        return (string) Str::ulid();
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
