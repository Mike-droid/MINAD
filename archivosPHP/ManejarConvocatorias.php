<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convocatorias</title>
    <link href="https://fonts.googleapis.com/css?family=Baloo+Da+2&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" href="favicon.png">
    <link rel="shortcut icon" type="image/png" href="../imagenes/minadLogo.png">
    <link rel="stylesheet" href="../archivos-css/manejarConvocatorias.css">
</head>
<body>

    <?php 
        include("datosConexionBBDD.php");

        if (isset($_POST["create"])) { //si pulsaste submit
            //$idConvocatoria = $_POST[""];
            $fechaConvocatoria = $_POST["fechaConvocatoria"];
            $descripcion = $_POST["descripcion"];
            $FKinstitucion = $_POST["institucion"];

            $sql = "INSERT INTO convocatorias
            (FechaConvocatoria,
            Descripcion,
            Institucion_idInstitucion)
            VALUES
            (:fecha, :descri , :isInst)";

            $resultado = $base->prepare($sql);

            $resultado->execute(array(
            ":fecha"=>$fechaConvocatoria,
            ":descri"=>$descripcion,
            ":isInst"=>$FKinstitucion));

            header("ManejarConvocatorias.php");
        }
    ?>

    <a href="convocatorias.php">Regresar</a>

    <div class="formulario">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" id="formConvo">
            <header>
                <h1>Convocatoria</h1>
            </header>

            <div class="FECHA">
                <input type="date" name="fechaConvocatoria" id="">
            </div>

        <main>
            <div class="description">
                <textarea name="descripcion" id="" cols="30" rows="10" form="formConvo" placeholder="Dame una descripción de esta convocatoria"></textarea>
            </div>
            <div class="llaveFK">
                <select name="institucion" id="">
                <?php 
                include("datosConexionBBDD.php");
                $registrosInst = $base->query("SELECT * FROM institucion")->fetchAll(PDO::FETCH_OBJ);
                ?>
                <?php foreach($registrosInst as $instituciones):?>
                    <option value="<?php echo $instituciones->idInstitucion;?>">
                    <?php echo $instituciones->NombreInstitucion;?>
                    </option>
                <?php endforeach;?>
                </select>
            </div>
        </main>
        <footer class="boton">
            <input type="submit" value="Insertar" name="create">
        </footer>

        </form>
    </div>
</body>
</html>