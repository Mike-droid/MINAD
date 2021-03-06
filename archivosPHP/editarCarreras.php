<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Da+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../archivos-css/tablas.css">
    <link rel="apple-touch-icon" href="favicon.png">
    <link rel="shortcut icon" type="image/png" href="../imagenes/minadLogo.png">
    <link rel="stylesheet" href="../archivos-css/centrarTablas.css">
    <title>Actualizar información de las carreras</title>
</head>
<body>
    <a href="carreras.php">Regresar</a>
    <h1>Actualizar información de la carrera</h1>
    <?php 
        include("datosConexionBBDD.php");
        
        if (!isset($_POST["bot_act"])) {
            $idCarrera = $_GET['idCarrera']; //tiene que llamarse igual que carreras.php línea 44
            $nombreCarrera = $_GET['NombreCarrera'];
        } else {
            $idCarrera = $_POST['idCarrera'];
            $nombreCarrera = $_POST['NombreCarrera'];

            $sql = "UPDATE carrera  SET NombreCarrera = :nomCar WHERE idCarrera = :idCar";

            $resultado = $base->prepare($sql);

            $resultado->execute(array(":nomCar"=>$nombreCarrera,":idCar"=>$idCarrera));

            header("location:carreras.php");
        }
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <table>
        <tr>
            <td>ID Carrera</td>
            <td><label for="">
            <input type="hidden" name="idCarrera" value="<?php echo $idCarrera;?>">
            <?php echo $idCarrera;?>
            </label></td>
        </tr>
        <tr>
            <td>Nombre de Carrera</td>
            <td><label for="">
            <input type="text" name="NombreCarrera" id="" value="<?php echo $nombreCarrera; ?>">
            </label></td>
        </tr>
        <tr>
            <td><input type="submit" value="Actualizar" name="bot_act" onclick="return actualizar();"></td>

            <script>
                function actualizar() {
                    let x = confirm("¿Estás seguro de querer actualizar estos datos?");
                    if (x) {
                        return true;
                    } else {
                        return false;
                    }
                }
            </script>

        </tr>
    </table>
    </form>
</body>
</html>