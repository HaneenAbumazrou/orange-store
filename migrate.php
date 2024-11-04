<?php


require 'database.php';
$pdo = Database::getInstance()->getConnection();


// $host = 'localhost';
// $user = 'root';
// $password = '';
// $db = 'php-mvc';

// $dsn = "mysql:host=$host;dbname=$db";

// try {
//     $pdo = new PDO($dsn, $user, $password);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     die('Connection failed: ' . $e->getMessage());
// }

// Fetch executed migrations
$executedMigrations = array_column(
    $pdo->query("SELECT migration FROM migrations")->fetchAll(PDO::FETCH_ASSOC), 
    'migration'
);

$migrationFiles = scandir(__DIR__ . '/migrations');
$batch = (int) $pdo->query("SELECT MAX(batch) FROM migrations")->fetchColumn() + 1;

foreach ($migrationFiles as $file) {
    if ($file === '.' || $file === '..') {
        continue;
    }

    $className = convertToClassName(pathinfo($file, PATHINFO_FILENAME));

    if (!in_array($className, $executedMigrations)) {
        require_once __DIR__ . '/migrations/' . $file;

        if (class_exists($className)) {
            $migration = new $className;

            try {
                $pdo->exec($migration->up());
                $pdo->exec("INSERT INTO migrations (migration, batch) VALUES ('$className', $batch)");
                echo "Migration $className executed successfully.<br>";
            } catch (PDOException $e) {
                echo "Error executing migration $className: " . $e->getMessage() . "<br>";
            }
        } else {
            echo "Class $className not found in $file.<br>";
        }
    } else {
        echo "Migration $className has already been executed.<br>";
    }
}

function convertToClassName($file) {
    $fileNameWithoutDate = preg_replace('/^(\d{4}_\d{2}_\d{2})_/', '', $file);
    $parts = explode('_', $fileNameWithoutDate);
    $className = '';

    foreach ($parts as $part) {
        $className .= ucfirst($part);
    }

    return $className;
}
