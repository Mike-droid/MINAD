<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php  
        include("datosConexionBBDD.php");

        $idProyecto = $_GET["idProyectos"]; //debe llamarse igual que proyectos.php línea 63

        $base->query("DELETE FROM proyectos WHERE idProyectos = '$idProyecto'");

        header("location:proyectos.php");
    ?>
</body>
</html>