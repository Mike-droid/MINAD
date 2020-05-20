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
    <title>Actualizar información de las instituciones</title>
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