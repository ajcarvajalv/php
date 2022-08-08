<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$pos = isset($_GET["id"]) && $_GET["id"] >= 0 ? $_GET["id"] : "";

if(file_exists("tareas.txt")){
    $jsonTareas = file_get_contents("tareas.txt");
    $aTareas = json_decode($jsonTareas, true);

    if($aTareas === NULL){
        $aTareas = array();
    }

} else {
    $aTareas = array();
}

if($_POST){

    if(isset($_POST["btnEnviar"])){
        $tituloTarea = $_POST["txtTitulo"];
        $prioridadTarea = $_POST["lstPrioridad"];
        $usuarioTarea = $_POST["lstUsuario"];
        $estadoTarea = $_POST["lstEstado"];
        $descripcionTarea = $_POST["txtDescripcion"];

        if($pos >= 0){
            $aTareas[$pos] = array("fecha" => $aTareas[$pos]["fecha"],
                           "titulo" => $tituloTarea,
                           "prioridad" => $prioridadTarea,
                           "usuario" => $usuarioTarea,
                           "estado" => $estadoTarea,
                           "descripcion" => $descripcionTarea);
        
        } else {
            $aTareas[] = array("fecha" => date('d/m/Y'),
                        "titulo" => $tituloTarea,
                        "prioridad" => $prioridadTarea,
                        "usuario" => $usuarioTarea,
                        "estado" => $estadoTarea,
                        "descripcion" => $descripcionTarea);

        }

        //Convierto el array de clientes a jsonClientes
        $jsonTareas = json_encode($aTareas);

        //Almaceno el string jsonClientes en el archivo.txt
        file_put_contents("tareas.txt", $jsonTareas);

    }

    if(isset($_POST["btnCancelar"])){
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
     unset($aTareas[$pos]);
    
    //Convierto el nuevo array de clientes a json
    $jsonTareas = json_encode($aTareas);
    
    //Almaceno el string jsonClientes en el archivo.txt y vuelvo al inicio
    file_put_contents("tareas.txt", $jsonTareas);
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/fontawesome.min.css">
</head>
<body>
    <main class="container">
        <div class="row">
            <div class="col-12 py-4">
                <h1 class="text-center">Gestor de tareas</h1>
            </div>
        </div>
        <div class="row">
            <form action="" method="POST">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <label for="lstPrioridad" class="form-label">Prioridad</label>
                            <select name="lstPrioridad" id="lstPrioridad" class="form-control">
                                <option <?php echo !isset($aTareas[$pos]) ? "selected" : ""; ?> disabled>Seleccionar</option>
                                <option value="Alta" <?php echo isset($aTareas[$pos]) && $aTareas[$pos]["prioridad"] == "Alta" ? "selected" : ""; ?>>Alta</option>
                                <option value="Media" <?php echo isset($aTareas[$pos]) && $aTareas[$pos]["prioridad"] == "Media" ? "selected" : ""; ?>>Media</option>
                                <option value="Baja" <?php echo isset($aTareas[$pos]) && $aTareas[$pos]["prioridad"] == "Baja" ? "selected" : ""; ?>>Baja</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-4">
                        <label for="lstUsuario" class="form-label">Usuario</label>
                            <select name="lstUsuario" id="lstUsuario" class="form-control">
                                <option <?php echo !isset($aTareas[$pos]) ? "selected" : ""; ?> disabled>Seleccionar</option>
                                <option value="Ana" <?php echo isset($aTareas[$pos]) && $aTareas[$pos]["usuario"] == "Ana" ? "selected" : ""; ?>>Ana</option>
                                <option value="Bernabé" <?php echo isset($aTareas[$pos]) && $aTareas[$pos]["usuario"] == "Bernabé" ? "selected" : ""; ?>>Bernabé</option>
                                <option value="Daniela" <?php echo isset($aTareas[$pos]) && $aTareas[$pos]["usuario"] == "Daniela" ? "selected" : ""; ?>>Daniela</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-4">
                        <label for="lstEstado" class="form-label">Estado</label>
                            <select name="lstEstado" id="lstEstado" class="form-control">
                                <option <?php echo !isset($aTareas[$pos]) ? "selected" : ""; ?> disabled>Seleccionar</option>
                                <option value="Sin asignar" <?php echo isset($aTareas[$pos]) && $aTareas[$pos]["estado"] == "Sin asignar" ? "selected" : ""; ?>>Sin asignar</option>
                                <option value="Asignado" <?php echo isset($aTareas[$pos]) && $aTareas[$pos]["estado"] == "Asignado" ? "selected" : ""; ?>>Asignado</option>
                                <option value="En proceso" <?php echo isset($aTareas[$pos]) && $aTareas[$pos]["estado"] == "En proceso" ? "selected" : ""; ?>>En proceso</option>
                                <option value="Terminado" <?php echo isset($aTareas[$pos]) && $aTareas[$pos]["estado"] == "Terminado" ? "selected" : ""; ?>>Terminado</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="txtTitulo" class="form-label">Título</label>
                    <input type="text" name="txtTitulo" id="txtTitulo" class="form-control"  value="<?php echo isset($aTareas[$pos]) ? $aTareas[$pos]["titulo"] : ""; ?>">
                </div>
                <div class="col-12">
                    <label for="txtDescripcion" class="form-label">Descripción</label>
                    <textarea name="txtDescripcion" id="txtDescripcion" rows="3" class="form-control"><?php echo isset($aTareas[$pos]) ? $aTareas[$pos]["descripcion"] : ""; ?></textarea>
                </div>
                <div class="col-12 text-center py-2">
                    <button name="btnEnviar" type="submit" class="btn btn-primary">Enviar</button>
                    <button name="btnCancelar" type="submit" class="btn btn-secondary">Cancelar</button>
                </div>
                </form>
        </div>
        <?php if(count($aTareas)): ?>
        <div class="row">
            <div class="col-12 mt-4">
                <table class="table table-hover border">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha de inserción</th>
                            <th>Título</th>
                            <th>Prioridad</th>
                            <th>Usuario</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($aTareas as $pos => $tarea) {?>
                        <tr>
                            <td><?php echo $pos+1 ?></td>
                            <td><?php echo $tarea["fecha"]?></td>
                            <td><?php echo $tarea["titulo"]?></td>
                            <td><?php echo $tarea["prioridad"]?></td>
                            <td><?php echo $tarea["usuario"]?></td>
                            <td><?php echo $tarea["estado"]?></td>
                            <td>
                                <a href="index.php?id=<?php echo $pos; ?>&do=editar"><i class="fa-solid fa-pen-to-square me-1 p-2 btn btn-secondary"></i></a>
                                <a href="index.php?id=<?php echo $pos; ?>&do=eliminar"><i class="fa-solid fa-trash-can p-2 btn btn-danger"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php else: ?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info" role="alert">
                        Aún no se han cargado tareas.
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>