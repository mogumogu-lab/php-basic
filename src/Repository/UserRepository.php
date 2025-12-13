<?php

namespace App\Repository;

use App\Entity\User;
use Config\Database;
use PDO;

/**
 * Spring의 Mapper/Repository 역할
 * DB와 직접 통신하는 계층
 */
class UserRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    /**
     * 사용자 저장 (INSERT)
     */
    public function save(User $user): User
    {
        $sql = "INSERT INTO users (name, email) VALUES (:name, :email) RETURNING id, created_at";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $user->getName(),
            ':email' => $user->getEmail(),
        ]);

        $result = $stmt->fetch();
        $user->setId($result['id']);
        $user->setCreatedAt($result['created_at']);

        return $user;
    }

    /**
     * 전체 사용자 조회 (SELECT ALL)
     */
    public function findAll(): array
    {
        $sql = "SELECT * FROM users ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);

        $users = [];
        while ($row = $stmt->fetch()) {
            $users[] = $this->mapToEntity($row);
        }

        return $users;
    }

    /**
     * ID로 사용자 조회 (SELECT ONE)
     */
    public function findById(int $id): ?User
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch();
        return $row ? $this->mapToEntity($row) : null;
    }

    /**
     * DB row -> Entity 변환
     */
    private function mapToEntity(array $row): User
    {
        $user = new User();
        $user->setId($row['id']);
        $user->setName($row['name']);
        $user->setEmail($row['email']);
        $user->setCreatedAt($row['created_at']);
        return $user;
    }
}