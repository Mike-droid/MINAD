<?php
    include("datosConexionBBDD.php");

    $idInstitucion = $_GET["idInstitucion"];

    $base->query("DELETE FROM institucion WHERE idInstitucion = '$idInstitucion'");

    header("location:instituciones.php");
?>
