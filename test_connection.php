<?php
$host = 'ep-spring-feather-a1mls3n0-pooler.ap-southeast-1.aws.neon.tech';
$db   = 'verceldb';
$user = 'default';
$pass = 'MWsXR31vaTJV';
$port = "5432";
$dsn = "pgsql:host=$host;port=$port;dbname=$db;";

try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    echo "Connected successfully";
} catch (\PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}