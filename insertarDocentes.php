<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro insertado con éxito</title>
    <link rel="stylesheet" href="archivos-css/insertarDocentes.css">
</head>
<body>
    <?php
    $numTrabajador = $_POST["numTrabajador"];
    $correoDocente = $_POST["correoDocente"];
    $nombre = $_POST["txtNombreDocente"];
    $apellido = $_POST["txtApellidoDocente"];
    $contra = $_POST["contraDocente"];
    $telDocente = $_POST["celDocente"];

    try {

        $base = new PDO('mysql:host=localhost:3308; dbname=proyectosinvestigacion2', 'root','');

        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //esto ayudará en el catch, informará del error
        //Establece un atributo en el manejador de la base de datos.

        $base->exec("SET CHARACTER SET utf8");

        $sql = "INSERT INTO docentes(NumeroTrabajador, CorreoDocente, Nombres, Apellidos, Contrasena, Telefono)
        VALUES (:numTrabajador,:correoDocente,:txtNombreDocente,:txtApellidoDocente,:contraDocente,:celDocente);";

        $resultado=$base->prepare($sql);

        $resultado->execute(array(":numTrabajador"=>$numTrabajador, ":correoDocente"=>$correoDocente,
        ":txtNombreDocente"=>$nombre,":txtApellidoDocente"=>$apellido,":contraDocente"=>$contra,
        ":celDocente"=>$telDocente));

        echo "<h1>Registro insertado</h1>";

        $resultado->closeCursor();

        
    } catch (Exception $e) 
    {
        die('Error: ' . $e->GetMessage());
        echo "<br> Código del error: " . $e->getCode();
        echo "<br> Línea del error: " . $e->getLine();
    } 
    finally
    {
        $base = null;
    }

    ?>

    <p>
    <button><a href="index.php">Regresar a la página de inicio</a></button>
    </p>
</body>
</html>