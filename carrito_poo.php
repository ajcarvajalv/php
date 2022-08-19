<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('America/Bogota');

class Cliente {
    private $dni;
    private $nombre;
    private $correo;
    private $telefono;

    public function __construct()
    {
        $this->descuento = 0.0;
    }

    public function __get($propiedad){
        return $this->$propiedad;
    }

    public function __set($propiedad, $valor){
        $this->$propiedad = $valor;

    }

    public function imprimir(){
        echo "DNI: " . $this->dni . "<br>";
        echo "Nombre: ".$this->nombre . "<br>";
        echo "Correo: ".$this->correo . "<br>";
        echo "Teléfono: ".$this->telefono . "<br><br>";
    }

}

class Producto {
    private $cod;
    private $nombre;
    private $precio;
    private $descripcion;
    private $iva;

    public function __construct()
    {
        $this->precio = 0.0;
        $this->iva = 0.0;
    }

    public function __get($propiedad){
        return $this->$propiedad;
    }

    public function __set($propiedad, $valor){
        $this->$propiedad = $valor;

    }

    public function imprimir(){
        echo "Código: " . $this->cod . "<br>";
        echo "Nombre: " . $this->nombre . "<br>";
        echo "Precio: " . $this->precio . "<br>";
        echo "Descripción: " . $this->descripcion . "<br>";
        echo "IVA: " . $this->iva . "<br><br>";
    }
}

class Carrito{
    private $cliente;
    private $aProductos;
    private $subtotal;
    private $total;

    public function _construct(){
        $this->aProductos=array();
        $this->subtotal=0.0;
        $this->total=0.0;
    }

    public function __get($propiedad){
        return $this->$propiedad;
    }

    public function __set($propiedad, $valor){
        $this->$propiedad = $valor;

    }

    public function cargarProducto($producto){
        $this->aProductos[] = $producto;
    }

    public function imprimirTicket(){
        $this->subtotal = 0;
        $this->total = 0;

        foreach($this->aProductos as $producto){
            $this->subtotal += $producto->precio;
        }

        foreach($this->aProductos as $producto){
            $this->total += $producto->precio * (1+($producto->iva/100));
        }

        echo "<table class='table table-hover border'><tr><th colspan='2' class='text-center'>ECO MARKET</th></tr>";

        echo "<tr><th>Fecha</th><td>" . date("d/m/Y") . "</td></tr>";

        echo "<tr><th>DNI</th><td>" . $this->cliente->dni . "</td></tr>";

        echo "<tr><th>Nombre</th><td>" . $this->cliente->nombre . "</td></tr>";

        echo "<tr><th colspan='2'>Productos:</th></tr>";

        foreach($this->aProductos as $producto):
        echo "<tr><td>" . $producto->nombre . "</td><td>$ " . number_format($producto->precio, 2, ",", ".") . "<tr>";
        endforeach;
        
        echo "<tr><th>Subtotal s/IVA</th><td>$ " . number_format($this->subtotal, 2, ",", ".") . "</td></tr>";

        echo "<tr><th>TOTAL</th><td>$ " . number_format($this->total, 2, ",", ".") . "</td></tr></table>";


    }

}

//Programa
$cliente1 = new Cliente();
$cliente1->dni = "34765456";
$cliente1->nombre = "Bernabé";
$cliente1->correo = "bernabe@gmail.com";
$cliente1->telefono = "+541188598686";
$cliente1->descuento = 0.05;

$producto1 = new Producto();
$producto1->cod = "AB8767";
$producto1->nombre = "Notebook 15\" HP";
$producto1->descripcion = "Esta es una computadora HP";
$producto1->precio = 30800;
$producto1->iva = 21;

$producto2 = new Producto();
$producto2->cod = "QWR579";
$producto2->nombre = "Heladera Whirlpool";
$producto2->descripcion = "Esta es una heladera no froze";
$producto2->precio = 76000;
$producto2->iva = 10.5;


$carrito = new Carrito();
$carrito->cliente = $cliente1;
//print_r($carrito);
$carrito->cargarProducto($producto1);
$carrito->cargarProducto($producto2);
//print_r($carrito);
//echo $carrito->aProductos[0]->nombre;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECO MARKET</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row mt-5">
            <div class="col-12 col-sm-5">
                <?php $carrito->imprimirTicket(); ?>
            </div>
        </div>
    </main>    
</body>
</html>

