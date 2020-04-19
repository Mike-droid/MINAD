<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de docentes</title>
</head>

<body>

<?php 
    
    include("datosConexionBBDD.php");

    $registros = $base->query("SELECT * FROM DOCENTES")->fetchAll(PDO::FETCH_OBJ);

        if (isset($_POST["create"])) { //Si pulsaste el botón de submit ... 
            $NumTra = $_POST["NumTra"];
            $correoDoc = $_POST["correoDoc"];
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $contra = $_POST["contra"];
            $telefono = $_POST["telefono"];
    
            $sql = "INSERT INTO docentes 
            (NumeroTrabajador,
            CorreoDocente,
            Nombre,
            Apellidos,
            Contrasena,
            Telefono) 
            VALUES(:numtra, :correo, :nom, :ape, :cont, :tel)";
    
            $resultado = $base->prepare($sql);
    
            $resultado->execute(array(
             ":numtra"=>$NumTra ,
             ":correo"=>$correoDoc , 
             ":nom"=>$nombre, 
             ":ape"=>$apellido , 
             ":cont"=>$contra ,
             ":tel"=>$telefono));
    
            header("location:docentes.php");
        }
    
?>

    <a href="../pagina_admon.html">Regresar</a>
    <h1>Manejar información de los docentes</h1>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table border="1">
            <tr>
                <td>Número de trabajador</td>
                <td>e-mail</td>
                <td>Nombre</td>
                <td>Apellidos</td>
                <td>Contraseña</td>
                <td>Teléfono</td>
            </tr>

        <?php foreach($registros as $docente):?>
            <tr>
                <td> <?php echo $docente->NumeroTrabajador; ?> </td>
                <td> <?php echo $docente->CorreoDocente; ?> </td>
                <td> <?php echo $docente->Nombre; ?> </td>
                <td> <?php echo $docente->Apellidos; ?> </td>
                <td> <?php echo $docente->Contrasena; ?> </td>
                <td> <?php echo $docente->Telefono; ?> </td>

                <td>
                    <a href="editarDocentes.php?NumeroTrabajador= <?php echo $docente->NumeroTrabajador?> &
                            CorreoDocente= <?php echo $docente->CorreoDocente?> & 
                            Nombre= <?php echo $docente->Nombre?> & 
                            Apellidos= <?php echo $docente->Apellidos?> & 
                            Contrasena= <?php echo $docente->Contrasena?> &
                            Telefono= <?php echo $docente->Telefono?>">
                        <input type="button" value="Actualizar">
                    </a>
                </td>
                <td>
                <a href="borrarDocentes.php?NumeroTrabajador= <?php echo $docente->NumeroTrabajador?>">
                        <input type="button" value="Borrar">
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

        <tr>
            <td><input type="number" name="NumTra" id="" placeholder="Inserta el número de trabajador"></td>
            <td><input type="email" name="correoDoc" id="" value="@piedrasnegras.tecnm.mx"></td>
            <td><input type="text" name="nombre" id="" placeholder="Inserta un nombre"></td>
            <td><input type="text" name="apellido" id="" placeholder="Inserta un apellido"></td>
            <td><input type="password" name="contra" id="" placeholder="Inserta una contraseña"></td>
            <td><input type="number" name="telefono" id="" placeholder="Máximo 10 digitos"></td>
            <td><input type="submit" name="create" value="Insertar registro"></td>
        </tr>
        </table>
    </form>
</body>
</html>