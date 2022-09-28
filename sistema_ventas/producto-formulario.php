<?php
$pg = "Listado de productos";
include_once "config.php";
include_once "entidades/producto.php";
include_once "entidades/tipoproducto.php";
include_once "header.php";

$tipoProducto = new TipoProducto();
$aTiposProductos = $tipoProducto->obtenerTodos();
$producto = new Producto();

if ($_POST) {
    if (isset($_POST["btnGuardar"])) {

        $producto->cargarFormulario($_REQUEST);
        $nombreImagen = "";

        //Estoy actualizando
        if (isset($_GET["id"]) && $_GET["id"] > 0) {

            $productoAnt = new Producto();
            $productoAnt->idproducto = $_GET["id"];
            $productoAnt->obtenerPorId();
            
            if($_FILES["imgProducto"]["error"] === UPLOAD_ERR_OK){
                $nombreAleatorio = date("Ymdhmsi");
                $archivo_tmp = $_FILES["imgProducto"]["tmp_name"];
                $extension = strtolower(pathinfo($_FILES["imgProducto"]["name"], PATHINFO_EXTENSION));
                $nombreImagen = "$nombreAleatorio.$extension";

                if($extension == "jpg" || $extension == "jpeg" || $extension == "png"){    
                    //Elimino imagen anterior
                    if(file_exists("files/$productoAnt->imagen")){
                        unlink("files/$productoAnt->imagen");
                    }

                    //Subo imagen nueva
                    move_uploaded_file($archivo_tmp, "./img/$nombreImagen");
                }

                if(file_exists("./img/".$productoAnt->imagen)){
                    unlink("./img/".$productoAnt->imagen);
                }

                $producto->imagen=$nombreImagen;
            } else {
                $producto->imagen=$productoAnt->imagen;
            }

            $producto->actualizar();
            $msg["texto"] = "Actualizado correctamente";
            $msg["codigo"] = "alert-success";
        } else {

            if($_FILES["imgProducto"]["error"] === UPLOAD_ERR_OK){
                $nombreAleatorio = date("Ymdhmsi");
                $archivo_tmp = $_FILES["imgProducto"]["tmp_name"];
                $extension = strtolower(pathinfo($_FILES["imgProducto"]["name"], PATHINFO_EXTENSION));
                $nombreImagen = "$nombreAleatorio.$extension";

                if($extension == "jpg" || $extension == "jpeg" || $extension == "png"){    
                    move_uploaded_file($archivo_tmp, "./img/$nombreImagen");
                }

                $producto->imagen=$nombreImagen;
            }

            $producto->insertar();
            $msg["texto"] = "Insertado correctamente";
            $msg["codigo"] = "alert-success";
        }

    } else if (isset($_POST["btnBorrar"])) {
        $producto = new Producto();
        $producto->cargarFormulario($_REQUEST);
        $producto->obtenerPorId();
        if(file_exists("files/$producto->imagen")){
            unlink("files/$producto->imagen");
        }
        $producto->eliminar();
        header("Location: tipoproducto-listado.php");
    }
}


if (isset($_GET["id"]) && $_GET["id"] > 0){
    $producto->cargarFormulario($_REQUEST);
    $producto->obtenerPorId();
}

?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Producto</h1>

        <?php if (isset($msg)): ?>
            <div class="row">
                <div class="col-12">
                    <div class="alert <?php echo $msg["codigo"]; ?>" role="alert">
                        <?php echo $msg["texto"]; ?>
                    </div>
                </div>
            </div>
        <?php endif;?>

        <div class="row">
                <div class="col-12 mb-3">
                    <a href="producto-listado.php" class="btn btn-primary mr-2">Listado</a>
                    <a href="producto-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
                    <button type="submit" class="btn btn-success mr-2" id="btnGuardar" name="btnGuardar">Guardar</button>
                    <button type="submit" class="btn btn-danger" id="btnBorrar" name="btnBorrar">Borrar</button>
                </div>
        </div>

        <div class="row">
                <div class="col-6 form-group">
                    <label for="txtNombre">Nombre:</label>
                    <input type="text" required class="form-control" name="txtNombre" id="txtNombre" value="<?php echo $producto->nombre ?>">
                </div>
                
                <div class="col-6 form-group">
                    <label for="lstTipoProducto">Tipo de producto:</label>
                    <select name="lstTipoProducto" id="lstTipoProducto" class="form-control selectpicker" data-live-search="true" required>
                        <option value="" disabled selected>Seleccionar</option>
                        <?php foreach($aTiposProductos as $tipoProducto): ?>
                            <?php if($producto->fk_idtipoproducto == $tipoProducto->idtipoproducto): ?>
                                <option selected value="<?php echo $tipoProducto->idtipoproducto;?>"><?php echo $tipoProducto->nombre; ?></option>
                            <?php else: ?>
                                <option value="<?php echo $tipoProducto->idtipoproducto;?>"><?php echo $tipoProducto->nombre; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-6 form-group">
                    <label for="numCantidad">Cantidad:</label>
                    <input type="number" required class="form-control" name="numCantidad" id="numCantidad" value="<?php echo $producto->cantidad ?>">
                </div>

                <div class="col-6 form-group">
                    <label for="numPrecio">Precio:</label>
                    <input type="number" required class="form-control" name="numPrecio" id="numPrecio" value="<?php echo $producto->precio ?>">
                </div>

                <div class="col-12 form-group">
                    <label for="txtDescripcion">Descripcion:</label>
                    <textarea type="text" name="txtDescripcion" id="txtDescripcion"><?php echo $producto->descripcion ?></textarea>
                    <script>
                        ClassicEditor
                        .create( document.querySelector ('#txtDescripcion'))
                        .catch( error => {
                            console.error( error );
                        });
                    </script>
                </div>
                
                <div class="col-12 form-group">
                    <label for="imgProducto">Imagen:</label>
                        <input type="file" name="imgProducto" id="imgProducto" accept=".jpg, .jpeg, .png">
                        <small class="d-block">Archivos admitidos: .jpg, .jpeg, .png</small>
                        <small class="d-block">Si está editando el producto, adjuntar imagen solo si desea cambiarla</small>
                        <?php if($producto->imagen != ""): ?>
                            <img src="./img/<?php echo $producto->imagen; ?>" class="img-thumbnail">
                        <?php endif; ?>
                </div>
        </div>

<?php include_once("footer.php"); ?>