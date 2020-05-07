<?php
    try {
        $base = new PDO("mysql:host=localhost:3308; dbname=proyectosinvestigacion2", "root","");

        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT CorreoDocente,Contrasena FROM docentes 
        WHERE CorreoDocente = :correo AND Contrasena = :password";

        $resultado = $base->prepare($sql);

        $correo = htmlentities(addslashes($_POST["correo"]));

        $contra = htmlentities(addslashes($_POST["contra"]));

        $resultado->bindValue(":correo" , $correo);

        $resultado->bindValue(":password" , $contra);

        $resultado->execute();

        $numeroRegistro = $resultado->rowCount();

        if ($numeroRegistro!=0) 
        {
            session_start(); //!iniciamos sesión para el usuario que se acaba de loguear

            $_SESSION["usuario"]=$_POST["correo"];
            //!En la variable super global $_SESSION con 'usuario' para identificar a la variable
            //!'correo' es el cuadro del texto del formulario

            //!Comprobación para ver si se conecta el administrador o un docente 
            if (strcasecmp($_POST["correo"],"7777@piedrasnegras.tecnm.mx")==0) 
            {
                header("location:pagina_admon.html"); //!página del administrador
            } 
            else
            {
                header("location:vistaDocente1.php"); //!página del docente
            }
                
        } 
        else 
        {
            header("location:index.php"); //!Si no está registrado el usuario lo regresa a la página index.php
        }
        
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
    ?>