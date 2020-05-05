<?php 
    include("datosConexionBBDD.php");

    $idReporte = $_GET["idReporte"]; //tiene que llamarse igual que reportes.php línea 54

    $base->query("DELETE FROM reporte WHERE idReporte = '$idReporte'");

    header("location:reportes.php");
?>