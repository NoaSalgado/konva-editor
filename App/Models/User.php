<?php

declare(strict_types=1);

require __DIR__ . '/../DB/Database.php';

class User
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
        $this->db->setDatabase("konva_editor");
    }

    public function createUser(array $user)
    {
        $sql = "INSERT INTO users (name, email, password) VALUES(:name, :email, :password)";
        $params = [
            'name' => $user['username'],
            'email' => $user['email'],
            'password' => password_hash($user['password'], PASSWORD_BCRYPT)
        ];

        $this->db->query($sql, $params);

        session_regenerate_id();
        $_SESSION['user'] = $this->db->getLastId();
    }

    public function findUser(array $user)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $params = ['email' => $user['email']];

        return $this->db->query($sql, $params)->fetch(PDO::FETCH_ASSOC);
    }

    public function identifyUser(array $user)
    {
        $foundUser = $this->findUser($user);
        $passwordsMatch = password_verify($foundUser['password'], $user['password']);

        session_regenerate_id();
        $_SESSION['user'] = $foundUser['id'];

        return $passwordsMatch;
    }

    public function emailAlreadyExist(array $user)
    {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        $params = ['email' => $user['email']];

        return $this->db->query($sql, $params)->fetchColumn();
    }
}
