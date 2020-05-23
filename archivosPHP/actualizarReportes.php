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
    <title>Actualizar reportes</title>
</head>
<body>
    <a href="reportes.php">Regresar</a>
    <h1>Actualizar información de los reportes</h1>
    <?php 
        include("datosConexionBBDD.php");

        if (!isset($_POST["bot_act"])) {
            $idReporte = $_GET["idReporte"]; //!tiene que llamarse igual que reportes.php línea 59
            $descripcion = $_GET["Descripcion"];
            $FKidpro = $_GET["Proyectos_idProyectos"];
            $FKdocNum = $_GET["Proyectos_Docentes_NumeroTrabajador"];
        } else {
            $idReporte = $_POST["idReporte"];
            $descripcion = $_POST["Descripcion"];
            $FKidpro = $_POST["Proyectos_idProyectos"];
            $FKdocNum = $_POST["Proyectos_Docentes_NumeroTrabajador"];

            //Tal vez no sea la mejor idea modificar las foreign keys
            $sql = "UPDATE reporte SET Descripcion = :descp 
            WHERE idReporte = :idrep";

            $resultado = $base->prepare($sql);

            $resultado->execute(array(
            ":descp"=>$descripcion , 
            ":idrep"=>$idReporte));

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
                    <?php
                        include("datosConexionBBDD.php");
                        $registrosProyectos = $base->query("SELECT * FROM proyectos WHERE idProyectos = '$FKidpro'")->fetchAll(PDO::FETCH_OBJ);
                        foreach ($registrosProyectos as $proyectos) {
                            echo $proyectos->NombreProyecto;
                        }
                    ?>
                </label>
                </td>
            </tr>
            <tr>
                <td>Docente</td>
                <td>
                    <label for="">
                        <input type="hidden" name="Proyectos_Docentes_NumeroTrabajador" value="<?php echo $FKdocNum ;?>">
                        <?php
                            include("datosConexionBBDD.php");
                            $registrosDocentes = $base->query("SELECT * FROM docentes WHERE NumeroTrabajador = '$FKdocNum'")->fetchAll(PDO::FETCH_OBJ);
                            foreach ($registrosDocentes as $maestros) {
                                echo $maestros->Nombres . " " . $maestros->Apellidos ;
                            }
                        ?>
                    </label>
                </td>
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