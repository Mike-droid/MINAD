<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../archivos-css/tablas.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Da+2&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" href="favicon.png">
    <link rel="shortcut icon" type="image/png" href="../imagenes/minadLogo.png">
    <title>Tabla de docentes</title>
</head>

<body>

<?php 
    
    include("datosConexionBBDD.php");

    $registros = $base->query("SELECT * FROM docentes")->fetchAll(PDO::FETCH_OBJ);

        if (isset($_POST["create"])) { //!Si pulsaste el botón de submit ... 
            $NumTra = $_POST["NumTra"];
            $correoDoc = $_POST["correoDoc"];
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $contra = $_POST["contra"];
            $telefono = $_POST["telefono"];
    
            $sql = "INSERT INTO docentes 
            (NumeroTrabajador,
            CorreoDocente,
            Nombres,
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
        <table>
            <tr>
                <td class="table_column_name">Número de trabajador</td>
                <td class="table_column_name">e-mail</td>
                <td class="table_column_name">Nombre</td>
                <td class="table_column_name">Apellidos</td>
                <td class="table_column_name">Contraseña</td>
                <td class="table_column_name">Teléfono</td>
            </tr>

        <?php foreach($registros as $docente):?>
            <tr>
                <td> <?php echo $docente->NumeroTrabajador; ?> </td>
                <td> <?php echo $docente->CorreoDocente; ?> </td>
                <td> <?php echo $docente->Nombres; ?> </td>
                <td> <?php echo $docente->Apellidos; ?> </td>
                <td> <?php echo $docente->Contrasena; ?> </td>
                <td> <?php echo $docente->Telefono; ?> </td>

                <td class="boton_accion">
                    <a href="editarDocentes.php?NumeroTrabajador= <?php echo $docente->NumeroTrabajador?> &
                            CorreoDocente= <?php echo $docente->CorreoDocente?> & 
                            Nombres= <?php echo $docente->Nombres?> & 
                            Apellidos= <?php echo $docente->Apellidos?> & 
                            Contrasena= <?php echo $docente->Contrasena?> &
                            Telefono= <?php echo $docente->Telefono?>">
                        <input type="button" value="Actualizar">
                    </a>
                </td>
                <td class="boton_accion">
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
            <td><input type="submit" name="create" value="Insertar registro" class="boton_accion"></td>
        </tr>
        </table>
    </form>
</body>
</html>