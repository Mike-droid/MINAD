<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Da+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../archivos-css/tablas.css">
    <link rel="apple-touch-icon" href="favicon.png">
    <link rel="shortcut icon" type="image/png" href="../imagenes/minadLogo.png">
    <title>Evidencias de proyectos</title>
</head>
<body>
    <a href="../pagina_admon.html">Regresar</a>
    <h1>Aquí están las evidencias</h1>

    <?php
        include("datosConexionBBDD.php");

        $registros = $base->query("SELECT * FROM evidencias")->fetchAll(PDO::FETCH_OBJ);

        if (isset($_POST["create"])) { //!si pulsaste submit...
            $idEvidencia = $_POST["idEvidencia"];

            $nombreImagen = $_FILES["imagen"]["name"];
            $tipoImagen = $_FILES["imagen"]["type"];
            $tamanoImagen = $_FILES["imagen"]["size"];

            $FKidProyecto = $_POST["idProyecto"];
            $FKnumTrabajador = $_POST["idDocente"];

            if ($tamanoImagen<=5000000) { //! 1 millón de bytes es 1 mega

                if ($tipoImagen=="image/jpeg" || $tipoImagen=="image/jpg" || $tipoImagen=="image/png") {

                    //! \archivosPHP\ImagenesEvidencias/
                    $carpetaDestino=$_SERVER["DOCUMENT_ROOT"] . "/archivosPHP/ImagenesEvidencias/";
        
                    //! Movemos la imagen del directorio temporal al directorio escogido
                    move_uploaded_file($_FILES["imagen"]["tmp_name"],$carpetaDestino.$nombreImagen);            
                } 
                else {
                    echo "Sólo se pueden subir imagenes JPEG, JPG y PNG";
                }
        
            }
            else {
                echo "El tamaño excede el límite de 5MB";
            }

            $sql = "INSERT INTO evidencias
            (Evidencia, Proyectos_idProyectos, Proyectos_Docentes_NumeroTrabajador)
            VALUES (:evidencia, :idPro, :numTra)";

            $resultado = $base->prepare($sql);

            $resultado->execute(array(":evidencia"=>$nombreImagen ,
                                      ":idPro"=>$FKidProyecto ,
                                      ":numTra"=>$FKnumTrabajador));

            header("location:evidencias.php");

        }

    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td class="table_column_name">ID Evidencia</td>
                <td class="table_column_name">Evidencia (Nombre de foto)</td>
                <td class="table_column_name">Proyecto</td>
                <td class="table_column_name">Docente</td>
            </tr>

            <?php foreach($registros as $evidencias) :?>
                <tr>
                    <td><?php echo $evidencias->idEvidencias ;?></td>
                    <td><?php echo $evidencias->Evidencia ;?></td>
                    <td><?php 
                            include("datosConexionBBDD.php");
                            $consultaPros = $base->query
                            ("SELECT NombreProyecto FROM proyectos WHERE idProyectos =
                            $evidencias->Proyectos_idProyectos")->fetchAll(PDO::FETCH_OBJ);
                            foreach($consultaPros as $resultado2){
                                echo $resultado2->NombreProyecto;
                            }
                    ?></td>
                    <td><?php
                            include("datosConexionBBDD.php");
                            $consultaDocs = $base->query(
                            "SELECT Nombres, Apellidos FROM docentes WHERE NumeroTrabajador = 
                            $evidencias->Proyectos_Docentes_NumeroTrabajador")->fetchAll(PDO::FETCH_OBJ);
                            foreach($consultaDocs as $resultado3){
                                echo $resultado3->Nombres . " " . $resultado3->Apellidos;
                            }
                    ?></td>

                    <td class="boton_accion">
                            <a href="">
                                <input type="button" value="Actualizar">
                            </a>
                    </td>
                    <td class="boton_accion">
                            <a href="">
                                <input type="button" value="Borrar">
                            </a>
                    </td>
                </tr>
            <?php endforeach;?>
            
            <tr>
                <td><input type="hidden" name="idEvidencia"></td>
                <td><input type="file" name="imagen" id=""></td>
                <td>
                    <select name="idProyecto" id="">
                        <?php 
                        include("datosConexionBBDD.php");
                        $registrosProyectos = $base->query("SELECT * FROM proyectos")->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <?php foreach($registrosProyectos as $proyectos):?>
                            <option value="<?php echo $proyectos->idProyectos ;?>">
                            <?php echo $proyectos->NombreProyecto;?>
                            </option>
                        <?php endforeach;?>
                    </select>
                </td>
                <td>
                    <select name="idDocente" id="">
                        <?php 
                        include("datosConexionBBDD.php");
                        $registrosDoc = $base->query("SELECT * FROM docentes")->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <?php foreach($registrosDoc as $docentes):?>
                            <option value="<?php echo $docentes->NumeroTrabajador ;?>">
                            <?php echo $docentes->Nombres . " " . $docentes->Apellidos;?>
                            </option>
                        <?php endforeach;?>
                    </select>
                </td>
                <td><input type="submit" value="Insertar registro" name="create" class="boton_accion"></td>
            </tr>
        </table>
    </form>
</body>
</html>