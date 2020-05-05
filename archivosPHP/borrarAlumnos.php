<?php 
    include("datosConexionBBDD.php");

    $numCon = $_GET["NumeroControl"]; //!Tiene que llamarse igual que alumnos.php línea 65

    $base->query("DELETE FROM alumnos WHERE NumeroControl = '$numCon'");

    header("location:alumnos.php");
?>
