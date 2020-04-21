<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Instituciones</title>
</head>
<body>
    <a href="instituciones.php">Regresar</a>
    <h1>Actualizar Instituciones</h1>

    <?php 
        include("datosConexionBBDD.php");

        if (!isset($_POST["bot_act"])) {
            $idInstitucion = $_GET['idInstitucion'];            
            $nombreInst = $_GET['NombreInstitucion'];
        } else {
            $idInstitucion = $_POST['idInstitucion'];
            $nombreInst = $_POST['NombreInstitucion'];

            $sql = "UPDATE institucion SET NombreInstitucion = :nombInst WHERE idInstitucion = :idinst";

            $resultado = $base->prepare($sql);

            $resultado->execute(array(":nombInst"=>$nombreInst , ":idinst"=>$idInstitucion));

            header("location:instituciones.php");
        }
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <table>
            <tr>
                <td>ID Institución</td>
                <td><label for="">
                    <input type="hidden" name="idInstitucion" value="<?php echo $idInstitucion ;?>">
                    <?php echo $idInstitucion ;?>
                </label></td>
            </tr>
            <tr>
                <td>Nombre de la Institución</td>
                <td><label for="">
                    <input type="text" name="NombreInstitucion" id="" value="<?php echo $nombreInst ;?>">
                </label></td>
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