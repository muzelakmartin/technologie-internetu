<?php
// connection.php
$DB_HOST = 'db';           // názov docker služby
$DB_PORT = 3306;
$DB_NAME = 'crud_app';
$DB_USER = 'student';
$DB_PASS = 'student';

$dsn = "mysql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_NAME;charset=utf8mb4";

$options = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
  $pdo = new PDO($dsn, $DB_USER, $DB_PASS, $options);
} catch (Throwable $e) {
  http_response_code(500);
  echo "<h1>Chyba DB pripojenia</h1><pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
  exit;
}
