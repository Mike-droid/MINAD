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

        $idConvo = $_GET["idConvocatorias"]; //tiene que llamarse igual que ConsultarConvocatorias.php línea 33

        $base->query("DELETE FROM convocatorias WHERE idConvocatorias = '$idConvo'");

        header("location:ConsultarConvocatorias.php");
    ?>
</body>
</html>