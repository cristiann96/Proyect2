<?php
$conexion = mysqli_connect ('localhost', 'root', '', 'proyecto2');
    if (!$conexion) {
        echo "Error: No se pudo conectar a MySQL. " . PHP_EOL;
        echo "Error de depuración: " . mysqli_connect_error () . PHP_EOL;
        echo "Error de depuración: " . mysqli_connect_error () . PHP_EOL;
        exit;
    }

$usuario=$_GET['usuarios'];
$recurso=$_GET['recursos'];
$sql="INSERT INTO `incidencias` (`usu_user`,`rec_id`)
	VALUES ('$usuario','$recurso')";
$modificacion="UPDATE `recursos` SET `rec_estado` = 'Averiado' WHERE `recursos`.`rec_id` = $recurso";
echo $sql;
echo "<br>";
$insert=mysqli_query($conexion,$sql);
  if (!$insert){
      echo "Error: " . mysqli_error($conexion) . PHP_EOL;
      echo "</br>Error: " . mysqli_error($conexion) . PHP_EOL;
      exit;
    }
$update=mysqli_query($conexion,$modificacion);
  if (!$insert){
      echo "Error: " . mysqli_error($conexion) . PHP_EOL;
      echo "</br>Error: " . mysqli_error($conexion) . PHP_EOL;
      exit;
    }
echo $_GET['incidencia'];
header("Location: reservas.php")
?>