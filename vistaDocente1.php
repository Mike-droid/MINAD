<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista docente</title>
</head>
<body>
    <?php
        session_start(); 
        if (!isset($_SESSION["usuario"])) {
            header("Location:index.php");
        }
        //Este bloque sirve para saber si la sesión se ha iniciado
    ?>

    <h1>Esta es la vista del docente</h1>
    <h2>Estoy en x proyecto</h2>
    <h2>Estan x y z alumnos conmigo</h2>

    <p><a href="darAltaProyecto.php">Dar alta proyecto</a></p>

    <p><a href="cerrarSesion.php">Cerrar sesión</a></p>
</body>
</html>