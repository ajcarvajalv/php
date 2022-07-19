<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//Definicion
function promediar($aNotas){

    $sumaTotal = 0;

    foreach ($aNotas as $nota) {
        $sumaTotal = $sumaTotal + $nota; 
    }

    $promedio = $sumaTotal / count($aNotas);

    return $promedio;

}

//Uso

$aNotas = array(8, 4, 5, 3, 9, 1);
echo "El promedio es: " . promediar($aNotas) . "<br>";


?>