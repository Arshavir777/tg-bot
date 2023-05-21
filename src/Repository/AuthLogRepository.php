<?php

namespace App\Repository;

use App\Entity\AuthLog;

class AuthLogRepository extends BaseRepository
{
    public $table = 'auth_logs';

    public function saveAuthLog($authActionData): mixed
    {
        $query = "
            INSERT INTO {$this->table} (user_id, action)
            VALUES (:user_id, :action)
            RETURNING *
        ";

        $result = $this->executeQuery($query, $authActionData);
        $authLogData = $result[0];
        return new AuthLog($authLogData);
    }

    public function findByUserId(string $userId): mixed
    {
        $query = "
           SELECT * FROM {$this->table} WHERE user_id = :user_id
        ";
        $params = [
            'user_id' => $userId
        ];

        $result = $this->executeQuery($query, $params);
        $authLogs = [];

        foreach ($result as $item) {
            $authLogs[] = new AuthLog($item);
        }
        return $authLogs;
    }
}
