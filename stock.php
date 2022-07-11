<?php
$stock = 800;

/* Si stock es mayor que 0, entonces:
    imprime "Hay stock"
Sino
    imprime "No hay stock" */

if($stock > 0){
    echo "Hay stock". "<br>";
} else {
    echo "No hay stock". "<br>";
}

$edad = 25;
echo $edad >= 18? "Es mayor de edad" : "Es menor de edad" . "<br>"; 

?>