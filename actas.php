<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//Definicion

function promediar($aNumeros)
{

    $sumaTotal = 0;

    foreach ($aNumeros as $nota) {
        $sumaTotal = $sumaTotal + $nota;
    }

    $promedio = $sumaTotal / count($aNumeros);

    return $promedio;
}

$aAlumnos = array();
$aAlumnos[] = array("nombre" => "Ana Valle", "notas" => array(7, 8));
$aAlumnos[] = array("nombre" => "Bernabé Paz", "notas" => array(5, 7));
$aAlumnos[] = array("nombre" => "Sebastián Aguirre", "notas" => array(6, 9));
$aAlumnos[] = array("nombre" => "Mónica Ledesma", "notas" => array(8, 9));


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actas</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>

    <main class="container">
        <div class="row">
            <div class="col-12 text-center py-4">
                <h1>Actas</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-hover border">
                    <thead>
                        <th>Alumno</th>
                        <th>Nota 1</th>
                        <th>Nota 2</th>
                        <th>Promedio</th>
                    </thead>
                    <tbody>
                    <?php foreach ($aAlumnos as $alumno) : ?>
                        <tr>                            
                                <td><?php echo $alumno["nombre"]; ?></td>
                                <td><?php echo $alumno["notas"][0]; ?></td>
                                <td><?php echo $alumno["notas"][1]; ?></td>
                                <td><?php echo number_format(promediar($alumno["notas"]), 1, ",", "."); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-12">Promedio de la cursada:
                        <?php $aNotas = array();

                        foreach ($aAlumnos as $alumno) :
                        $aNotas[] = $alumno["notas"][0];
                        $aNotas[] = $alumno["notas"][1];
                        endforeach;

                        echo number_format(promediar($aNotas), 1, ",", ".");

                        ?></div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>