<?php

include_once "config.php";
include_once "entidades/producto.php";
include_once "entidades/tipoproducto.php";

$pg = "Listado de productos";
include_once "header.php"; 

$producto = new Producto();
$aProductos = $producto->obtenerTodos();
?>

<!-- Begin Page Content -->
<div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Listado de productos</h1>
          <div class="row">
                <div class="col-12 mb-3">
                    <a href="producto-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
                </div>
            </div>
          <table class="table table-hover border">
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($aProductos as $producto): ?>
              <tr>
                  <td><img src="./img/<?php echo $producto->imagen != "" ? $producto->imagen : "default.jpg"; ?>" class="img-thumbnail"></td>
                  <td><?php echo $producto->nombre; ?></td>
                  <td><?php echo $producto->cantidad; ?></td>
                  <td><?php echo $producto->precio; ?></td>
                  <td style="width: 110px;">
                      <a href="producto-formulario.php?id=<?php echo $producto->idproducto; ?>"><i class="fas fa-pen-square"></i></a>   
                  </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php include_once("footer.php"); ?>