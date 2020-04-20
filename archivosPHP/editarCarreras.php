<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar información de las carreras</title>
</head>
<body>
    <h1>Actualizar</h1>
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
            <td><label for=""></label>
            <input type="hidden" name="idCarrera" value="<?php echo $idCarrera;?>">
            <?php echo $idCarrera;?>
            </td>
        </tr>
        <tr>
            <td>Nombre de Carrera</td>
            <td><label for=""></label>
            <input type="text" name="NombreCarrera" id="" value="<?php echo $nombreCarrera; ?>">
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="Actualizar" name="bot_act">
            </td>
        </tr>
    </table>
    </form>
</body>
</html>