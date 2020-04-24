<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar información de los docentes</title>
</head>
<body>
    <h1>Actualizar</h1>
    <?php
        include("datosConexionBBDD.php");

        if (!isset($_POST["bot_act"])) {
            $numTrab = $_GET['NumeroTrabajador']; //Tiene que llamarse igual que docente.php línea 65
            $correo = $_GET['CorreoDocente'];
            $nombre = $_GET['Nombres'];
            $apellido = $_GET['Apellidos'];
            $contra = $_GET['Contrasena'];
            $tel = $_GET['Telefono'];
        } else {
            $numTrab = $_POST['NumeroTrabajador'];
            $correo = $_POST['CorreoDocente'];
            $nombre = $_POST['Nombres'];
            $apellido = $_POST['Apellidos'];
            $contra = $_POST['Contrasena'];
            $tel = $_POST['Telefono'];

            $sql = "UPDATE docentes SET CorreoDocente = :correo , Nombres = :nom , Apellidos = :ape , Contrasena = :cont , Telefono = :tel WHERE NumeroTrabajador = :numT";

            $resultado = $base->prepare($sql);

            $resultado->execute(array(":numT"=>$numTrab , ":correo"=>$correo , ":nom"=>$nombre , ":ape"=>$apellido , ":cont"=>$contra , ":tel"=>$tel));

            header("location:docentes.php");
        }
        
    ?>


        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <table>
                <tr>
                    <td>Número trabajador</td>
                    <td><label for=""></label>
                    <input type="hidden" name="NumeroTrabajador" value=" <?php echo $numTrab; ?> ">
                    <?php echo $numTrab; ?> 
                    </td>
                </tr>
                <tr>
                    <td>e-mail</td>
                    <td><label for=""></label>
                    <input type="email" name="CorreoDocente" value="<?php echo $correo; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td>
                        <label for=""></label>
                        <input type="text" name="Nombres" id="" value="<?php echo $nombre; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Apellidos</td>
                    <td>
                        <label for=""></label>
                        <input type="text" name="Apellidos" id="" value="<?php echo $apellido; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Contraseña</td>
                    <td><label for=""></label>
                    <input type="password" name="Contrasena" id="" value="<?php echo $contra; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Teléfono</td>
                    <td>
                        <label for=""></label>
                        <input type="number" name="Telefono" id="" value="<?php echo $tel ?>">
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="Actualizar" name="bot_act"></td>
                </tr>
            </table>
        </form>
</body>
</html>