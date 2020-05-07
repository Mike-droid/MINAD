<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista docente</title>
</head>
<body>
    <?php
        //!Este bloque sirve para saber si la sesión se ha iniciado
        session_start(); 
        if (!isset($_SESSION["usuario"])) {
            header("Location:index.php");
        }

        $correoDoc = $_SESSION["usuario"]; //!Obtenemos el correo de compruebaLogins.php

        require("archivosPHP/datosConexionBBDD.php");

        $nombreDoc = "";
        $apellidosDoc = "";
        $idTraba="";

        $conexion = mysqli_connect('localhost:3308','root','');

        if(mysqli_connect_errno()){
            echo "Error al conectar con la BBDD";
            exit();
        }

        mysqli_select_db($conexion,'proyectosinvestigacion2') or die ("No se encuentra la base de datos");

        mysqli_set_charset($conexion, "utf8");

        $consulta = "SELECT NumeroTrabajador,Nombres,Apellidos FROM docentes 
        WHERE CorreoDocente = '$correoDoc' AND Nombres=? AND Apellidos=? AND NumeroTrabajador=?";

        $resultados=mysqli_prepare($conexion,$consulta);
        $ok=mysqli_stmt_bind_param($resultados, 'ssi', $nombreDoc , $apellidosDoc , $idTraba);
        $ok=mysqli_stmt_execute($resultados);

        if ($ok==false) {
            echo "Error en la consulta";
        } else {
            $ok=mysqli_stmt_bind_result($resultados,$nombreDoc,$apellidosDoc,$idTraba);
        }

        while (mysqli_stmt_fetch($resultados)) {
            echo "Hola " . $nombreDoc . " " . $apellidosDoc;
        }

        mysqli_stmt_close($resultados);
		mysqli_close($conexion);
    ?>

    <h1>Bienvenido Docente</h1>

    <h2>Por motivos de seguridad y eficiecia le pedimos que seleccione sus datos 
    correctos para entrar a su perfil:</h2>

    <form action="vistaDocente2.php" method="post">
        <select name="NumeroTrabajador" id="">
            <?php
            include("archivosPHP/datosConexionBBDD.php");
            $registroDoc1 = $base->query("SELECT NumeroTrabajador FROM docentes")->fetchAll(PDO::FETCH_OBJ);
            ?>
            <?php foreach($registroDoc1 as $key1): ?>
            <option value=" <?php echo $key1->NumeroTrabajador;?>">
                <?php echo $key1->NumeroTrabajador;?>
            </option>
            <?php endforeach;?>
        </select>
    </form>

    <p><a href="cerrarSesion.php">Cerrar sesión</a></p>
</body>
</html>