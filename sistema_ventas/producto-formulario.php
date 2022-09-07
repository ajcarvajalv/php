<?php
$pg = "Listado de productos";
include_once "config.php";
include_once "entidades/producto.php";
include_once "entidades/tipoproducto.php";
include_once "header.php";

$tipoProducto = new TipoProducto();
$aTiposProductos = $tipoProducto->obtenertodos();

?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Producto</h1>

        <div class="row">
                <div class="col-12 mb-3">
                    <a href="tipoproducto-listado.php" class="btn btn-primary mr-2">Listado</a>
                    <a href="tipoproducto-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
                    <button type="submit" class="btn btn-success mr-2" id="btnGuardar" name="btnGuardar">Guardar</button>
                    <button type="submit" class="btn btn-danger" id="btnBorrar" name="btnBorrar">Borrar</button>
                </div>
        </div>

        <div class="row">
                <div class="col-6 form-group">
                    <label for="txtNombre">Nombre:</label>
                    <!-- <input type="text" required class="form-control" name="txtNombre" id="txtNombre" value=" <?php echo $producto->nombre ?>"-->
                    <input type="text" required class="form-control" name="txtNombre" id="txtNombre">
                </div>
                <div class="col-6 form-group">
                    <label for="lstTipoProducto">Tipo de producto:</label>
                    <select class="form-control"  name="lstTipoProducto" id="lstTipoProducto">
                        <?php foreach($aTiposProductos as $tipoProducto): ?>
                            <option value="<?php echo $tipoProducto->nombre; ?>"><?php echo $tipoProducto->nombre; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-6 form-group">
                    <label for="numCantidad">Cantidad:</label>
                    <input type="number" required class="form-control" name="numCantidad" id="numCantidad">
                </div>
                <div class="col-6 form-group">
                    <label for="numPrecio">Precio:</label>
                    <input type="number" required class="form-control" name="numPrecio" id="numPrecio" value="0">
                </div>

                <div class="col-12 form-group">
                    <label for="numPrecio">Descripcion:</label>
                    <textarea type="text" name="txtDescripcion" id="txtDescripcion"></textarea>
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
                </div>


<?php include_once("footer.php"); ?>