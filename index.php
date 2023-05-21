<?php
session_start();

// Inicializar la lista de tareas pendientes si no existe en la sesión
if (!isset($_SESSION['todoList'])) {
    $_SESSION['todoList'] = [];
}

// Inicializar la lista de tareas realizadas si no existe en la sesión
if (!isset($_SESSION['completedList'])) {
    $_SESSION['completedList'] = [];
}

// Manejar la solicitud de agregar una nueva tarea
if (isset($_POST['task'])) {
    $task = $_POST['task'];

    if (!empty($task)) {
        // Agregar la tarea a la lista de tareas pendientes
        $_SESSION['todoList'][] = $task;
    }
}

// Manejar la solicitud de marcar una tarea como realizada
if (isset($_GET['index'])) {
    $index = $_GET['index'];

    // Verificar si el índice es válido y existe en la lista de tareas pendientes
    if (isset($_SESSION['todoList'][$index])) {
        $completedTask = $_SESSION['todoList'][$index];

        // Mover la tarea completada a la lista de tareas realizadas
        $_SESSION['completedList'][] = $completedTask;

        // Eliminar la tarea de la lista de tareas pendientes
        unset($_SESSION['todoList'][$index]);
    }
}

// Manejar la solicitud de borrar todas las tareas realizadas
if (isset($_POST['clear_completed'])) {
    // Limpiar la lista de tareas realizadas
    $_SESSION['completedList'] = [];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Aplicación de Notas de carlos FUNCIONAAAAAA</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Aplicación de Notas CI/CD</h1>

        <form method="POST" action="">
            <input type="text" name="task" placeholder="Escribe una nueva tarea" required>
            <button type="submit">Agregar</button>
        </form>

        <h2>Tareas Pendientes</h2>
        <ul>
            <?php foreach ($_SESSION['todoList'] as $index => $task): ?>
                <li>
                    <input type="checkbox" onchange="location.href='?index=<?= $index ?>'">
                    <span><?= $task ?></span>
                </li>
            <?php endforeach; ?>
        </ul>

        <h2>Tareas Realizadas</h2>
        <ul>
            <?php foreach ($_SESSION['completedList'] as $task): ?>
                <li class="completed"><?= $task ?></li>
            <?php endforeach; ?>
        </ul>

        <form method="POST" action="">
            <button type="submit" name="clear_completed">Borrar Tareas Realizadas</button>
        </form>
    </div>
</body>
</html>
