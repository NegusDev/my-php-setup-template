<?php 
declare(strict_types=1);

$database = getenv('DB_CONNECTION');
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$db_name = getenv('DB_DATABASE');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');

$dsn = "{$database}:host={$host};port={$port};dbname={$db_name};charset=utf8mb4";

try {
    $PDO = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), $e->getCode());

}
