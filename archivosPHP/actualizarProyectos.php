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
    <title>Actualizar información de los proyectos</title>
</head>
<body>
    <a href="proyectos.php">Regresar</a>
    <h1>Actualizar información de los proyectos</h1>
    <?php 
        include("datosConexionBBDD.php");

        if (!isset($_POST["bot_act"])) {
            $idProyecto = $_GET["idProyectos"]; //tiene que llamarse igual que proyectos.php línea 63
            $nombrePro = $_GET["NombreProyecto"];
            $fechaI = $_GET["FechaInicio"];
            $fechaF = $_GET["FechaFin"];
            $FKdoc = $_GET["Docentes_NumeroTrabajador"]; //tiene que llamarse igual que proyectos.php línea 71
            $FKconvoID = $_GET["Convocatorias_idConvocatorias"];
        } else {
            $idProyecto = $_POST["idProyectos"]; //tiene que llamarse igual que proyectos.php línea 63
            $nombrePro = $_POST["NombreProyecto"];
            $fechaI = $_POST["FechaInicio"];
            $fechaF = $_POST["FechaFin"];
            $FKdoc = $_POST["Docentes_NumeroTrabajador"]; //tiene que llamarse igual que proyectos.php línea 71
            $FKconvoID = $_POST["Convocatorias_idConvocatorias"];

            $sql = "UPDATE proyectos SET NombreProyecto = :nomPro,
             FechaInicio = :dateI,
             FechaFin = :dateF,
             Docentes_NumeroTrabajador = :docnumT, 
             Convocatorias_idConvocatorias = :conID 
             WHERE idProyectos = :idPRO";

            $resultado = $base->prepare($sql);

            $resultado->execute(array(":nomPro"=>$nombrePro,
                                      ":dateI"=>$fechaI,
                                      ":dateF"=>$fechaF,
                                      ":docnumT"=>$FKdoc,
                                      ":conID"=>$FKconvoID,
                                      ":idPRO"=>$idProyecto));

            header("location:proyectos.php");
        }
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <table>
        <tr>
            <td>ID Proyecto</td>
            <td><label for="">
                <input type="hidden" name="idProyectos" value="<?php echo $idProyecto;?>">
                <?php echo $idProyecto;?>
            </label></td>
        </tr>
        <tr>
            <td>Nombre del proyecto</td>
            <td><label for="">
                <input type="text" name="NombreProyecto" id="" value="<?php echo $nombrePro;?>">
            </label></td>
        </tr>
        <tr>
            <td>Fecha de inicio</td>
            <td><label for="">
                    <input type="date" name="FechaInicio" id="" value="<?php echo $fechaI;?>">
                </label></td>
        </tr>
        <tr>
            <td>Fecha de finalización</td>
            <td><label for="">
                <input type="date" name="FechaFin" id="" value="<?php echo $fechaF;?>">
            </label></td>
        </tr>
        <tr>
            <td>Docente a cargo del proyecto</td>
            <td>
            <select name="Docentes_NumeroTrabajador" id="">
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
        </tr>
        <tr>
            <td>ID convocatoria</td>
            <td><label for="">
            <select name="Convocatorias_idConvocatorias" id="">
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