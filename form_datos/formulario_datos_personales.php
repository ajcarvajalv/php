<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de datos personales</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    <main class="container px-5">
        <div class="row">
            <div class="col-12 py-4">
                <h1 class="text-center">Formulario de datos personales</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form method="POST" action="resultado.php">
                    
                    <div class="py-3">
                    <label for="txtNombre" class="form-label">Nombre:</label>
                    <input type="text" name="txtNombre" id="txtNombre" class="form-control">
                    </div>

                    <div class="py-3">
                    <label for="txtDocIdentidad" class="form-label">Documento de Identidad:</label>
                    <input type="text" name="txtDocIdentidad" id="txtDocIdentidad" class="form-control">
                    </div>

                    <div class="py-3">
                    <label for="txtTelefono" class="form-label">Teléfono:</label>
                    <input type="text" name="txtTelefono" id="txtTelefono" class="form-control">
                    </div>

                    <div class="py-3">
                    <label for="numEdad" class="form-label">Edad:</label>
                    <input type="number" name="numEdad" id="numEdad" class="form-control">
                    </div>

                    <div class="py-3 float-end">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>

                </form>
            </div>
        </div>
    </main>    
</body>
</html>