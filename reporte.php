<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link rel="stylesheet" href="archivos css/reportes.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Da+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="archivos css/scrollbar.css">
</head>
<body>
    <header>
        <h1>Registrando reportes</h1>
    </header>
    <div class="formulario">
        <form action="">
            <div>
                <label for="idReporte">Registre el ID del reporte:</label>
            </div>
            <div>
                <input type="number" name="idReporte" id="idReporte">
            </div>
            <div>
                <label for="txtDes">Descripción del reporte:</label>
            </div>
            <div>
                <input type="text" name="txtDes" id="txtDes">
            </div>
            <div>
                <label for="idProyecto">Proyecto del reporte: </label>
            </div>
            <div>
                <select name="idProyecto" id="idProyecto">
                    <option value="1">Cura del cáncer</option>
                    <option value="2">Otro</option>
                </select>
            </div>
            <div>
                <label for="maestros">Docente del proyecto:</label>
            </div>
            <div>
                <select name="maestros" id="maestros">
                    <option value="1">Antonio Chavez Soto</option>
                    <option value="2">Otro</option>
                </select>
            </div>
            <div>
                <label for="convo">Convocatoria del proyecto:</label>
            </div>
            <div>
                <select name="convo" id="convo">
                    <option value="1">Convocatoria 1</option>
                    <option value="2">Convocatoria 2</option>
                </select>
            </div>
            <div>
                <label for="insti">Institución de la convocatoria:</label>
            </div>
            <div>
                <select name="insti" id="insti">
                    <option value="5">Instituto Tecnológico de Saltillo</option>
                    <option value="6">Otro</option>
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