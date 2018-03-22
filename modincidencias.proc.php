<?php
$conexion = mysqli_connect ('localhost', 'root', '', 'proyecto2');
    if (!$conexion) {
        echo "Error: No se pudo conectar a MySQL. " . PHP_EOL;
        echo "Errno de depuración: " . mysqli_connect_errno () . PHP_EOL;
        echo "Error de depuración: " . mysqli_connect_error () . PHP_EOL;
        exit;
    }

$usuario=$_GET['usuarios'];
$recurso=$_GET['recursos'];
$incidencia=$_GET['incidencias'];
$finreserva="UPDATE `incidencias` SET `inc_fecha_solucion` = CURRENT_TIME(), `inc_fin` = 'Si' WHERE `incidencias`.`inc_id` = $incidencia";
$disponible="UPDATE `recursos` SET `rec_estado` = 'Disponible' WHERE `recursos`.`rec_id` = $recurso";

$updateres=mysqli_query($conexion,$finreserva);
  if (!$updateres){
      echo "Error: " . mysqli_error($conexion) . PHP_EOL;
      echo "</br>Errno: " . mysqli_errno($conexion) . PHP_EOL;
      exit;
    }
$updaterec=mysqli_query($conexion,$disponible);
  if (!$updaterec){
      echo "Error: " . mysqli_error($conexion) . PHP_EOL;
      echo "</br>Errno: " . mysqli_errno($conexion) . PHP_EOL;
      exit;
    }
header("Location: reservas.php?inc=ko");
?>