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

        if (!isset($_POST["bot_act"])) { //si pulsaste submit
            $idConvo = $_GET["idConvocatorias"];
            $fechaConvo = $_GET["FechaConvocatoria"];
            $descri = $_GET["Descripcion"];
            $FKinst = $_GET["Institucion_idInstitucion"];
        } else {
            $idConvo = $_POST["idConvocatorias"];
            $fechaConvo = $_POST["FechaConvocatoria"];
            $descri = $_POST["Descripcion"];
            $FKinst = $_POST["Institucion_idInstitucion"];

            $sql = "UPDATE convocatorias SET FechaConvocatoria = :fechaCon,
            Descripcion = :descri,
            Institucion_idInstitucion = :idInst
            WHERE idConvocatorias = :idConvo";

            $resultado = $base->prepare($sql);

            $resultado->execute(array(":fechaCon"=>$fechaConvo,
                                      ":descri"=>$descri,
                                      ":idInst"=>$FKinst,
                                      ":idConvo"=>$idConvo));
            
            header("location:ConsultarConvocatorias.php");
        }
    ?>

    <a href="ConsultarConvocatorias.php">Regresar</a>

    <div class="formulario">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" id="formConvo">
            <header>
                <h1>Actualizar Convocatoria</h1>
            </header>

            <div>
                <input type="hidden" name="idConvocatorias" value="<?php echo $idConvo ;?>">
            </div>

            <div class="FECHA">
                <input type="date" name="FechaConvocatoria" id="">
            </div>

        <main>
            <div class="description">
                <textarea name="Descripcion" id="" cols="30" rows="10" form="formConvo" placeholder="Dame una descripción de esta convocatoria"></textarea>
            </div>
            <div class="llaveFK">
                <select name="Institucion_idInstitucion" id="">
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
            <input type="submit" value="ACTUALIZAR" name="bot_act">
        </footer>

        </form>
    </div>
</body>
</html>