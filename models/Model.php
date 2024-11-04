<?php
// namespace MyApp\Models;
class Model
{
    protected $pdo;
    protected $table;

    public function __construct($table)
    {
        $this->table = $table;

        // Load database credentials from environment variables
        $host = $_ENV['host'];
        $dbName = $_ENV['dbName'];
        $username = $_ENV['username'];
        $password = $_ENV['password'];

        $dsn = "mysql:host=$host;dbname=$dbName;charset=utf8";
        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function all()
    {
        $statement = $this->pdo->prepare("SELECT * FROM {$this->table}");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM products WHERE id = :id');
        $statement->bindValue('id', $id);
        $statement->execute();
        return $statement->fetchObject('Product');
    }
    

    public function create($data)
    {
        $statement = $this->pdo->prepare('INSERT INTO products (name, description, price) VALUES (:name, :description, :price)');
        $statement->bindValue('name', $data['name']);
        $statement->bindValue('description', $data['description']);
        $statement->bindValue('price', $data['price']);
        $statement->execute();
    }

    public function update($data)  
    {   
        $statement = $this->pdo->prepare('UPDATE products SET name = :name, description = :description, price = :price WHERE id = :id');    
        $statement->bindValue('id', $data['id']);
        $statement->bindValue('name', $data['name']);
        $statement->bindValue('description', $data['description']);
        $statement->bindValue('price', $data['price']);
        $statement->execute();
    }

    public function delete($id) 
    {   
        $statement = $this->pdo->prepare('DELETE FROM products WHERE id = :id');    
        $statement->bindValue('id', $id);
        $statement->execute();  
    }

}