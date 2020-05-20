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
    <title>Actualizando información de los alumnos</title>
</head>
<body>
    <a href="alumnos.php">Regresar</a>
    <h1>Actualizar información del alumno</h1>

    <?php 
        include("datosConexionBBDD.php");

        if (!isset($_POST["bot_act"])) {
            $NumeroControl = $_GET["NumeroControl"]; //tiene que llamarse igual que alumnos.php línea 61
            $emailA = $_GET["CorreoAlumno"];
            $nombre = $_GET["Nombres"];
            $apellidos = $_GET["Apellidos"];
            $FK_proyectosID = $_GET["Proyectos_idProyectos"]; //tiene que llamarse igual que alumnos.php línea 69
            $FK_idDocente = $_GET["Proyectos_Docentes_NumeroTrabajador"];
            $FK_idCarrera = $_GET["Carrera_idCarrera"];
        } else {
            $NumeroControl = $_POST["NumeroControl"]; //tiene que llamarse igual que alumnos.php línea 61
            $emailA = $_POST["CorreoAlumno"];
            $nombre = $_POST["Nombres"];
            $apellidos = $_POST["Apellidos"];
            $FK_proyectosID = $_POST["Proyectos_idProyectos"]; //tiene que llamarse igual que alumnos.php línea 69
            $FK_idDocente = $_POST["Proyectos_Docentes_NumeroTrabajador"];
            $FK_idCarrera = $_POST["Carrera_idCarrera"];

            $sql = "UPDATE alumnos SET CorreoAlumno = :corrA,
            Nombres = :nombA,
            Apellidos = :apeA,
            Proyectos_idProyectos = :proID,
            Proyectos_Docentes_NumeroTrabajador = :docNum,
            Carrera_idCarrera = :idCar
            WHERE NumeroControl = :numCon";

            $resultado = $base->prepare($sql);

            $resultado->execute(array(":corrA"=>$emailA,
                                      ":nombA"=>$nombre,
                                      ":apeA"=>$apellidos,
                                      ":proID"=>$FK_proyectosID,
                                      ":docNum"=>$FK_idDocente,
                                      ":idCar"=>$FK_idCarrera,
                                      ":numCon"=>$NumeroControl));

            header("location:alumnos.php");
        }
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <table>
            <tr>
                <td>Número de control</td>
                <td><label for="">
                    <input type="hidden" name="NumeroControl" id="" value=" <?php echo $NumeroControl ;?> ">
                    <?php echo $NumeroControl ;?>
                </label></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><label for="">
                    <input type="email" name="CorreoAlumno" id="" value="<?php echo $emailA ;?>">
                </label></td>
            </tr>
            <tr>
                <td>Nombres</td>
                <td><label for="">
                    <input type="text" name="Nombres" id="" value="<?php echo $nombre ;?> ">
                </label></td>
            </tr>
            <tr>
                <td>Apellidos</td>
                <td><label for="">
                    <input type="text" name="Apellidos" id="" value="<?php echo $apellidos ;?> ">
                </label></td>
            </tr>
            <tr>
                <td>Proyecto</td>
                <td>
                    <select name="Proyectos_idProyectos" id="">
                        <?php
                        include("datosConexionBBDD.php");
                        $registrosProyectos = $base->query("SELECT * FROM proyectos")->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <?php foreach($registrosProyectos as $proyectitos): ?>
                            <option value="<?php echo $proyectitos->idProyectos ;?>">
                            <?php echo $proyectitos->NombreProyecto ;?>
                            </option>
                        <?php endforeach;?>    
                    </select>
                </td>
            </tr>
            <tr>
                <td>Docente</td>
                <td>
                    <select name="Proyectos_Docentes_NumeroTrabajador" id="">
                        <?php
                        include("datosConexionBBDD.php");
                        $registrosDocentes = $base->query("SELECT * FROM docentes")->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <?php foreach($registrosDocentes as $maestros): ?>
                            <option value="<?php echo $maestros->NumeroTrabajador ;?>">
                            <?php echo $maestros->Nombres . " " . $maestros->Apellidos ;?>
                            </option>
                        <?php endforeach;?>    
                    </select>
                </td>
            </tr>
            <tr>
                <td>Carrera</td>
                <td>
                    <select name="Carrera_idCarrera" id="">
                        <?php
                        include("datosConexionBBDD.php");
                        $registrosCarreras = $base->query("SELECT * FROM carrera")->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <?php foreach($registrosCarreras as $carreritas): ?>
                            <option value="<?php echo $carreritas->idCarrera ;?>">
                            <?php echo $carreritas->NombreCarrera;?>
                            </option>
                        <?php endforeach;?>    
                    </select>
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