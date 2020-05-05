<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagen de evidencias</title>
</head>
<body>
    <?php    
        $idEvidencia = $_GET["idEvidencias"]; //!Tiene que llamarse igual que evidencias.php línea 77

        $conexion=mysqli_connect('localhost:3308','root','');

        if (mysqli_connect_errno()) {
            echo "Falló al conectar con la BBDD";
            exit();
        }
    
        mysqli_select_db($conexion,'proyectosinvestigacion2') or die ("No se encuentra la BBDD");
    
        mysqli_set_charset($conexion,'utf8');

        $consulta = "SELECT Evidencia FROM evidencias WHERE idEvidencias='$idEvidencia'";

        $resultado = mysqli_query($conexion,$consulta);

        while ($fila=mysqli_fetch_array($resultado)) {
            $rutaIMG=$fila["Evidencia"];
        }
    ?>

    <div>
        <img src="ImagenesEvidencias/<?= $rutaIMG ?>" alt="Texto si falla la imagen">
    </div>
</body>
</html>