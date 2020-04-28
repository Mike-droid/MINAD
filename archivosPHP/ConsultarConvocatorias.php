<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de las convocatorias</title>
    <link href="https://fonts.googleapis.com/css?family=Baloo+Da+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../archivos-css/tablas.css">
    <link rel="apple-touch-icon" href="favicon.png">
    <link rel="shortcut icon" type="image/png" href="../imagenes/minadLogo.png">
</head>
<body>
    <a href="convocatorias.php">Regresar</a>
    <h1>Información de las convocatorias</h1>

    <?php 
        include("datosConexionBBDD.php");

        $registros = $base->query("SELECT * FROM convocatorias")->fetchAll(PDO::FETCH_OBJ);

    ?>

    <table border="1">
        <tr>
            <td class="table_column_name">ID Convocatoria</td>
            <td class="table_column_name">Fecha</td>
            <td class="table_column_name">Descripción</td>
            <td class="table_column_name">Institución</td>
        </tr>

        <?php foreach($registros as $convocatorias): ?>
            <tr>
                <td> <?php echo $convocatorias->idConvocatorias;?> </td>
                <td> <?php echo $convocatorias->FechaConvocatoria;?> </td>
                <td> <?php echo $convocatorias->Descripcion;?> </td>
                <td> <?php  
                    include("datosConexionBBDD.php");
                    $consultaInst = $base->query
                    ("SELECT NombreInstitucion FROM institucion WHERE idInstitucion =
                    $convocatorias->Institucion_idInstitucion")->fetchAll(PDO::FETCH_OBJ);
                    foreach($consultaInst as $resultado2){
                        echo $resultado2->NombreInstitucion;
                    }
                ?></td>
            </tr>
        <?php endforeach ?>   

    </table>
</body>
</html>