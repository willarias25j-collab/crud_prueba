<?php 
require 'conexion.php';

// READ: Obtener todas las tareas de la base de datos
$stmt = $pdo->query("SELECT * FROM tareas");
$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Preparar edición (Si viene ?editar por la URL)
$editar_id = null;
$tarea_a_editar = '';
if (isset($_GET['editar'])) {
    $editar_id = $_GET['editar'];
    $stmt = $pdo->prepare("SELECT * FROM tareas WHERE id = ?");
    $stmt->execute([$editar_id]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($resultado) {
        $tarea_a_editar = $resultado['nombre'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD con MySQL y PHP</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 40px auto; padding: 20px; }
        ul { padding: 0; }
        li { background: #f4f4f4; margin: 5px 0; padding: 10px; list-style: none; display: flex; justify-content: space-between; }
        .btn { text-decoration: none; color: white; padding: 3px 8px; border-radius: 3px; font-size: 14px; }
        .btn-edit { background: #2196F3; }
        .btn-delete { background: #f44336; }
    </style>
</head>
<body>

    <h2>CRUD con Base de Datos (XAMPP)</h2>

    <form action="acciones.php" method="POST">
        <?php if ($editar_id !== null): ?>
            <input type="hidden" name="id" value="<?php echo $editar_id; ?>">
            <input type="text" name="tarea" value="<?php echo $tarea_a_editar; ?>" required>
            <button type="submit" name="actualizar">Actualizar</button>
            <a href="index.php">Cancelar</a>
        <?php else: ?>
            <input type="text" name="tarea" placeholder="Nueva tarea..." required>
            <button type="submit" name="agregar">Agregar</button>
        <?php endif; ?>
    </form>

    <h3>Mis Tareas en la BD:</h3>
    <ul>
        <?php if (empty($tareas)): ?>
            <li>No hay tareas en la base de datos.</li>
        <?php else: ?>
            <?php foreach ($tareas as $t): ?>
                <li>
                    <?php echo $t['nombre']; ?>
                    <div>
                        <a href="index.php?editar=<?php echo $t['id']; ?>" class="btn btn-edit">Editar</a>
                        <a href="acciones.php?eliminar=<?php echo $t['id']; ?>" class="btn btn-delete">X</a>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>

</body>
</html>