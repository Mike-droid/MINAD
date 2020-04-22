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

        $numCon = $_GET["NumeroControl"]; //Tiene que llamarse igual que alumnos.php línea 61

        $base->query("DELETE FROM alumnos WHERE NumeroControl = '$numCon'");

        header("location:alumnos.php");
    ?>
</body>
</html>