<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
session_start();
$tipo = $_GET['tipo'];
$conexion = mysqli_connect ('localhost', 'root', '', 'proyecto2');
    if (!$conexion) {
        echo "Error: No se pudo conectar a MySQL. " . PHP_EOL;
        echo "Errno de depuración: " . mysqli_connect_errno () . PHP_EOL;
        echo "Error de depuración: " . mysqli_connect_error () . PHP_EOL;
        exit;
    }
$usuario=$_SESSION['username'];
if ($tipo=="Activas"){
  $sql = "SELECT `reservas`.*, `recursos`.`rec_estado`, `recursos`.`rec_nombre`
              FROM `recursos`
              INNER JOIN `reservas` ON `reservas`.`rec_id` = `recursos`.`rec_id` WHERE `reservas`.`res_fin` = '0000-00-00 00:00:00' AND `recursos`.`rec_estado` = 'Reservado' AND `reservas`.`usu_user` = '$usuario'";
  $reserva = mysqli_query($conexion, $sql);
  if(mysqli_num_rows($reserva)>0){
      echo "<table class='w3-table-all w3-hoverable'>
      <thead>
      <tr class='w3-light-grey'>
      <th>Numero de reserva</th>
      <th>Recurso reservado</th>
      <th>Fecha de reserva</th>
      <th>Cerrar Reserva</th>
      </tr>
      </thead>";
    while($res = mysqli_fetch_array($reserva)){
      $fechaini = date_create($res['res_inicio']);//usamos date_create para poder
      echo '<tr>
        <td>'.$res['res_id'].'</td>
        <td>'.$res['rec_nombre'].'</td>
        <td>'.date_format($fechaini, 'd-m-y H:i:s').'</td>
        <td>
        <form id="formulario" action="modreservas.proc.php" method="GET" >
          <input type="hidden" id="usuarios" name="usuarios" value="'.$_SESSION['username'].'">
          <input type="hidden" id="recursos" name="recursos" value="'.$res['rec_id'].'">
          <input type="hidden" id="reservas" name="reservas" value="'.$res['res_id'].'">
          <input class="w3-button w3-light-grey w3-margin-bottom" type="submit" name="reserva" value="Liberar">
        </form>
        </td>
      </tr>';
    }
    echo "</table>";
  }
}
if ($tipo=="Cerradas"){
  $sql = "SELECT `reservas`.*, `recursos`.`rec_estado`, `recursos`.`rec_nombre`
              FROM `recursos`
              INNER JOIN `reservas` ON `reservas`.`rec_id` = `recursos`.`rec_id` WHERE `reservas`.`res_acabada` = 'Si' AND `reservas`.`usu_user` = '$usuario'";
  $reserva = mysqli_query($conexion, $sql);
  if(mysqli_num_rows($reserva)>0){
      echo "<table class='w3-table-all w3-hoverable'>
      <thead>
      <tr class='w3-light-grey'>
      <th>Numero de reserva</th>
      <th>Recurso reservado</th>
      <th>Fecha de reserva</th>
      <th>Fecha de cierre</th>
      </tr>
      </thead>";
    while($res = mysqli_fetch_array($reserva)){
      $fechaini = date_create($res['res_inicio']);//usamos date_create para poder
      $fechafin = date_create($res['res_fin']);
      echo '<tr>
        <td>'.$res['res_id'].'</td>
        <td>'.$res['rec_nombre'].'</td>
        <td>'.date_format($fechaini, 'd-m-y H:i:s').'</td>
        <td>'.date_format($fechafin, 'd-m-y H:i:s').'</td>
      </tr>';
    }
    echo "</table>";
  }
}
if (isset($_GET['recursos'])) {
  $usuario=$_GET['usuarios'];
  $recurso=$_GET['recursos'];
  $reserva=$_GET['reservas'];
  $finreserva="UPDATE `reservas` SET `res_fin` = CURRENT_TIME() WHERE `reservas`.`res_id` = $reserva";
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
}

          ?>
</body>
</html>