<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Da+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../archivos-css/tablas.css">
    <link rel="apple-touch-icon" href="favicon.png">
    <link rel="shortcut icon" type="image/png" href="../imagenes/minadLogo.png">
    <title>Proyectos</title>
</head>
<body>
    <a href="../pagina_Admon.html">Regresar</a>
    <?php
        include("datosConexionBBDD.php");

        $registros = $base->query("SELECT * FROM proyectos")->fetchAll(PDO::FETCH_OBJ);

        if (isset($_POST["create"])) { //boton del submit
            $idProyectos = $_POST["idproyecto"];
            $nombrePro = $_POST["nombrepro"];
            $fechaInicio = $_POST["fechainicio"];
            $fechaFin = $_POST["fechafin"];
            $doc_num = $_POST["doc_num"];
            $convoID = $_POST["convoID"];

            $sql = "INSERT INTO proyectos
            (idProyectos,
            NombreProyecto,
            FechaInicio,
            FechaFin,
            Docentes_NumeroTrabajador,
            Convocatorias_idConvocatorias)
            VALUES (:idpro,:nombrepro,:fechaI,:fechaF,:FKdoc,:FKcon)";

            $resultado = $base->prepare($sql);

            $resultado->execute(array(
            ":idpro"=>$idProyectos,
            ":nombrepro"=>$nombrePro,
            ":fechaI"=>$fechaInicio,
            ":fechaF"=>$fechaFin,
            ":FKdoc"=>$doc_num,
            ":FKcon"=>$convoID));

            header("location:proyectos.php");
        }
    ?>
    <h1>Manejar la información de los proyectos</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table>
            <tr>
                <td class="table_column_name">ID de proyecto</td>
                <td class="table_column_name">Nombre de proyecto</td>
                <td class="table_column_name">Fecha de inico</td>
                <td class="table_column_name">Fecha de finalización</td>
                <td class="table_column_name">Docente a cargo del proyecto</td>
                <td class="table_column_name">ID de convocatoria</td>
            </tr>

            <?php foreach($registros as $proyectos):?>
                <tr>
                    <td> <?php echo $proyectos->idProyectos ;?> </td>
                    <td> <?php echo $proyectos->NombreProyecto ;?> </td>
                    <td> <?php echo $proyectos->FechaInicio ;?> </td>
                    <td> <?php echo $proyectos->FechaFin ;?> </td>
                    <td> <?php 
                            include("datosConexionBBDD.php");
                            $consultaDoc = $base->query
                            ("SELECT Nombres, Apellidos FROM docentes WHERE NumeroTrabajador = 
                            $proyectos->Docentes_NumeroTrabajador")->fetchAll(PDO::FETCH_OBJ);
                            foreach($consultaDoc as $resultado2){
                                echo $resultado2->Nombres . " " . $resultado2->Apellidos;
                            }
                         ?> 
                    </td>
                    <td> <?php echo $proyectos->Convocatorias_idConvocatorias ;?> </td>

                    <td class="boton_accion">
                        <a href="actualizarProyectos.php?idProyectos= <?php echo $proyectos->idProyectos;?> &
                                 NombreProyecto= <?php echo $proyectos->NombreProyecto;?> &
                                 FechaInicio= <?php echo $proyectos->FechaInicio;?> &
                                 FechaFin= <?php echo $proyectos->FechaFin;?> &
                                 Docentes_NumeroTrabajador= <?php echo $proyectos->Docentes_NumeroTrabajador ;?> &
                                 Convocatorias_idConvocatorias= <?php echo $proyectos->Convocatorias_idConvocatorias;?>">
                            <input type="button" value="Actualizar">
                        </a>
                    </td>
                    <td class="boton_accion">
                        <a href="borrarProyectos.php?idProyectos= <?php echo $proyectos->idProyectos ;?>">
                            <input type="button" value="Borrar">
                        </a>
                    </td>
                </tr>
            <?php endforeach;?>    
<!------------------------------------- FILA PARA INSERTAR REGISTROS---------------------------------->
            <tr>
                <td><input type="hidden" name="idproyecto"></td>
                <td><input type="text" name="nombrepro" placeholder="Escribe el nombre del proyecto"></td>
                <td><input type="date" name="fechainicio" id=""></td>
                <td><input type="date" name="fechafin" id=""></td>
                <td>
                    <select name="doc_num" id="">
                        <?php 
                        include("datosConexionBBDD.php");
                        $registrosDocentes = $base->query("SELECT * FROM docentes")->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <!----Cuando usamos llaves foráneas hay que usar array->objeto--->
                        <?php foreach($registrosDocentes as $redoc):?>
                        <option value="<?php echo $redoc->NumeroTrabajador;?>">
                        <?php echo $redoc->Nombres . " " . $redoc->Apellidos;?>
                        </option>
                        <?php endforeach;?>   
                    </select>
                </td>
                <td>
                    <select name="convoID" id="">
                <?php 
                        include("datosConexionBBDD.php");
                        $registrosConvocatorias = $base->query("SELECT * FROM convocatorias")->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <!----Cuando usamos llaves foráneas hay que usar array->objeto--->
                        <?php foreach($registrosConvocatorias as $convo):?>
                        <option value="<?php echo $convo->idConvocatorias;?>">
                        <?php echo $convo->idConvocatorias;?>
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