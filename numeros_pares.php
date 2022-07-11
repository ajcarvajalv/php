<?php

for ($i=1; $i <= 100; $i++){
    echo $i . ", ";
}

echo "<hr>";

for ($i=2; $i <= 100; $i+=2){
    echo $i . ", ";
}

echo "<hr>";

for ($i=2; $i <= 100; $i+=2){

    if($i>60){
        break;
    }

    echo $i . ", ";
}

?>