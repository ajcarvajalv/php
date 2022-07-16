<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    if (empty($_POST["txtUsuario"]) or empty($_POST["txtClave"])) {
        $msg = "Válido solo para usuarios registrados";
    } else {
        header("Location: acceso-confirmado.php");
    }

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>

    <main class="container">
        <div class="row">
            <div class="col-12 col-sm-3 py-2">
                <h1>Formulario</h1>
            </div>
            <div class="row">
                <?php
                if ($_POST) {
                echo "<div class='col-12 alert alert-danger'>" . $msg . "</div>";
                } ?>
            </div>
            <div class="row">
                <div class="col-12 col-sm-4">
                    <form method="POST" action="">
                        <div class="py-2">
                            <label for="txtUsuario" class="form-label">Usuario:</label>
                            <input type="text" name="txtUsuario" id="txtUsuario" class="form-control">
                        </div>

                        <div class="py-2">
                            <label for="txtClave" class="form-label">Clave:</label>
                            <input type="password" name="txtClave" id="txtClave" class="form-control">
                        </div>

                        <div class="py-2">
                            <button class="btn btn-primary" type="submit">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>

</html>