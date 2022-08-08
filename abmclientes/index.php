<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$pos = isset($_GET["id"]) && $_GET["id"] >= 0 ? $_GET["id"] : "";

//Pregunto si existe el archivo
if(file_exists("archivo.txt")){
    //Si existe, leo y almaceno el contenido en jsonClientes
    $jsonClientes = file_get_contents("archivo.txt");

    //Convierto jsonClientes en un array llamado aClientes
    $aClientes = json_decode($jsonClientes, true);
}else{
    //Si no existe el archivo
    //Creo un aClientes inicializado como un array vacío
    $aClientes = array();
}

if(isset($_POST["btnNuevo"])){
    header("Location: index.php");
}

if($_POST){

    if(isset($_POST["btnGuardar"])){
        $documento = trim($_POST["txtDocIdentidad"]);
        $nombre = trim($_POST["txtNombre"]);
        $telefono = trim($_POST["numTelefono"]);
        $correo = trim($_POST["txtCorreo"]);
        $nombreImagen = "";

        if($pos>=0){

            if($_FILES["imagen"]["error"] === UPLOAD_ERR_OK){
                $nombreAleatorio = date("Ymdhmsi");
                $archivo_tmp = $_FILES["imagen"]["tmp_name"];
                $extension = strtolower(pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION));
                if($extension == "jpg" || $extension == "jpeg" || $extension == "png"){
                $nombreImagen = "$nombreAleatorio.$extension";
                move_uploaded_file($archivo_tmp, "imagenes/$nombreImagen");
                }

                //Elimina imagen anterior                
                if(file_exists("imagenes/".$aClientes[$pos]["nombreImg"])){
                    unlink("imagenes/".$aClientes[$pos]["nombreImg"]);
                }
                
            } else {
                //Mantener el nombreImagen que tenía antes
                $nombreImagen = $aClientes[$pos]["nombreImg"];
            }

        //Actualizar
        $aClientes[$pos] = array("documento" => $documento,
                        "nombre" => $nombre,
                        "telefono" => $telefono,
                        "correo" => $correo,
                        "nombreImg" => $nombreImagen);
        } else {
        //Insertar
        $aClientes[] = array("documento" => $documento,
                        "nombre" => $nombre,
                        "telefono" => $telefono,
                        "correo" => $correo,
                        "nombreImg" => $nombreImagen);
        }

        
        //Convierto el array de clientes a jsonClientes
        $jsonClientes = json_encode($aClientes);

        //Almaceno el string jsonClientes en el archivo.txt
        file_put_contents("archivo.txt", $jsonClientes);
    }

    if(isset($_POST["btnNuevo"])){
        header("Location: index.php");
    }
}

if(isset($_GET["do"]) && $_GET["do"] == "editar"){
    //Asigno a variable $pos el número del id
    $pos = isset(($_GET["id"])) && $_GET["id"] >= 0 ? $_GET["id"] : "";
}

if(isset($_GET["do"]) && $_GET["do"] == "eliminar"){
    //Recupero el dato que viene desde la query string vía get
    $pos = isset(($_GET["id"])) && $_GET["id"] >= 0 ? $_GET["id"] : "";

    //Elimino la posición del array indicada
     unset($aClientes[$pos]);
    
    //Convierto el nuevo array de clientes a json
    $jsonClientes = json_encode($aClientes);
    
    //Almaceno el string jsonClientes en el archivo.txt y vuelvo al inicio
    file_put_contents("archivo.txt", $jsonClientes);
    header("Location: index.php");

}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <main class="container">
    <div class="row">
        <div class="col-12 text-center py-4"><h1>Registro de clientes</h1></div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-5">
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="txtDocIdentidad" class="form-label">Documento de Identidad: *</label>
                <input type="text" name="txtDocIdentidad" id="txtDocIdentidad" class="form-control" value="<?php echo (isset($aClientes[$pos])) ? $aClientes[$_GET["id"]]["documento"] : ""; ?>" required>

                <label for="txtNombre" class="form-label">Nombre: *</label>
                <input type="text" name="txtNombre" id="txtNombre" class="form-control" value="<?php echo (isset($aClientes[$pos])) ? $aClientes[$_GET["id"]]["nombre"] : ""; ?>" required>

                <label for="numTelefono" class="form-label">Teléfono:</label>
                <input type="number" name="numTelefono" id="numTelefono" class="form-control" value="<?php echo (isset($aClientes[$pos])) ? $aClientes[$_GET["id"]]["telefono"] : ""; ?>">

                <label for="txtCorreo" class="form-label">Correo electrónico: *</label>
                <input type="email" name="txtCorreo" id="txtCorreo" class="form-control" value="<?php echo (isset($aClientes[$pos])) ? $aClientes[$_GET["id"]]["correo"] : ""; ?>">

                <label for="imagen" class="form-label">Archivo adjunto</label>
                <input type="file" name="imagen" id="imagen" accept=".jpg, .jpeg, .png">
                <small class="d-block">Archivos admitidos: .jpg, .jpeg, .png</small>

                <div class="py-3">
                <button type="submit" class="btn btn-primary" name="btnGuardar">Guardar</button>
                <button type="submit" class="btn btn-danger" name="btnNuevo">Nuevo</button>
                </div>
            </form>
        </div>
        <div class="col-12 col-sm-7">
            <table class="table table-hoover border">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Documento</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($aClientes)) :
                        foreach($aClientes as $pos => $cliente): ?>
                        <tr>
                            <td><img src="imagenes/<?php echo $cliente["nombreImg"] != "" ? $cliente["nombreImg"] : "default.png"; ?>" class="img-thumbnail"></td>
                            <td><?php echo $cliente["documento"]; ?></td>
                            <td><?php echo $cliente["nombre"]; ?></td>
                            <td><?php echo $cliente["correo"]; ?></td>
                            <td>
                                <a href="index.php?id=<?php echo $pos; ?>&do=editar"><i class="fa-solid fa-pen-to-square py-2"></i></a>
                                <a href="index.php?id=<?php echo $pos; ?>&do=eliminar"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                    <?php endforeach;
                    endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    </main>
</body>
</html>