<?php

namespace App\Repository;

use App\Db\DbConnection;
use PDO;

class BaseRepository
{
    protected PDO $dbConnection;

    public function __construct(DbConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection->connection;
    }

    protected function executeQuery(string $query, array $params = []): mixed
    {
        $statement = $this->dbConnection->prepare($query);
        $statement->execute($params);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function executeStatement(string $query, array $params = []): bool
    {
        $statement = $this->dbConnection->prepare($query);

        return $statement->execute($params);
    }
}
