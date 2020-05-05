<?php

    $nombrePic = $_FILES["newPic"]["name"];
    $tipoPic = $_FILES["newPic"]["type"];
    $tamanoPic =$_FILES["newPic"]["size"];

    if ($tamanoPic<=5000000) { //! 1 millón de bytes es 1 mega

        if ($tipoPic=="image/jpeg" || $tipoPic=="image/jpg" || $tipoPic=="image/png") {
            
            $carpetaDestino=$_SERVER["DOCUMENT_ROOT"] . "/archivosPHP/ImagenesEvidencias/";

            //! Movemos la imagen del directorio temporal al directorio escogido
            move_uploaded_file($_FILES["newPic"]["tmp_name"],$carpetaDestino.$nombrePic);
        } 
        else {
            echo "Sólo se pueden subir imagenes JPG, PNG, GIF";
        }

    }
    else {
        echo "El tamaño excede el límite de 5MB";
    }

    $conexion=mysqli_connect('localhost:3308','root','');

    if (mysqli_connect_errno()) {
        echo "Falló al conectar con la BBDD";
        exit();
    }

    mysqli_select_db($conexion,'proyectosinvestigacion2') or die ("No se encuentra la BBDD");

    mysqli_set_charset($conexion,'utf8');

    $idEvi = intval($_POST['idEvidencias']);

    $sql = "UPDATE evidencias SET Evidencia = '$nombrePic' WHERE idEvidencias='$idEvi'";

    $resultado=mysqli_query($conexion,$sql);

    //header("location:evidencias.php");

    //echo "<br> Si lees esto es porque estás en CambiarFoto";

?>