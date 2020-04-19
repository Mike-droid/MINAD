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

        $numTrabajador = $_GET["NumeroTrabajador"]; //debe llamarse igual que docentes.php línea 83

        $base->query("DELETE FROM docentes WHERE NumeroTrabajador = '$numTrabajador'");

        header("location:docentes.php");
    ?>
</body>
</html>