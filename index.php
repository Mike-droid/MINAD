<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de inicio</title>
    <link rel="stylesheet" href="archivos-css/portada.css" type="text/css">
    <link rel="stylesheet" href="archivos-css/scrollbar.css">
    <link rel="apple-touch-icon" href="favicon.png">

    <script src="archivos-js/Jquery/jquery-1.6.3.min.js"></script>
    <!-- Este script es para que la página haga el efecto fadeIn en 2 segundos -->
    <script>
        $(function(){
        $("body").hide().fadeIn(2000);
        });
    </script>

</head>
<body>

    <div id="titulo">
        <header>
            <a href="http://www.piedrasnegras.tecnm.mx/" target="_blank">TecNM - Instituto Tecnológico de Piedras Negras</a>
            <a id="registrarse" href="darAltaDocente.html">Registrarse</a>
        </header>
    </div>

    <div id="formulario">
        <img src="imagenes/ITPNLogo.png" alt="Logo ITPN" width="100px" height="100px" >
        <h2>Ingresa a tu perfil</h2>

        <form action="compruebaLogins.php" method="post">
            <nav>
                <input type="email" name="correo" id="correo" value="@piedrasnegras.tecnm.mx">
                <br>
                <p>
                <input type="password" name="contra" id="contrasena" placeholder="Contraseña*">
                </p>
                <input type="submit" value="Ingresar" class="button" name="enviar">
            </nav>
        </form>
    </div>
        
</body>
</html>