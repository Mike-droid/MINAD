<?php
    include("datosConexionBBDD.php");

    $idEvidencia = $_GET["idEvidencias"]; //!Debe llamarse igual que evidencias.php línea 77

    $base->query("DELETE FROM evidencias WHERE idEvidencias = '$idEvidencia'");

    header("location:evidencias.php");
?>