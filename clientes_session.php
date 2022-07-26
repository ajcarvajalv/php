<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ( isset($_SESSION["listadoClientes"]) ) {
    //Si existe la variable de sesión listadoClientes asigno su contenido a aClientes
    $aClientes = $_SESSION["listadoClientes"];
} else {
    $aClientes = array();
}


if ( $_POST ) {
    
    //Si hace clic en Enviar, entonces:
    if ( isset($_POST["btnEnviar"]) ) {

        //Asignamos en variables los datos que vienen del formulario
        $nombre = $_POST["txtNombre"];
        $docIdentidad = $_POST["txtDocIdentidad"];
        $telefono = $_POST["txtTelefono"];
        $edad = $_POST["txtEdad"];

        $aClientes[] = array(
            "nombre" => $nombre,
            "docIdentidad" => $docIdentidad,
            "telefono" => $telefono,
            "edad" => $edad
        );
        //Actualiza el contenido de variable de sesión
        $_SESSION["listadoClientes"] = $aClientes;

    } elseif ( isset($_POST["btnEliminar"]) ) {
        //Si hace click en Eliminar:
        //session_destroy;
        session_destroy();
        $aClientes = array();
    }

    
    //Compruebo que no sea botón eliminar ni botón enviar
    if( !isset($_POST["btnEnviar"]) && !isset($_POST["btnEliminar"]) ){

        //Paso el nombre del botón a una variable
        $nombreBtn = array_keys($_POST)[0];
        
        //Convierto nombre del botón a array, separo nombre de consecutivo
        $aNombreBtn = explode('_', $nombreBtn);

        //Borro el registro correspondiente al consecutivo y actualizo array clientes
        unset($_SESSION["listadoClientes"][$aNombreBtn[1]]);
        $aClientes = $_SESSION["listadoClientes"];

    }
}

//clientes_session.php?do=eliminar&id=1
/*
if(isset($_GET["pos"])){
    //Recupero dato que viene por la query
    $pos = $_GET["pos"];

    //Elimina la posición
    unset($aClientes[$pos]);

    //Actualizo variable de sesión con el array actualizado
    $_SESSION["listadoClientes"] = $aClientes;
    header("Location: clientes_session.php");

}
*/


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de clientes</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <main class="container">
        <div class="row">
            <div class="col-12 py-4">
                <h1 class="text-center">Listado de clientes</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-sm-3">
                <form action="" method="POST">

                    <div class="py-1">
                        <label for="txtNombre" class="form-label">Nombre:</label>
                        <input type="text" id="txtNombre" name="txtNombre" class="form-control" placeholder="Ingrese el nombre y apellido">
                    </div>

                    <div class="py-1">
                        <label for="txtDocIdentidad" class="form-label">Documento de Identidad:</label>
                        <input type="text" id="txtDocIdentidad" name="txtDocIdentidad" class="form-control">
                    </div>

                    <div class="py-1">
                        <label for="txtTelefono" class="form-label">Teléfono:</label>
                        <input type="text" id="txtTelefono" name="txtTelefono" class="form-control">
                    </div>

                    <div class="py-1">
                        <label for="txtEdad" class="form-label">Edad:</label>
                        <input type="text" id="txtEdad" name="txtEdad" class="form-control">
                    </div>

                    <div class="py-3">
                        <button type="submit" name="btnEnviar" class="btn btn-primary">Enviar</button>
                        <button type="submit" name="btnEliminar" class="btn btn-danger">Eliminar todo</button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-sm-8 offset-sm-1">
                <table class="table table-hover border shadow">
                    <thead>
                        <tr>
                            <th>Nombre:</th>
                            <th>Doc. Identidad:</th>
                            <th>Teléfono:</th>
                            <th>Edad:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form method="POST">
                            <?php foreach ($aClientes as $pos => $cliente) : ?>
                                <tr>
                                    <td><?php echo $cliente["nombre"]; ?></td>
                                    <td><?php echo $cliente["docIdentidad"]; ?></td>
                                    <td><?php echo $cliente["telefono"]; ?></td>
                                    <td><?php echo $cliente["edad"]; ?></td>
                                    <td><button type="submit" name="btnEliminar_<?php echo $pos; ?>" class="btn btn-danger">X</button></td>
                                </tr>
                            <?php endforeach; ?>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>