<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar información de los proyectos</title>
</head>
<body>
    <!-------<a href="proyectos.php">Regresar</a>---->
    <h1>Actualizar</h1>
    <?php 
        include("datosConexionBBDD.php");

        if (!isset($_POST["bot_act"])) {
            $idProyecto = $_GET["idProyectos"]; //tiene que llamarse igual que proyectos.php línea 63
            $nombrePro = $_GET["NombreProyecto"];
            $fechaI = $_GET["FechaInicio"];
            $fechaF = $_GET["FechaFin"];
            $FKdoc = $_GET["Docentes_NumeroTrabajador"]; //tiene que llamarse igual que proyectos.php línea 71
            $FKconvoID = $_GET["Convocatorias_idConvocatorias"];
            $FKconvoInst = $_GET["Convocatorias_Institucion_idInstitucion"];
        } else {
            $idProyecto = $_POST["idProyectos"]; //tiene que llamarse igual que proyectos.php línea 63
            $nombrePro = $_POST["NombreProyecto"];
            $fechaI = $_POST["FechaInicio"];
            $fechaF = $_POST["FechaFin"];
            $FKdoc = $_POST["Docentes_NumeroTrabajador"]; //tiene que llamarse igual que proyectos.php línea 71
            $FKconvoID = $_POST["Convocatorias_idConvocatorias"];
            $FKconvoInst = $_POST["Convocatorias_Institucion_idInstitucion"];

            $sql = "UPDATE proyectos SET NombreProyecto = :nomPro,
             FechaInicio = :dateI,
             FechaFin = :dateF,
             Docentes_NumeroTrabajador = :docnumT, 
             Convocatorias_idConvocatorias = :conID, 
             Convocatorias_Institucion_idInstitucion = :conInst 
             WHERE idProyectos = :idPRO";

            $resultado = $base->prepare($sql);

            $resultado->execute(array(":nomPro"=>$nombrePro,
                                      ":dateI"=>$fechaI,
                                      ":dateF"=>$fechaF,
                                      ":docnumT"=>$FKdoc,
                                      ":conID"=>$FKconvoID,
                                      ":conInst"=>$FKconvoInst,
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
                        <?php echo $redoc->Nombre . " " . $redoc->Apellidos;?>
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
            <td>Institución</td>
            <td><label for="">
            <select name="Convocatorias_Institucion_idInstitucion" id="">
                <?php 
                        include("datosConexionBBDD.php");
                        $registrosInstituciones = $base->query("SELECT * FROM institucion")->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <!----Cuando usamos llaves foráneas hay que usar array->objeto--->
                        <?php foreach($registrosInstituciones as $insti):?>
                        <option value="<?php echo $insti->idInstitucion;?>">
                        <?php echo $insti->NombreInstitucion;?>
                        </option>
                        <?php endforeach;?>
                    </select>
            </label></td>
        </tr>
        <tr>
            <input type="submit" value="Actualizar" name="bot_act">
        </tr>
    </table>
    </form>
</body>
</html>