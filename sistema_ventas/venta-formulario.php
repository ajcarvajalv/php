<?php

include_once "config.php";
include_once "entidades/cliente.php";
include_once "entidades/producto.php";
include_once "entidades/venta.php";
$pg = "Edición de venta";
include_once "header.php";

$venta = new Venta();

if ($_POST) {
    if (isset($_POST["btnGuardar"])) {
        $venta->cargarFormulario($_REQUEST);

        if (isset($_GET["id"]) && $_GET["id"] > 0) {
            $venta->actualizar();
            $msg["texto"] = "Actualizado correctamente";
            $msg["codigo"] = "alert-success";
        } else {
            $venta->insertar();
            $msg["texto"] = "Insertado correctamente";
            $msg["codigo"] = "alert-success";
        }

    } else if (isset($_POST["btnBorrar"])) {
        $venta->cargarFormulario($_REQUEST);
        $venta->eliminar();
        header('Location: venta-listado.php');
        exit;
    }
}


if (isset($_GET["id"]) && $_GET["id"] > 0){
    $venta->cargarFormulario($_REQUEST);
    $venta->obtenerPorId();
}

$producto = new Producto();
$aProductos = $producto->obtenerTodos();

$cliente = new Cliente();
$aClientes = $cliente->obtenerTodos();

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Venta</h1>
  <div class="row">
      <div class="col-12 mb-3">
          <a href="venta-listado.php" class="btn btn-primary mr-2">Listado</a>
          <a href="venta-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
          <button type="submit" class="btn btn-success mr-2" id="btnGuardar" name="btnGuardar">Guardar</button>
          <button type="submit" class="btn btn-danger" id="btnBorrar" name="btnBorrar">Borrar</button>
      </div>
  </div>
  <div class="row">
      <div class="col-12 form-group">

          <?php if (isset($msg)): ?>
                <div class="row">
                    <div class="col-12">
                        <div class="alert <?php echo $msg["codigo"]; ?>" role="alert">
                            <?php echo $msg["texto"]; ?>
                        </div>
                    </div>
                </div>
          <?php endif;?>

          <label for="txtFechaVenta">Fecha y hora:</label>
          <select class="form-control d-inline"  name="lstDiaVenta" id="lstDiaVenta" style="width: 80px">
                    <option selected="" disabled="">DD</option>
                    <?php for($i=1; $i <= 31; $i++): ?>
                        <?php if(date("d") == $i): ?>
                        <option selected value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php else: ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endif; ?>
                    <?php endfor; ?>
          </select>

          <select class="form-control d-inline"  name="lstMesVenta" id="lstMesVenta" style="width: 80px">
                        <option selected="" disabled="">MM</option>
                        <?php for($i=1; $i <= 12; $i++): ?>
                        <?php if(date("m") == $i): ?>
                        <option selected value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php else: ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endif; ?>
                    <?php endfor; ?>
          </select>

          <select class="form-control d-inline"  name="lstAnioVenta" id="lstAnioVenta" style="width: 100px">
                        <option selected="" disabled="">YYYY</option>
                        <?php for($i=2000; $i <= date("Y"); $i++): ?>
                            <?php if(date("Y") == $i): ?>
                                <option selected value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php else: ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endif; ?>
                        <?php endfor; ?>
          </select>

          <input type="time" class="form-control d-inline"  name="txtHora" id="txtHora" style="width: 150px" value="<?php echo date("H:i"); ?>" step="60">
      </div>
      <div class="col-6 form-group">
          <label for="lstCliente">Cliente:</label>
          <select name="lstCliente" required class="form-control selectpicker">
            <option value="" disabled selected>Seleccionar</option>
            <?php foreach($aClientes as $cliente): ?>
                <?php if($cliente->idcliente == $venta->fk_idcliente): ?>
                        <option selected value="<?php echo $cliente->idcliente;?>"><?php echo $cliente->nombre; ?></option>
                <?php else: ?>
                        <option value="<?php echo $cliente->idcliente;?>"><?php echo $cliente->nombre; ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
          </select>
      </div>
      <div class="col-6 form-group">
          <label for="lstProducto">Producto:</label>
          <select name="lstProducto" required class="form-control selectpicker">
          <option value="" disabled selected>Seleccionar</option>
            <?php foreach($aProductos as $producto): ?>
                <?php if($producto->idproducto == $venta->fk_idproducto): ?>
                        <option selected value="<?php echo $producto->idproducto;?>"><?php echo $producto->nombre; ?></option>
                <?php else: ?>
                        <option value="<?php echo $producto->idproducto;?>"><?php echo $producto->nombre; ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
          </select>
      </div>
      <div class="col-6 form-group">
          <label for="numPrecio">Precio:</label>
          <input type="number" class="form-control" name="numPrecio" id="numPrecio" value="" required>
      </div>
      <div class="col-6 form-group">
          <label for="numCantidad">Cantidad:</label>
          <input type="number" class="form-control" name="numCantidad" id="numCantidad" value="" required>
      </div>
      <div class="col-6 form-group">
          <label for="numTotal">Total:</label>
          <input type="number" class="form-control" name="numTotal" id="numTotal" value="" required>
      </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include_once "footer.php";?>