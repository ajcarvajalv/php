<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Definición
function print_f($variable)
{
    //Si es un array, lo recorro y guardo el contenido en el archivo “datos.txt”
    if (is_array($variable)) {
        $archivo = fopen('datos.txt', 'a+');
        fwrite($archivo, "\nDatos del array: \n");
        foreach ($variable as $dato) {
            fwrite($archivo, "\n" . $dato);
        }
        fclose($archivo);
    } else {
        //Entonces es string, guardo el contenido en el archivo “datos.txt”
        $archivo = fopen('datos.txt', 'a');
        fwrite($archivo, $variable);
        fclose($archivo);
    }

    echo "¡Archivo generado correctamente!";
}
//Uso
$aNotas = array(8, 5, 7, 9, 10);
$msg = "Este es un mensaje";

print_f($aNotas);