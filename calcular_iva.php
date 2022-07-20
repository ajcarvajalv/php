<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$iva = 19;
$precioSinIva = 0;
$precioConIva = 0;
$ivaCantidad = 0;

if ($_POST) {
    $iva = $_POST["lstIva"];
    $precioSinIva = ($_POST["txtSinIva"]) > 0? $_POST["txtSinIva"] : 0;
    $precioConIva = ($_POST["txtConIva"]) > 0? $_POST["txtConIva"] : 0;

    if ($precioSinIva > 0){
        $precioConIva = $precioSinIva * ($iva/100+1);
    }

    if ($precioConIva > 0){
        $precioSinIva = $precioConIva / ($iva/100+1);
    }

    $ivaCantidad = $precioConIva - $precioSinIva;

    }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IVA</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <main class="container">
        <div class="row py-4">
            <div class="col-12">
                <h1 class="text-center">Calculadora de IVA</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-sm-3">
                <form method="POST">
                    <div class="py-3">
                        <label for="lstIva" class="form-label">IVA</label>
                        <select name="lstIva" id="lstIva" class="form-control">
                            <option value="10.5">10.5 %</option>
                            <option value="19" selected>19 %</option>
                            <option value="21">21 %</option>
                            <option value="27">27 %</option>
                        </select>
                    </div>

                    <div class="py-3">
                        <label for="txtSinIva" class="form-label">Precio sin IVA:</label>
                        <input type="text" name="txtSinIva" id="txtSinIva" class="form-control">
                    </div>

                    <div class="py-3">
                        <label for="txtConIva" class="form-label">Precio con IVA:</label>
                        <input type="text" name="txtConIva" id="txtSinIva" class="form-control">
                    </div>

                    <div class="py-3">
                        <button type="submit" class="btn btn-primary">CALCULAR</button>
                    </div>

                </form>
            </div>

            <div class="col-12 col-sm-6 offset-2">
                <table class="table table-hover border">
                    <tr>
                        <th>IVA:</th>
                        <td><?php echo $iva ?> %</td>
                    </tr>

                    <tr>
                        <th>Precio sin IVA:</th>
                        <td>$ <?php echo number_format($precioSinIva, 2, ',', '.') ?></td>
                    </tr>

                    <tr>
                        <th>Precio con IVA:</th>
                        <td>$ <?php echo number_format($precioConIva, 2, ',', '.') ?></td>
                    </tr>

                    <tr>
                        <th>IVA cantidad:</th>
                        <td>$ <?php echo number_format($ivaCantidad, 2, ',', '.') ?></td>
                    </tr>
                </table>
            </div>
        </div>

    </main>
</body>

</html>