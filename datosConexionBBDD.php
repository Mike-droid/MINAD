<?php
$db_host="localhost:3308"; //Dirección de la base de datos IMPORTANTE PONER EL PUERTO
$db_nombre="proyectosinvestigacion"; //nombre de base de datos
$db_usuario="root"; //nombre del usuario
$db_contra=""; //contraseña
$conexion=mysqli_connect($db_host,$db_usuario,$db_contra,$db_nombre) or die(mysqli_error());
?>