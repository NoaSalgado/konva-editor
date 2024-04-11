<?php

declare(strict_types=1);

class Database
{
    public PDO $conn;
    public function __construct()
    {
        $dbConfig = require __DIR__ . '/db-config.php';
        $dsn = "{$dbConfig['driver']}:host={$dbConfig['host']};port={$dbConfig['port']}";

        try {
            $this->conn = new PDO($dsn, "{$dbConfig['username']}", "{$dbConfig['password']}");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function setDatabase(string $db): void
    {
        $sql = "USE {$db}";
        $this->query($sql);
    }

    public function query(string $query, array $params = [])
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Query failed to execute: " . $e->getMessage());
        }
    }

    public function getLastId()
    {
        return $this->conn->lastInsertId();
    }
}
