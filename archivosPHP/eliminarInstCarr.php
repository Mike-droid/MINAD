<?php 
    include("datosConexionBBDD.php");

    $idInst = $_GET["Institucion_idInstitucion"];

    $idCarrera = $_GET["Carrera_idCarrera"];

    $base->query("DELETE FROM institucion_has_carrera 
    WHERE Institucion_idInstitucion = '$idInst' 
    AND Carrera_idCarrera = '$idCarrera'");

    header("location:InstCarr.php");
?>