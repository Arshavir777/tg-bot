<?php

namespace App\Repository;

use App\Entity\User;

class UserRepository extends BaseRepository
{
    public $table = 'users';

    public function findById(mixed $id): ?User
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $result = $this->executeQuery($query, ['id' => $id]);

        if (count($result)) {
            return new User($result[0]);
        }

        return null;
    }
    
    public function findUserByTgId(int $tgId): ?User
    {
        $query = "SELECT * FROM {$this->table} WHERE tg_id = :tg_id";
        $params = ['tg_id' => $tgId];
        $result = $this->executeQuery($query, $params);

        if (count($result)) {
            return new User($result[0]);
        }

        return null;
    }

    public function saveUser($userDto): mixed
    {
        $query = "
            INSERT INTO {$this->table} (tg_id, first_name, last_name, username, is_bot, language_code)
            VALUES (:tg_id, :first_name, :last_name, :username, :is_bot, :language_code)
            RETURNING *
        ";

        $params = [
            'tg_id' => $userDto->id,
            'first_name' => $userDto->first_name,
            'last_name' => $userDto->last_name,
            'username' => $userDto->username,
            'is_bot' => (int)$userDto->is_bot,
            'language_code' => $userDto->language_code,
        ];

        $result = $this->executeQuery($query, $params);
        return new User($result[0]);
    }
}
