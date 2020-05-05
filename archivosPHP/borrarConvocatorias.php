<?php 
    include("datosConexionBBDD.php");

    $idConvo = $_GET["idConvocatorias"]; //!tiene que llamarse igual que ConsultarConvocatorias.php línea 33

    $base->query("DELETE FROM convocatorias WHERE idConvocatorias = '$idConvo'");

    header("location:ConsultarConvocatorias.php");
?>