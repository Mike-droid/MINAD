<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Da+2&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="imagenes/minadLogo.png">
    <link rel="stylesheet" href="archivos-css/tablas.css">
    <link rel="stylesheet" href="archivos-css/vistaDocente1.css">
    <link rel="stylesheet" href="archivos-css/centrarTablas.css">
    <title>Vista docente</title>
</head>
<body>
    <?php
        //!Este bloque sirve para saber si la sesión se ha iniciado
        session_start(); 
        if (!isset($_SESSION["usuario"])) {
            header("Location:index.php");
        }

        $correoDoc = $_SESSION["usuario"]; //!Obtenemos el correo de compruebaLogins.php

        require("archivosPHP/datosConexionBBDD.php");

        //!Consultado información del docente
        $registrosDocs = $base->query("SELECT * FROM docentes 
        WHERE CorreoDocente =  '$correoDoc'")->fetchAll(PDO::FETCH_OBJ);
        foreach($registrosDocs as $maestros){
            
        }

        //!Consultado alumnos que estén con docente
        $registrosAlumnos = $base->query("SELECT * FROM Alumnos JOIN Proyectos
        ON Proyectos_Docentes_NumeroTrabajador =
        Docentes_NumeroTrabajador 
        WHERE Docentes_NumeroTrabajador = $maestros->NumeroTrabajador")->fetchAll(PDO::FETCH_OBJ);
        foreach ($registrosAlumnos as $alumnos) {
            
        }

        //!Consultando proyectos con docentes
        $registrosProyectos = $base->query("SELECT * FROM proyectos WHERE
        Docentes_NumeroTrabajador = $maestros->NumeroTrabajador")->fetchAll(PDO::FETCH_OBJ);
        foreach ($registrosProyectos as $proyectos) {
            
        }

        //!Información de las evidencias
        $registrosEvidencias = $base->query("SELECT * FROM evidencias JOIN Proyectos ON
        Proyectos_Docentes_NumeroTrabajador = Docentes_NumeroTrabajador WHERE
        Docentes_NumeroTrabajador = $maestros->NumeroTrabajador")->fetchAll(PDO::FETCH_OBJ);
        foreach ($registrosEvidencias as $evidencias) {

        }

        //!Información de los reportes de docentes
        $registrosReportes = $base->query("SELECT * FROM reporte JOIN Proyectos ON
        Proyectos_Docentes_NumeroTrabajador = Docentes_NumeroTrabajador WHERE
        Docentes_NumeroTrabajador = $maestros->NumeroTrabajador")->fetchAll(PDO::FETCH_OBJ);
        foreach ($registrosReportes as $reportes) {

        }

        //!Información de convocatorias
        $registrosConvocatorias = $base->query("SELECT * FROM convocatorias")->fetchAll(PDO::FETCH_OBJ);
        foreach ($registrosConvocatorias as $convocatorias) {
            
        }
    ?>

    <header>
        <h1>Bienvenido <?php echo $maestros->Nombres . " " . $maestros->Apellidos;?></h1>
    </header>
    
    <section class="proyectos">
        <h2>Aquí está la información de los proyectos en los que es participe:</h2>
        <table>
            <tr>
                <td class="table_column_name">ID de proyecto</td>
                <td class="table_column_name">Nombre de proyecto</td>
                <td class="table_column_name">Fecha de inico</td>
                <td class="table_column_name">Fecha de finalización</td>
                <td class="table_column_name">ID de convocatoria</td>
            </tr>

            <?php foreach($registrosProyectos as $proyectos): ?>
                <tr>
                    <td> <?php echo $proyectos->idProyectos ;?> </td>
                    <td> <?php echo $proyectos->NombreProyecto ;?> </td>
                    <td> <?php echo $proyectos->FechaInicio ;?> </td>
                    <td> <?php echo $proyectos->FechaFin ;?> </td>
                    <td> <?php echo $proyectos->Convocatorias_idConvocatorias ;?> </td>
                </tr>
            <?php endforeach ;?>    
        </table>
    </section>

    <section class="alumnos">
        <h2>Aquí están los alumnos que están participando con usted:</h2>
        <table>
            <tr>
                <td class="table_column_name">Número de Control</td>
                <td class="table_column_name">Email</td>
                <td class="table_column_name">Nombre</td>
                <td class="table_column_name">Apellido</td>
            </tr>

            <?php foreach($registrosAlumnos as $alumnos): ?>
                <tr>
                    <td> <?php echo $alumnos->NumeroControl ;?> </td>
                    <td> <?php echo $alumnos->CorreoAlumno ;?> </td>
                    <td> <?php echo $alumnos->Nombres ;?> </td>
                    <td> <?php echo $alumnos->Apellidos ;?> </td>
                </tr>
            <?php endforeach;?>
        </table>
    </section>

    <section class="evidencias">

    <?php
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

            header('location:vistaDocente1.php');
        }
    ?>

        <h2>Aquí están las evidencias que ha subido:</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td class="table_column_name">ID Evidencia</td>
                <td class="table_column_name">Evidencia (Nombre de foto)</td>
                <td class="table_column_name">Proyecto</td>
            </tr>

            <?php foreach($registrosEvidencias as $evidencias):?>
            <tr>
                <td> <?php echo $evidencias->idEvidencias ;?> </td>
                <td> <?php echo $evidencias->Evidencia ;?> </td>
                <td> <?php
                include("datosConexionBBDD.php");
                $consultaPros = $base->query
                ("SELECT NombreProyecto FROM proyectos WHERE idProyectos =
                $evidencias->Proyectos_idProyectos")->fetchAll(PDO::FETCH_OBJ);
                foreach($consultaPros as $resultado2){
                    echo $resultado2->NombreProyecto;
                }
                ;?></td>

                <td class="boton_accion">
                    <a href="archivosPHP/actualizarEvidenciasDOCENTE.php?idEvidencias= <?php echo $evidencias->idEvidencias ;?> &
                            Evidencia= <?php echo $evidencias->Evidencia ;?> &
                            Proyectos_idProyectos= <?php echo $evidencias->Proyectos_idProyectos ;?> &
                            Proyectos_Docentes_NumeroTrabajador= <?php echo $evidencias->Proyectos_Docentes_NumeroTrabajador ;?>">
                                <input type="button" value="Actualizar">
                    </a>
                </td>

                <td class="boton_accion">
                    <a href="archivosPHP/leerImagen.php?idEvidencias= <?php echo $evidencias->idEvidencias ;?>">
                        <input type="button" value="Ver imagen">
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
                        $registrosProyectos = $base->query("SELECT * FROM proyectos
                        WHERE Docentes_NumeroTrabajador = $maestros->NumeroTrabajador")->fetchAll(PDO::FETCH_OBJ);
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
                        $registrosDoc = $base->query("SELECT * FROM docentes 
                        WHERE NumeroTrabajador = $maestros->NumeroTrabajador")->fetchAll(PDO::FETCH_OBJ);
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
    </section>

    <section class="reportes">
        <h2>Aquí están los reportes de los proyectos</h2>
        <table>
            <tr>
                <td class="table_column_name">ID Reporte</td>
                <td class="table_column_name">Descripción</td>
                <td class="table_column_name">Proyecto</td>
            </tr>

            <?php foreach($registrosReportes as $reportes): ?>
                <tr>
                    <td> <?php echo $reportes->idReporte;?> </td>
                    <td> <?php echo $reportes->Descripcion;?> </td>
                    <td>
                        <?php 
                            include("datosConexionBBDD.php");
                            $consultaProyectos = $base->query
                            ("SELECT NombreProyecto FROM Proyectos WHERE idProyectos = 
                            $reportes->Proyectos_idProyectos")->fetchAll(PDO::FETCH_OBJ);
                            foreach ($consultaProyectos as $resultado3) {
                                echo $resultado3->NombreProyecto;
                            }
                        ?>
                    </td>
                </tr>
            <?php endforeach ;?>
        </table>
    </section>

    <section class="convocatorias">
        <h2>Aquí están las convocatorias:</h2>
        <table>
            <tr>
                <td class="table_column_name">ID Convocatoria</td>
                <td class="table_column_name">Fecha de convocatoria</td>
                <td class="table_column_name">Descripción</td>
                <td class="table_column_name">Institución</td>
            </tr>

            <?php foreach($registrosConvocatorias as $convocatorias) :?>
                <tr>
                    <td> <?php echo $convocatorias->idConvocatorias ;?> </td>
                    <td> <?php echo $convocatorias->FechaConvocatoria; ?> </td>
                    <td> <?php echo $convocatorias->Descripcion ;?> </td>
                    <td> <?php 
                    $consultaInst = $base->query
                    ("SELECT NombreInstitucion FROM institucion WHERE idInstitucion =
                    $convocatorias->Institucion_idInstitucion")->fetchAll(PDO::FETCH_OBJ);
                    foreach($consultaInst as $resultado2){
                        echo $resultado2->NombreInstitucion;
                    } ;?> </td>
                </tr>
            <?php endforeach ;?>
        </table>
    </section>
    
    <p class="close"><a href="cerrarSesion.php">Cerrar sesión</a></p>
</body>
</html>