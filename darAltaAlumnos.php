<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>
    <link rel="stylesheet" href="archivos css/alumnos.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Da+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="archivos css/scrollbar.css">
</head>
<body>
    <header>
        <h1>Registrando a alumnos que participarán en proyectos</h1>
    </header>
    <div class="formulario">
        <form action="">
            <div>
                <label for="numeroControl">Inserte el número de control del alumno:</label>
            </div>
            <div>
                <input type="number" name="numeroControl" id="numeroControl" placeholder="Número de control">
            </div>
            <div>
                <label for="">Tecle el correo institucional:</label>
            </div>
            <div>
                <input type="email" name="correoA" id="correoA" value="@piedrasnegras.tecnmx.mx">
            </div>
            <div>
                <label for="nombreA">Escriba el nombre del alumno: </label>
            </div>
            <div>
                <input type="text" name="nombreA" id="nombreA" placeholder="Nombre del alumno">
            </div>
            <div>
                <label for="apellidoA">Escriba los apellidos del alumno:</label>
            </div>
            <div>
                <input type="text" name="apellidoA" id="apellidoA" placeholder="Apellido Paterno y Materno">
            </div>
            <div>
                <label for="proyectitos">Proyecto en que estará trabajando:</label>
            </div>
            <div>
                <select name="proyectitos" id="proyectitos">
                    <option value="1">Proyecto de cura de cáncer</option>
                    <option value="2">Otro</option>
                </select>
            </div>
            <div>
                <label for="docentitos">Docente con quien participará:</label>
            </div>
            <div>
                <select name="docentitos" id="docentitos">
                    <option value="123">Antonio Chavez Soto</option>
                    <option value="456">Otro</option>
                </select>
            </div>
            <div>
                <label for="">Carrera del alumno: </label>
            </div>
            <div>
                <select name="carreritas" id="carreritas">
                    <option value="5">Ingeniería en Sistemas Computacionales</option>
                    <option value="6">Ingeniería Mecatrónica</option>
                </select>
            </div>
            <div>
                <input type="submit" value="Enviar" name="enviar" id="enviar" class="botones">
                <input type="reset" value="Limpiar campos" class="botones" id="limpiar">
            </div>
        </form>
    </div>
</body>
</html>