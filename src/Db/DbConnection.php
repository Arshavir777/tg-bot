<?php

namespace App\Db;

use PDO;

class DbConnection
{
    public $connection;

    public function __construct(string $host, int $port, string $user, string $pass, string $dbName)
    {
        $this->connection = new PDO("pgsql:host=$host;port=$port;dbname=$dbName", $user, $pass);
    }
}
