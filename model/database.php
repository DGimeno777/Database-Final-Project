<?php
$dsn = 'mysql:host=127.0.0.1;dbname=databasefinal';
$username = 'project_user';
$password = 'password123';
try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo $error_message;//include('..//database_error.php');
    //exit();
}
?>