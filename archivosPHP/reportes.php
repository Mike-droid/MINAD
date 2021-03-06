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
    <title>Reportes de proyectos</title>
</head>
<body>
    <a href="../pagina_admon">Regresar</a>
    <h1>Información de los reportes</h1>

    <?php 

        include("datosConexionBBDD.php");

        $registros = $base->query("SELECT * FROM reporte")->fetchAll(PDO::FETCH_OBJ);

        if (isset($_POST["create"])) { //si pulsaste submit
            $idReporte = $_POST["idReporte"];
            $descripcion = $_POST["descripcion"];
            $FKidProyecto = $_POST["Proyectos_idProyectos"];
            $FKnumtrabajador = $_POST["Proyectos_Docentes_NumeroTrabajador"];

            $sql = "INSERT INTO reporte
            (idReporte,
            Descripcion,
            Proyectos_idProyectos,
            Proyectos_Docentes_NumeroTrabajador)
            VALUES
            (:idRep , :descri , :fkPro , :fkDocNum)";

            $resultado = $base->prepare($sql);

            $resultado->execute(array(":idRep"=>$idReporte,
                                      ":descri"=>$descripcion,
                                      ":fkPro"=>$FKidProyecto,
                                      ":fkDocNum"=>$FKnumtrabajador));

            header("location:reportes.php");
        }
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <table>
            <tr>
                <td class="table_column_name">ID Reporte</td>
                <td class="table_column_name">Descripción</td>
                <td class="table_column_name">Proyecto</td>
                <td class="table_column_name">Docente</td>
            </tr>
            
            <?php foreach($registros as $reportes): ?>
                <tr>
                    <td><?php echo $reportes->idReporte ;?></td>
                    <td><?php echo $reportes->Descripcion;?></td>
                    <td>
                        <?php 
                            include("datosConexionBBDD.php");
                            $consultaProyectos = $base->query
                            ("SELECT NombreProyecto FROM proyectos WHERE idProyectos =
                            $reportes->Proyectos_idProyectos")->fetchAll(PDO::FETCH_OBJ);
                            foreach($consultaProyectos as $resultado2){
                                echo $resultado2->NombreProyecto;
                            }
                        ?>
                    </td>
                    <td>
                    <?php 
                            include("datosConexionBBDD.php");
                            $consultaDocentes = $base->query
                            ("SELECT Nombres, Apellidos FROM docentes WHERE NumeroTrabajador =
                            $reportes->Proyectos_Docentes_NumeroTrabajador")->fetchAll(PDO::FETCH_OBJ);
                            foreach($consultaDocentes as $resultado3){
                                echo $resultado3->Nombres . " " . $resultado3->Apellidos;
                            }
                        ?>
                    </td>
                    <td class="boton_accion">
                        <a href="actualizarReportes.php?idReporte= <?php echo $reportes->idReporte ;?> &
                        Descripcion= <?php echo $reportes->Descripcion ;?> & 
                        Proyectos_idProyectos= <?php echo $reportes->Proyectos_idProyectos ;?> &
                        Proyectos_Docentes_NumeroTrabajador= <?php echo $reportes->Proyectos_Docentes_NumeroTrabajador ;?>">
                            <input type="button" value="Actualizar">
                        </a>
                    </td>
                    <td class="boton_accion">
                        <a href="borrarReportes.php?idReporte= <?php echo $reportes->idReporte;?>" onclick="return borrar();">
                            <input type="button" value="Borrar">
                        </a>

                        <script>
                            function borrar() {
                            let x = confirm("¿Estás seguro de querer eliminar este registro?");
                            if (x) {
                                return true;
                            } else {
                                return false;
                            }
                            }
                        </script>

                    </td>
                </tr>
            <?php endforeach;?>  

            <tr>
                <td><input type="hidden" name="idReporte"></td>
                <td><input type="text" name="descripcion" id=""></td>
                <td>
                    <select name="Proyectos_idProyectos" id="">
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
                <select name="Proyectos_Docentes_NumeroTrabajador" id="">
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
                <td><input type="submit" value="Insertar" name="create" class="boton_accion"></td>
            </tr>  
        </table>
    </form>
</body>
</html>