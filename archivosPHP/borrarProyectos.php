<?php  
    include("datosConexionBBDD.php");

    $idProyecto = $_GET["idProyectos"]; //!debe llamarse igual que proyectos.php línea 63

    $base->query("DELETE FROM proyectos WHERE idProyectos = '$idProyecto'");

    header("location:proyectos.php");
?>