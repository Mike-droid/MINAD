<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear proyectos</title>
</head>
<body>
    <header>
        <h1>Registrando un nuevo proyecto</h1>
    </header>

    <div>
        <form action="" method="GET">

            <div>
                <div>
                    <label for="txtNombrePro">Escriba el nombre que tendrá su proyecto: </label>
                </div>
                <div>
                    <input type="text" name="txtNombrePro" id="txtNombrePro">
                </div>
            </div>
            
            <div>
                <div>
                    <label for="fechaPro">Seleccione la fecha de inicio del proyecto: </label>
                </div>
                <div>
                    <input type="date" name="fechaPro" id="fechaPro">
                </div>
            </div>

            <div>
                <div>
                    <label for="">Seleccione la fecha en que terminará el proyecto:</label>
                </div>
                <div>
                    <input type="date" name="fechaFin" id="fechaFin">
                </div>
            </div>

            <div>
                <label for="">Docente a cargo del proyecto: </label>
            </div>
            <div>
                <select name="" id="">

                <?php
                include 'datosConexionBBDD.php'; //En el archivo hay una variable que tiene un método para conectarse a la base de datos, se llama $conexion

                $consulta = "SELECT * FROM docentes";
                $ejecutar = mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                ?>

                <?php foreach($ejecutar as $opciones): ?> 
                    <!--En el value guardamos el número del trabajador y en las opciones el campo que queremos que se vea--->
                <option value="<?php echo $opciones['NumeroTrabajador']?>"> <?php echo $opciones['Nombre']?> </option>

                <?php endforeach ?>
                </select>
            </div>
        </form>
    </div>
</body>
</html>