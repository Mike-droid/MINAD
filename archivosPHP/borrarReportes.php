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

        $idReporte = $_GET["idReporte"]; //tiene que llamarse igual que reportes.php línea 54

        $base->query("DELETE FROM reportes WHERE idReporte = '$idReporte'");

        header("location:reportes.php");
    ?>
</body>
</html>