<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Da+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../archivos-css/tablas.css">
    <link rel="apple-touch-icon" href="favicon.png">
    <link rel="shortcut icon" type="image/png" href="../imagenes/minadLogo.png">
    <title>Instituciones tienen carreras</title>
</head>
<body>
    <a href="../pagina_admon.html">Regresar</a>
    <h1>Información de las Instituciones con Carreras</h1>

    <?php 
        include("datosConexionBBDD.php");

        $registros = $base->query("SELECT * FROM institucion_has_carrera")->fetchAll(PDO::FETCH_OBJ);

        if (isset($_POST["create"])) {
            $FKIDInst = $_POST["insi"];
            $FKIDcarr = $_POST["carreras"];

            $sql = "INSERT INTO institucion_has_carrera
            (Institucion_idInstitucion, Carrera_idCarrera)
            VALUES
            (:idInst , :carrID)";

            $resultado = $base->prepare($sql);

            $resultado->execute(array(":idInst"=>$FKIDInst,":carrID"=>$FKIDcarr));

            header("location:InstCarr.php");
        }
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <table border="1">
            <tr>
                <td class="table_column_name">Institución</td>
                <td class="table_column_name">Carrera</td>
            </tr>

            <?php foreach($registros as $datos): ?>
                <tr>
                    <td>
                        <?php
                            include("datosConexionBBDD.php");
                            $consultaInstitucion = $base->query
                            ("SELECT NombreInstitucion FROM institucion WHERE idInstitucion = 
                            $datos->Institucion_idInstitucion")->fetchAll(PDO::FETCH_OBJ);
                            foreach($consultaInstitucion as $resultado2){
                                echo $resultado2->NombreInstitucion;
                            }
                        ;?>
                    </td>
                    <td>
                        <?php 
                            include("datosConexionBBDD.php");
                            $consultaCarrera = $base->query
                            ("SELECT NombreCarrera FROM carrera WHERE idCarrera =
                            $datos->Carrera_idCarrera")->fetchAll(PDO::FETCH_OBJ);
                            foreach($consultaCarrera as $resultado3){
                                echo $resultado3->NombreCarrera;
                            }
                        ;?>
                    </td>
                </tr>
            <?php endforeach; ?>

            <tr>
                <td>
                    <select name="insi" id="">
                        <?php 
                            include("datosConexionBBDD.php");
                            $registroX = $base->query("SELECT * FROM institucion")->fetchAll(PDO::FETCH_OBJ);
                        ;?>
                        <?php foreach($registroX as $opcion): ?>
                            <option value="<?php echo $opcion->idInstitucion ;?>">
                            <?php echo $opcion->NombreInstitucion ;?>
                            </option>
                        <?php endforeach;?>
                    </select>
                </td>
                <td>
                    <select name="carreras" id="">
                        <?php 
                            include("datosConexionBBDD.php");
                            $registroY = $base->query("SELECT * FROM carrera")->fetchAll(PDO::FETCH_OBJ);
                        ;?>
                        <?php foreach($registroY as $opcionW): ?>
                            <option value="<?php echo $opcionW->idCarrera ;?>">
                            <?php echo $opcionW->NombreCarrera ;?>
                            </option>
                        <?php endforeach;?>
                        ;?>
                    </select>
                </td>
                <td>
                    <input type="submit" value="Insertar" name="create" class="boton_accion">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>