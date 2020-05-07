<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Da+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../archivos-css/tablas.css">
    <link rel="apple-touch-icon" href="favicon.png">
    <link rel="shortcut icon" type="image/png" href="../imagenes/minadLogo.png">
    <title>Actualizando evidencias de proyectos</title>
</head>
<body>
    <a href="evidencias.php">Regresar</a>
    <h1>Actualizar información de la evidencia</h1>

    <?php 
        include("datosConexionBBDD.php");

        if (!isset($_POST["bot_act"])) {
            $idEvidencia = $_GET["idEvidencias"];
            $nombreImagen =$_GET["Evidencia"];
            $FKidProyecto = $_GET["Proyectos_idProyectos"];
            $FKnumTrabajador = $_GET["Proyectos_Docentes_NumeroTrabajador"];

        } else {
            $idEvidencia = $_POST["idEvidencias"];
            
            $nombreImagen = $_FILES["Evidencia"]["name"];
            $tipoImagen = $_FILES["Evidencia"]["type"];
            $tamanoImagen = $_FILES["Evidencia"]["size"];

            $FKidProyecto = $_POST["Proyectos_idProyectos"];
            $FKnumTrabajador = $_POST["Proyectos_Docentes_NumeroTrabajador"];

            if ($tamanoImagen<=5000000) { //! 1 millón de bytes es 1 mega

                if ($tipoImagen=="image/jpeg" || $tipoImagen=="image/jpg" || $tipoImagen=="image/png") {

                    //! \archivosPHP\ImagenesEvidencias/
                    $carpetaDestino=$_SERVER["DOCUMENT_ROOT"] . "/archivosPHP/ImagenesEvidencias/";
        
                    //! Movemos la imagen del directorio temporal al directorio escogido
                    move_uploaded_file($_FILES["Evidencia"]["tmp_name"],$carpetaDestino.$nombreImagen);            
                } 
                else {
                    echo "Sólo se pueden subir imagenes JPEG, JPG y PNG";
                }
            }
            else {
                echo "El tamaño excede el límite de 5MB";
            }

            $conexion=mysqli_connect('localhost:3308','root','');

            if (mysqli_connect_errno()) {
                echo "Falló al conectar con la BBDD";
                exit();
            }

            mysqli_select_db($conexion,'proyectosinvestigacion2') or die ("No se encuentra la BBDD");

            mysqli_set_charset($conexion,'utf8');

            $sql = "UPDATE evidencias SET Evidencia = '$nombreImagen' WHERE idEvidencias = '$idEvidencia'";

            $resultado=mysqli_query($conexion,$sql);

            header("location:evidencias.php");
        }
        
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>ID Evidencia</td>
                <td>
                    <input type="hidden" name="idEvidencias" value=" <?php echo $idEvidencia ;?>">
                    <?php echo $idEvidencia ;?>
                </td>
            </tr>

            <tr>
                <td>Evidencia (Nombre de foto)</td>
                <td>
                    <input type="file" name="Evidencia" id="">
                </td>
            </tr>

            <tr>
                <td>Proyecto</td>
                <td>
                <input type="hidden" name="Proyectos_idProyectos" id="" value="<?php echo $FKidProyecto ;?>">
                        <?php
                        include("datosConexionBBDD.php");
                        $registrosProyectos = $base->query("SELECT * FROM proyectos WHERE idProyectos='$FKidProyecto'")->fetchAll(PDO::FETCH_OBJ);
                        foreach ($registrosProyectos as $key2) {
                            echo $key2->NombreProyecto;
                        }
                        ?>
                </td>
            </tr>

            <tr>
                <td>Docente</td>
                <td>
                <input type="hidden" name="Proyectos_Docentes_NumeroTrabajador" id="" value="<?php echo $FKnumTrabajador ;?>">
                        <?php
                        include("datosConexionBBDD.php");
                        $registrosDocentes = $base->query("SELECT * FROM docentes WHERE NumeroTrabajador='$FKnumTrabajador'")->fetchAll(PDO::FETCH_OBJ);
                        foreach($registrosDocentes as $key1){
                            echo $key1->Nombres . " " . $key1->Apellidos;
                        }
                        ?>
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="Actualizar" name="bot_act"></td>
            </tr>
        </table>
    </form>
</body>
</html>