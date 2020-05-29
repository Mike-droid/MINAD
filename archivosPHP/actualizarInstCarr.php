<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Instituciones - Carreras</title>
    <link href="https://fonts.googleapis.com/css?family=Baloo+Da+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../archivos-css/tablas.css">
    <link rel="apple-touch-icon" href="favicon.png">
    <link rel="shortcut icon" type="image/png" href="../imagenes/minadLogo.png">
    <link rel="stylesheet" href="../archivos-css/centrarTablas.css">
</head>
<body>
    <a href="InstCarr.php">Regresar</a>
    <h1>Actualizar Información de Instituciones con Carreras</h1>

    <?php 
        include("datosConexionBBDD.php");

        if (!isset($_POST["bot_act"])) {
            $FKIDInst = $_GET["Institucion_idInstitucion"];
            $FKIDcarr = $_GET["Carrera_idCarrera"];
        } else {
            $FKIDInst = $_POST["Institucion_idInstitucion"];
            $FKIDcarr = $_POST["Carrera_idCarrera"];

            $sql = "UPDATE institucion_has_carrera SET 
            Institucion_idInstitucion = :insti,
            Carrera_idCarrera = :carrerita
            WHERE Institucion_idInstitucion = :insti 
            AND Carrera_idCarrera = :carrerita";

            $resultado = $base->prepare($sql);

            $resultado->execute(array(":insti"=>$FKIDInst,
                                        ":carrerita"=>$FKIDcarr));

            header(":location:InstCarr.php");
        }
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <table>
            <tr>
                <td>Institución</td>
                <td>
                    <select name="Institucion_idInstitucion" id="">
                        <?php 
                            include("datosConexionBBDD.php");
                            $registrosInstituciones = $base->query("SELECT * FROM institucion")->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <?php foreach($registrosInstituciones as $instituciones):?>
                            <option value="<?php echo $instituciones->idInstitucion;?>">
                                <?php echo $instituciones->NombreInstitucion;?>
                            </option>
                        <?php endforeach ;?>
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
                        <?php foreach($registrosCarreras as $carreras): ?>
                            <option value="<?php echo $carreras->idCarrera;?>">
                                <?php echo $carreras->NombreCarrera;?>
                            </option>
                        <?php endforeach;?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="Actualizar" name="bot_act" onclick="return actualizar();">
                            
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
                </td>
            </tr>
        </table>
    </form>
</body>
</html>