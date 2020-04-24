<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="reportes.php">Regresar</a>
    <h1>Actualizar</h1>
    <?php 
        include("datosConexionBBDD.php");

        if (!isset($_POST["bot_act"])) {
            $idReporte = $_GET["idReporte"]; //tiene que llamarse igual que reportes.php línea 54
            $descripcion = $_GET["Descripcion"];
            $FKidpro = $_GET["Proyectos_idProyectos"];
            $FKdocNum = $_GET["Proyectos_Docentes_NumeroTrabajador"];
        } else {
            $idReporte = $_POST["idReporte"];
            $descripcion = $_POST["descripcion"];
            $FKidpro = $_POST["Proyectos_idProyectos"];
            $FKdocNum = $_POST["Proyectos_Docentes_NumeroTrabajador"];

            //Tal vez no sea la mejor idea modificar las foreign keys
            $sql = "UPDATE reporte SET Descripcion = :descp ,
            Proyectos_idProyectos = :idpros , 
            Proyectos_Docentes_NumeroTrabajador = :pronumdoc 
            WHERE idReporte = :idrep";

            $resultado = $base->prepare($sql);

            $resultado->execute(array(
            ":descp"=>$descripcion , 
            ":idrep"=>$idReporte,
            ":idpros"=>$FKidpro,
            ":pronumdoc"=>$FKdocNum));

            header("location:reportes.php");
        }
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <table>
            <tr>
                <td>ID Reporte</td>
                <td><label for="">
                <input type="hidden" name="idReporte" value="<?php echo $idReporte ;?>">
                <?php echo $idReporte ;?>
                </label></td>
            </tr>
            <tr>
                <td>Descripción</td>
                <td><label for="">
                <input type="text" name="Descripcion" id="" value="<?php echo $descripcion ;?>">
                </label></td>
            </tr>
            <tr>
                <td>Proyecto</td>
                <td>
                <label for="">
                    <input type="hidden" name="Proyectos_idProyectos" value="<?php echo $FKidpro; ?>">
                    <?php echo $FKidpro; ?>
                </label>
                </td>
            </tr>
            <tr>
                <td>Docente</td>
                <td>
                    <label for="">
                        <input type="hidden" name="Proyectos_Docentes_NumeroTrabajador" value="<?php echo $FKdocNum ;?>">
                        <?php echo $FKdocNum ;?>
                    </label>
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