<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de las convocatorias</title>
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
    </table>
</body>
</html>