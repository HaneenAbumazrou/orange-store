<?php

class Database
{
    // private $host = 'localhost';
    // private $dbName = 'php-mvc';
    // private $username = 'root';
    // private $password = '';
    private $pdo;
    private static $instance = null;

    // Constructor is private to prevent direct creation of the object
    private function __construct()
    {
        try {
            $dsn = "mysql:host={$_ENV['host']};dbname={$_ENV['dbName']}";
            $this->pdo = new PDO($dsn, $_ENV['username'], $_ENV['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Database connection established successfully.\n";
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    // Singleton pattern: Create a single instance of the Database class
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Get the PDO object to perform queries
    public function getConnection()
    {
        return $this->pdo;
    }

    // Prevent cloning of the instance
    private function __clone() {}
}

?>
