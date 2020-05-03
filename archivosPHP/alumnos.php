<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Da+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../archivos-css/tablas.css">
    <link rel="apple-touch-icon" href="favicon.png">
    <link rel="shortcut icon" type="image/png" href="../imagenes/minadLogo.png">
    <title>Información de los alumnos</title>
</head>
<body>
    <?php 
        include("datosConexionBBDD.php");

        $registros = $base->query("SELECT * FROM alumnos")->fetchAll(PDO::FETCH_OBJ);

        if (isset($_POST["create"])) { //!si pulsaste submit
            $NumeroControl = $_POST["numeroControl"];
            $emailA = $_POST["emailA"];
            $nombre = $_POST["nombre"];
            $apellidos = $_POST["apellidos"];
            $FK_proyectosID = $_POST["idProyecto"];
            $FK_idDocente = $_POST["idDocente"];
            $FK_idCarrera = $_POST["idCarrera"];

            $sql = "INSERT INTO alumnos
            (NumeroControl,
             CorreoAlumno,
             Nombres,
             Apellidos,
             Proyectos_idProyectos,
             Proyectos_Docentes_NumeroTrabajador,
             Carrera_idCarrera)
             VALUES
             (:numCon, :correoA, :nombA, :apeA, :proId, :docID, :carrID)";

             $resultado = $base->prepare($sql);

             $resultado->execute(array(":numCon"=>$NumeroControl,
                ":correoA"=>$emailA, ":nombA"=>$nombre, ":apeA"=>$apellidos,
                ":proId"=>$FK_proyectosID, ":docID"=>$FK_idDocente, ":carrID"=>$FK_idCarrera));

            header("location:alumnos.php");
        }
    ?>

    <a href="../pagina_admon.html">Regresar</a>
    <h1>Manejar información de los alumnos</h1>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <table border="1">
            <tr>
                <td class="table_column_name" >Número de control</td>
                <td class="table_column_name" >Email</td>
                <td class="table_column_name" >Nombre</td>
                <td class="table_column_name" >Apellidos</td>
                <td class="table_column_name" >Proyecto</td>
                <td class="table_column_name" >Docente</td>
                <td class="table_column_name" >Carrera</td>
            </tr>

            <?php foreach($registros as $alumnos): ?>
                <tr>
                    <td><?php echo $alumnos->NumeroControl ;?></td>
                    <td><?php echo $alumnos->CorreoAlumno ;?></td>
                    <td><?php echo $alumnos->Nombres ;?></td>
                    <td><?php echo $alumnos->Apellidos ;?></td>
                    <td><?php 
                            include("datosConexionBBDD.php");
                            $consultaPros = $base->query
                            ("SELECT NombreProyecto FROM proyectos WHERE idProyectos =
                            $alumnos->Proyectos_idProyectos")->fetchAll(PDO::FETCH_OBJ);
                            foreach($consultaPros as $resultado2){
                                echo $resultado2->NombreProyecto;
                            }
                        ?></td>
                    <td>
                    <?php 
                            include("datosConexionBBDD.php");
                            $consultaDocs = $base->query(
                            "SELECT Nombres, Apellidos FROM docentes WHERE NumeroTrabajador = 
                            $alumnos->Proyectos_Docentes_NumeroTrabajador")->fetchAll(PDO::FETCH_OBJ);
                            foreach($consultaDocs as $resultado3){
                                echo $resultado3->Nombres . " " . $resultado3->Apellidos;
                            }
                        ?>
                    </td>
                    <td>
                    <?php 
                            include("datosConexionBBDD.php");
                            $consultaCarreras = $base->query(
                            "SELECT NombreCarrera FROM carrera WHERE idCarrera = 
                            $alumnos->Carrera_idCarrera")->fetchAll(PDO::FETCH_OBJ);
                            foreach($consultaCarreras as $resultado4){
                                echo $resultado4->NombreCarrera;
                            }
                        ?>
                    </td>

                    <td class="boton_accion">
                        <a href="actualizarAlumnos.php?NumeroControl= <?php echo $alumnos->NumeroControl ;?> &
                        CorreoAlumno= <?php echo $alumnos->CorreoAlumno ;?> & 
                        Nombres= <?php echo $alumnos->Nombres ;?> & 
                        Apellidos= <?php echo $alumnos->Apellidos ;?> & 
                        Proyectos_idProyectos= <?php echo $alumnos->Proyectos_idProyectos ;?> &
                        Proyectos_Docentes_NumeroTrabajador= <?php echo $alumnos->Proyectos_Docentes_NumeroTrabajador ;?> &
                        Carrera_idCarrera= <?php echo $alumnos->Carrera_idCarrera ;?>">
                            <input type="button" value="Actualizar">
                        </a>
                    </td>

                    <td class="boton_accion">
                        <a href="borrarAlumnos.php?NumeroControl= <?php echo $alumnos->NumeroControl ;?>">
                            <input type="button" value="Borrar">
                        </a>
                    </td>
                </tr>
            <?php endforeach;?>    

            <tr>
                <td><input type="number" name="numeroControl"></td>
                <td><input type="email" name="emailA" id="" value="@piedrasnegras.tecnm.mx"></td>
                <td><input type="text" name="nombre" id=""></td>
                <td><input type="text" name="apellidos" id=""></td>
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
                <td>
                <select name="idCarrera" id="">
                        <?php 
                        include("datosConexionBBDD.php");
                        $registrosCarreras = $base->query("SELECT * FROM carrera")->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <?php foreach($registrosCarreras as $carreritas):?>
                            <option value="<?php echo $carreritas->idCarrera ;?>">
                            <?php echo $carreritas->NombreCarrera;?>
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