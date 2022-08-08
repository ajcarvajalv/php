<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//Pregunto si existe el archivo
if(file_exists('invitados.txt')){
    //Si existe el archivo, lo abro y cargo en una variable del tipo array
    $archivoInvitados = fopen('invitados.txt', 'r');
    $aInvitados = fgetcsv($archivoInvitados, 0, ",");
    fclose($archivoInvitados);
}else{
    //Si no, el array queda como un array vacío
    $aInvitados = array();
}

if($_POST){

    if(isset(($_POST["btnDocumento"]))){
    $documento = $_POST["txtDocumento"];

        //Si el documento no está en la lista, se muestra un mensaje de bienvenida
        if(in_array($documento, $aInvitados)){
            $msgOk = "¡Bienvenido a la fiesta!";
        } else {
        //Si no, el mensaje "No se encuentra en la lista de invitados"
            $msgNo = "No se encuentra en la lista de invitados.";
        }
    }

    if(isset(($_POST["btnCodSecreto"]))){
        $codigo = $_POST["txtCodSecreto"];

        //Si el código es "verde", entonces mostrará "Su código de acceso es..."
        if(strtolower($codigo) == "verde"){
            $msgVip = "Su código de acceso es " . rand(0000, 9999);
        } else {
        //Si no, mostrará "Ud no es invitado VIP."
            $msgNoVip = "Ud no es invitado VIP.";
        } 
    }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de invitados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <div class="col-12 my-3">
                <h1>Lista de invitados</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p>Complete el siguiente formulario:</p>
                <?php if (isset($msgOk)){
                    echo "<div class='alert alert-success' role='alert'>" . $msgOk . "</div>";
                } elseif (isset($msgNo)){
                    echo "<div class='alert alert-danger' role='alert'>" . $msgNo . "</div>";
                } elseif (isset($msgVip)){
                    echo "<div class='alert alert-success' role='alert'>" . $msgVip . "</div>";
                } elseif (isset($msgNoVip)){
                    echo "<div class='alert alert-danger' role='alert'>" . $msgNoVip . "</div>";
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6">
                <form method="POST" action="">
                    <div class="py-2">
                    <label for="txtDocumento" class="form-label">Ingrese su documento de identidad</label>
                    <input type="text" name="txtDocumento" id="txtDocumento" class="form-control">
                    <button type="submit" name="btnDocumento" class="btn btn-primary">Verificar invitado</button>
                    </div>

                    <div class="py-2">
                    <label for="txtCodSecreto" class="form-label">Ingrese el código secreto para el pase VIP</label>
                    <input type="text" name="txtCodSecreto" id="txtCodSecreto" class="form-control">
                    <button type="submit" name="btnCodSecreto" class="btn btn-primary">Verificar invitado</button>
                    </div>
                </form>
            </div>
        </div>
    </main>    
</body>
</html>