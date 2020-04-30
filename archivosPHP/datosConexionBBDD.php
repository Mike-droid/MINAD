<?php
    try {
        $base = new PDO('mysql:host=localhost:3308; dbname=proyectosinvestigacion2','root','');

        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $base->exec("SET CHARACTER SET UTF8");
    } catch (Exception $e) {
        die('Error' . $e->getMessage());
        echo "Línea del error" . $e->getLine();
    }
?>