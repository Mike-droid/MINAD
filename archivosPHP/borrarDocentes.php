<?php 
    include("datosConexionBBDD.php");

    $numTrabajador = $_GET["NumeroTrabajador"]; //!debe llamarse igual que docentes.php línea 65

    $base->query("DELETE FROM docentes WHERE NumeroTrabajador = '$numTrabajador'");

    header("location:docentes.php");
?>