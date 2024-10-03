<?php 
declare(strict_types=1);

$database = "mysql";
$host = 'localhost';
$port = '3306';
$db_name = 'fussilat_db';
$username = 'root';
$password = "root";

$dsn = "{$database}:host={$host};port={$port};dbname={$db_name};charset=utf8mb4";

try {
    $PDO = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), $e->getCode());

}
