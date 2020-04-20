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

        $idCarrera = $_GET["idCarrera"]; //debe llamarse igual que carreras.php línea 44

        $base->query("DELETE FROM carrera WHERE idCarrera = '$idCarrera'");

        header("location:carreras.php");
    ?>
</body>
</html>