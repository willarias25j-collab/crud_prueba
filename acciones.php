<?php
require 'conexion.php';

// 1. CREATE (Insertar tarea)
if (isset($_POST['agregar']) && !empty(trim($_POST['tarea']))) {
    $tarea = htmlspecialchars($_POST['tarea']);
    
    $stmt = $pdo->prepare("INSERT INTO tareas (nombre) VALUES (?)");
    $stmt->execute([$tarea]);
    
    header("Location: index.php");
    exit();
}

// 2. DELETE (Eliminar tarea)
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    
    $stmt = $pdo->prepare("DELETE FROM tareas WHERE id = ?");
    $stmt->execute([$id]);
    
    header("Location: index.php");
    exit();
}

// 3. UPDATE (Guardar tarea editada)
if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $tarea = htmlspecialchars($_POST['tarea']);
    
    $stmt = $pdo->prepare("UPDATE tareas SET nombre = ? WHERE id = ?");
    $stmt->execute([$tarea, $id]);
    
    header("Location: index.php");
    exit();
}
?>