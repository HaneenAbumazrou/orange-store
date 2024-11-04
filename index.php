<?php
require 'functions.php';
require 'vendor/autoload.php';
require 'database.php';
require 'models/User.php';
require 'app/Router.php';
require_once 'models/Model.php';
// use MyApp\Models\Model;MyApp\Models

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


// $pdo = Database::getInstance()->getConnection();

// dd($_ENV);


// dd($_SERVER['REQUEST_URI']);


// $dsn = "mysql:host=$server_name;dbname=$db_name";
// try {
//     $pdo = new PDO($dsn, $server_user, $server_pass);
// } catch (PDOException $e) {
//     echo 'Connection failed: ' . $e->getMessage();
// }

$newUser= new User();
// Initialize the Model with the 'users' table
$userModel = new Model('users');

// Fetch all users
$users = $userModel->all();
// Display users in an HTML table
// if ($users) {
//     echo "<h2>Users List:</h2>";
//     echo "<table border='1' cellpadding='10'>";
//     echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Password (hashed)</th><th>Created At</th></tr>";

//     foreach ($users as $user) {
//         echo "<tr>";
//         echo "<td>{$user['id']}</td>";
//         echo "<td>{$user['name']}</td>";
//         echo "<td>{$user['email']}</td>";
//         echo "<td>{$user['password']}</td>";
//         echo "<td>{$user['created_at']}</td>";
//         echo "</tr>";
//     }

//     echo "</table>";
// } else {
//     echo "No users found.";
// }

// dd($newUser);


$routes = [
    '/' => 'views/pages/index.view.php',
    '/pricing' => 'views/pages/pricing.view.php',
    '/products' => 'controllers/products/show-products.php',
    '/about' => 'views/pages/about.view.php',
    '/contact' => 'views/pages/contact.view.php',
    '404' => 'views/pages/404.view.php',
];
$router = new Router();
$router->get('/', 'UserController@index');
$router->get('/products', 'ProductController@showProducts');
// Create or obtain the request (this could be $_SERVER['REQUEST_URI'])
$requestedRoute = $_SERVER['REQUEST_URI'];

// Dispatch the request to the router
$router->dispatch($requestedRoute);


if (array_key_exists($_SERVER['REQUEST_URI'], $routes)) {
    require $routes[$_SERVER['REQUEST_URI']];
} else {
    require 'views/pages/404.view.php';
}
