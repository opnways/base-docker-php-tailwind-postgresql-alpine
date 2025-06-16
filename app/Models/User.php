<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class User extends Model
{
    protected static string $table = 'users';

    public function create(array $data): bool
    {
        $sql = "INSERT INTO " . static::$table . " (id, name, email, password) VALUES (:id, :name, :email, :password)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'id' => $data['id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    public function findByEmail(string $email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM " . static::$table . " WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}