<?php
namespace App\Core;

use PDO;

abstract class Model
{
    protected static string $table;
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->pdo();
    }

    public function all(): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM " . static::$table);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM " . static::$table . " WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}