<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evidencias</title>
    <link rel="stylesheet" href="archivos css/evidencias.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Da+2&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1>Registrando evidencias de los proyectos</h1>
    </header>
    <div class="formulario">
        <form action="">
            <div>
                <label for="idEvidencia">Digite el ID de la evidencia: </label>
            </div>
            <div>
                <input type="number" name="idEvidencia" id="idEvidencia" min="1">
            </div>
            <div>
                <label for="rutaE">Ruta de la evidencia: </label>
            </div>
            <div>
                <input type="url" name="rutaE" id="rutaE">
            </div>
            <div>
                <label for="idProyectos">Proyecto a donde irá la evidencia:</label>
            </div>
            <div>
                <select name="idProyectos" id="idProyectos">
                    <option value="1">Proyecto de cura del cáncer</option>
                    <option value="2">Otro</option>
                </select>
            </div>
            <div>
                <label for="">Docente que está en el proyecto</label>
            </div>
            <div>
                <select name="maestroID" id="maestroID">
                    <option value="1">Antonio Chavez Soto</option>
                    <option value="2">Otro</option>
                </select>
            </div>
            <div>
                <input type="submit" value="Enviar" id="enviar" name="enviar" class="botones">
                <input type="reset" value="Limpiar campos" id="limpiar" class="botones">
            </div>
        </form>
    </div>
</body>
</html>