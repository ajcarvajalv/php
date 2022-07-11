<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$aProductos = array();
$aProductos[] = array(
    "nombre" => "Smart TV 55\" 4K UHD",
    "marca" => "Hitachi",
    "modelo" => "554KS20",
    "stock" => 60,
    "precio" => 58000,
);
$aProductos[] = array(
    "nombre" => "Samsung Galaxy A30 Blanco",
    "marca" => "Samsung",
    "modelo" => "Galaxy A30",
    "stock" => 0,
    "precio" => 22000,
);
$aProductos[] = array(
    "nombre" => "Aire Acondicionado Split Inverter Frío/Calor Surrey 2900F",
    "marca" => "Surrey",
    "modelo" => "553AIQ1201E",
    "stock" => 5,
    "precio" => 45000,
);
$aProductos[] = array(
    "nombre" => "Impresora HP Láser",
    "marca" => "HP",
    "modelo" => "P1102w",
    "stock" => 20,
    "precio" => 20000,
);

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de productos</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>

    <main class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="py-5">Listado de productos</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table class="table table-hover border">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $subtotal = 0;

                        for ($i = 0; $i < count($aProductos); $i++) {
                            echo "<tr>";
                            echo "<td>" . $aProductos[$i]["nombre"] . "</td>";
                            echo "<td>" . $aProductos[$i]["marca"] . "</td>";
                            echo "<td>" . $aProductos[$i]["modelo"] . "</td>";
                            echo "<td>" . ($aProductos[$i]["stock"] > 10 ? "Hay stock" : ($aProductos[$i]["stock"] <= 10 && $aProductos[$i]["stock"] > 0 ? "Poco stock" : "No hay stock")) . "</td>";
                            echo "<td> $ " . $aProductos[$i]["precio"] . "</td>";
                            echo "<td><button class='btn btn-primary'>Comprar</button></td>";
                            echo "</tr>";

                            $subtotal = $subtotal + $aProductos[$i]["precio"];
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                echo "El subtotal es: $ " . $subtotal;
                ?>
            </div>
        </div>
    </main>
</body>

</html>