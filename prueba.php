<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    

    $fila = 1;
    if (($gestor = fopen("test.csv", "r")) !== FALSE) {
        while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
            $numero = count($datos);
            echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
            $fila++;
            for ($c=0; $c < $numero; $c++) {
                echo $datos[$c] . "<br />\n";
            }
        }
        fclose($gestor);
    }


    $miArray = array();
    $miArray[0] = "Hola";
    $miArray[37] = "Chau";
    $miArray[] = "Adiós";
    $miArray[] = "Buenas tardes";
    $miArray[1] = "Hello";
    $miArray[] = "Buenas noches";
    //print_r($miArray);
    //var_dump($miArray);

    $miArray2 = array();
    $miArray2[0] = array();
    $miArray2[1] = array();
    $miArray2[2] = array();
    $miArray2[0][0] = "Chau";
    $miArray2[0][1] = "Adios";
    $miArray2[0][1] = "Algo";
    $miArray2[1][1] = "Hello";
    $miArray2[3] = "Bye";
    $miArray2[2][0] = "Hi";
    //print_r($miArray2);
    //echo $miArray2[1][1];

    $aAgenda = array();
    $aAgenda[0] = array();
    $aAgenda[1] = array();
    $aAgenda[0][0] = "Lu";
    $aAgenda[0][1] = "Ma";
    $aAgenda[0][2] = "Mi";
    $aAgenda[0][3] = "Ju";
    $aAgenda[0][4] = "Vi";
    $aAgenda[1][0] = "Curso";
    $aAgenda[1][1] = "Libre";
    $aAgenda[1][2] = "Curso";
    $aAgenda[1][3] = "Libre";
    $aAgenda[1][4] = "Curso";
    //print_r($aAgenda);

    $miArray3 = array(
                array("Chau", "Adios", "Algo"),
                array("", "Hello"),
                array("Hi"),
                "Bye");
    //print_r($miArray3);

    $aAuto = array();
    $aAuto["color"] = array("Negro", "Verde");
    $aAuto["marca"] = "Ford";
    $aAuto["anio"] = 1908;
    $aAuto["precio"] = "USD 800 a USD 1000";

    echo "El auto " . $aAuto["marca"] . " del año " . $aAuto["anio"] . " es de color " . $aAuto["color"][0] . " y su precio es " . $aAuto["precio"] . "<br>";
    
    $usuario = "invitado";

    if($usuario == "admin"){
        echo "Usted es el administrador <br>";
    }

    if($usuario != "admin"){
        echo "Bienvenid@ al sitio web <br>";
    }

    $valor = rand(1,5);

    if ($valor == 1 || $valor == 3 || $valor == 5 ){
        echo "El número $valor es impar <br>";
    } else {
        echo "El número $valor es par <br>";
    }

    echo $valor == 1 || $valor == 3 || $valor == 5 ? "El número $valor es impar <br>" : "El número $valor es par <br>";

    if ($valor%2 == 0 ){
        echo "El número $valor es par <br>";
    } else {
        echo "El número $valor es impar <br>";
    }

    $miAuto = array(
        "Patente" => "AA123HB",
        "Marca" => "Ford",
    );

    foreach ($miAuto as $clave => $valor) {
        echo "La $clave es $valor <br>";
    }

    $aClientes = array(
        array("dni" => "33300012", "nombre" => "Ana Valle"),
        array("dni" => "33300013", "nombre" => "Bernabé"),
    );

    foreach ($aClientes as $pos => $cliente) {
        echo "En la posición $pos contiene " . $cliente["nombre"] . "<br>";
    }

    function sumar($num1, $num2) {
        $resultado = $num1 + $num2;
        return $resultado;
    }

    function alcuadrado($num) {
        return $num * $num;
    }

    echo "La suma es " . sumar(5000, 800) . "<br>";
    echo alcuadrado(sumar(10, 5)) . "<br>";

    function concatenar($cadena1, $cadena2) {
        return "$cadena1 $cadena2";
    }

    $result = concatenar("El libro", "de la selva");
    echo $result . "<br>";

    $result = concatenar("El día", "después de mañana");
    echo $result . "<br>";
?>