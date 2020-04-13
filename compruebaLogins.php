<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobador de logins</title>
</head>
<body>
    <?php
    try {
        $base = new PDO("mysql:host=localhost:3308; dbname=proyectosinvestigacion", "root","");

        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM docentes WHERE CorreoDocente = :correo AND Contrasena = :password";

        $resultado = $base->prepare($sql);

        $correo = htmlentities(addslashes($_POST["correo"]));

        $contra = htmlentities(addslashes($_POST["contra"]));

        $resultado->bindValue(":correo" , $correo);

        $resultado->bindValue(":password" , $contra);

        $resultado->execute();

        $numeroRegistro = $resultado->rowCount();

        if ($numeroRegistro!=0) 
        {
            session_start(); //iniciamos sesión para el usuario que se acaba de loguear

                $_SESSION["usuario"]=$_POST["correo"];
                //En la variable super global $_SESSION con 'usuario' para identificar a la variable
                //'correo' es el cuadro del texto del formulario

                header("location:vistaDocente1.php");
        } 
        else 
        {
            header("location:index.php");
        }
        
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
    ?>
</body>
</html>