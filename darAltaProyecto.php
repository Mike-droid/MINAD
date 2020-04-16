<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="archivos-css/altaProyecto.css">
    <link rel="stylesheet" href="archivos-css/scrollbar.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Da+2&display=swap" rel="stylesheet">
    <title>Crear proyectos</title>
</head>
<body>
    <header>
        <h1>Registrando un nuevo proyecto</h1>
    </header>

    <div class="formulario">
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
                    <label for="fechaFin">Seleccione la fecha en que terminará el proyecto:</label>
                </div>
                <div>
                    <input type="date" name="fechaFin" id="fechaFin">
                </div>
            </div>

            <div>
                <label for="nombreDocentes">Docente a cargo del proyecto: </label>
            </div>
            <div>
                <select name="nombreDocentes" id="nombreDocentes">

                <?php
                include 'datosConexionBBDD.php'; //En el archivo hay una variable que tiene un método para conectarse a la base de datos, se llama $conexion

                $consulta = "SELECT * FROM docentes";
                $ejecutar = mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                ?>

                <?php foreach($ejecutar as $opciones): ?> 
                    <!--En el value guardamos el número del trabajador y en las opciones el campo que queremos que se vea--->
                <option value="<?php echo $opciones['NumeroTrabajador']?>"> 
                <?php echo $opciones['Nombre'] . " " . $opciones['Apellidos'];?> 
                </option>
                <?php endforeach ?>
                </select>
            </div>

            <div>
                <div>
                <label for="convocatoriaID">Convocatoria del proyecto: </label>
                </div>
                <div>
                    <select name="convocatoriaID" id="convocatoriaID">
                        <?php
                            include 'datosConexionBBDD.php';

                            $consulta = "SELECT * FROM convocatorias";
                            $ejecutar = mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                        ?>

                        <?php foreach($ejecutar as $opciones):?>
                        <option value="<?php echo $opciones['idConvocatorias'];?>"> 
                        <?php echo $opciones['idConvocatorias'];?>
                        </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div>
                <div>
                    <label for="">Institución de la convocatoria: </label>
                </div>
                <div>
                    <select name="" id="">
                        <?php 
                            include 'datosConexionBBDD.php';

                            $consulta = "SELECT * FROM institucion";
                            $ejecutar = mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                        ?>

                        <?php foreach($ejecutar as $opciones): ?>
                        <option value="<?php echo $opciones['idInstitucion']; ?>">
                            <?php echo $opciones['NombreInstitucion']; ?>
                        </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div>
                <input type="submit" value="Enviar" class="botones" id="enviar" name="enviar">
                <input type="reset" value="Limpiar campos" class="botones" id="limpiar">
            </div>
        </form>
    </div>
</body>
</html>