<?php
$host = 'localhost';
$db   = 'escuela_crud';
$user = 'root';
$pass = ''; // Por defecto en XAMPP viene vacío

try {
    // Usamos PDO para una conexión segura
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>