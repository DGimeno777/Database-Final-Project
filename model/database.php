<?php
$dsn = 'mysql:host=localhost;dbname=databasefinal';
$username = 'project_user';
$password = 'password123';
try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('..//database_error.php');
    exit();
}
?>