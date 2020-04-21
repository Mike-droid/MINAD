<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instituciones</title>
</head>
<body>
    <a href="../pagina_admon.html">Regresar</a>
    <h1>Información de las instituciones</h1>
    <?php
        include("datosConexionBBDD.php");

        $registros = $base->query("SELECT * FROM institucion")->fetchAll(PDO::FETCH_OBJ);

        if (isset($_POST["create"])) { //botón submit
            $idInstitucion = $_POST["idInstitucion"];
            $nombreInsti = $_POST["NombreInstitucion"];

            $sql = "INSERT INTO institucion
            (idInstitucion,
            NombreInstitucion)
            VALUES (:idInst,:nomInst)";

            $resultado = $base->prepare($sql);

            $resultado->execute(array(
            ":idInst"=>$idInstitucion,
            ":nomInst"=>$nombreInsti));

            header("location:instituciones.php");
        }
    ;?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table border="1">
                <tr>
                    <td>ID Institución</td>
                    <td>Nombre de la institución</td>
                </tr>
                
                <?php foreach($registros as $instituciones):?>
                    <tr>
                        <td><?php echo $instituciones->idInstitucion;?></td>
                        <td><?php echo $instituciones->NombreInstitucion;?></td>

                        <td><a href="actualizarInstituciones.php?idInstitucion= <?php  echo $instituciones->idInstitucion;?> &
                                     NombreInstitucion= <?php echo $instituciones->NombreInstitucion;?>">
                            <input type="button" value="Actualizar">
                        </a></td>

                        <td><a href="borrarInstituciones.php?idInstitucion= <?php echo $instituciones->idInstitucion ;?> ">
                            <input type="button" value="Borrar">
                        </a></td>
                    </tr>
                <?php endforeach;?>
<!------------------------------------- FILA PARA INSERTAR REGISTROS---------------------------------->
                <tr>
                    <td><input type="hidden" name="idInstitucion"></td>
                    <td><input type="text" name="NombreInstitucion" id=""></td>
                    <td><input type="submit" value="Insertar registros" name="create"></td>
                </tr>
            </table>
        </form>

</body>
</html>