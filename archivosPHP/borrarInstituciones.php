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

    $idInstitucion = $_GET["idInstitucion"];

    $base->query("DELETE FROM institucion WHERE idInstitucion = '$idInstitucion'");

    header("location:instituciones.php");

    ;?>
</body>
</html>