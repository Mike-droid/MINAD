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
    <title>Carreras</title>
</head>
<body>
    <?php 
        include("datosConexionBBDD.php");

        $registros = $base->query("SELECT * FROM carrera")->fetchAll(PDO::FETCH_OBJ);

        if (isset($_POST["create"])) {
            $idCarrera = $_POST["idCarrera"];
            $nombreCarrera = $_POST["nombreCarrera"];

            $sql = "INSERT INTO carrera
            (idCarrera,
            NombreCarrera)
            VALUES(:idCarrera,:nomCar)";

            $resultado = $base->prepare($sql);

            $resultado->execute(array(
                ":idCarrera"=>$idCarrera,
                ":nomCar"=>$nombreCarrera));

            header("location:carreras.php");
        }
    ?>
    <a href="../pagina_admon.html">Regresar</a>
    <h1>Manejar información de las carreras</h1>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <table border="1">
            <tr>
                <td class="table_column_name" >ID Carrera</td>
                <td class="table_column_name" >Carrera</td>
            </tr>

            <?php foreach($registros as $carreras): ?>
                <tr>
                    <td> <?php echo $carreras->idCarrera; ?></td>
                    <td> <?php echo $carreras->NombreCarrera; ?> </td>

                    <td class="boton_accion">
                        <a href="editarCarreras.php?idCarrera= <?php echo $carreras->idCarrera;?> &
                                 NombreCarrera= <?php echo $carreras->NombreCarrera ;?>">
                            <input type="button" value="Actualizar">
                        </a>
                    </td>
                    <td class="boton_accion">
                        <a href="borrarCarreras.php?idCarrera= <?php echo $carreras->idCarrera;?>" onclick="return borrar();">
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
                <td><input type="hidden" name="idCarrera"></td>
                <td><input type="text" name="nombreCarrera" id=""></td>
                <td><input type="submit" value="Insertar registro" name="create" class="boton_accion"></td>
            </tr>
        </table>
    </form>
</body>
</html>