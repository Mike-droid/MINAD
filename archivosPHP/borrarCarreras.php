<?php 
    include("datosConexionBBDD.php");

    $idCarrera = $_GET["idCarrera"]; //!debe llamarse igual que carreras.php línea 44

    $base->query("DELETE FROM carrera WHERE idCarrera = '$idCarrera'");

    header("location:carreras.php");
?>