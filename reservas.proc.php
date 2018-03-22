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
$sql="INSERT INTO `reservas` (`usu_user`,`rec_id`)
	VALUES ('$usuario','$recurso')";
$modificacion="UPDATE `recursos` SET `rec_estado` = 'Reservado' WHERE `recursos`.`rec_id` = $recurso";
echo $sql;
echo "<br>";
$insert=mysqli_query($conexion,$sql);
  if (!$insert){
      echo "Error: " . mysqli_error($conexion) . PHP_EOL;
      echo "</br>Errno: " . mysqli_errno($conexion) . PHP_EOL;
      exit;
    }
$update=mysqli_query($conexion,$modificacion);
  if (!$insert){
      echo "Error: " . mysqli_error($conexion) . PHP_EOL;
      echo "</br>Errno: " . mysqli_errno($conexion) . PHP_EOL;
      exit;
    }
echo $_GET['reserva'];
header("Location: reservas.php")
?>