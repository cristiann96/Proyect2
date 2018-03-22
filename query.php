<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
session_start();
$q = $_GET['q'];
$_SESSION['usuario'] = "cfernandez";
$conexion = mysqli_connect ('localhost', 'root', '', 'proyecto2');
    if (!$conexion) {
        echo "Error: No se pudo conectar a MySQL. " . PHP_EOL;
        echo "Errno de depuración: " . mysqli_connect_errno () . PHP_EOL;
        echo "Error de depuración: " . mysqli_connect_error () . PHP_EOL;
        exit;
      }
        $sql="SELECT * FROM recursos WHERE rec_nombre LIKE '%".$q."%'";
$result = mysqli_query($conexion,$sql);
$cont=0;
do { echo '<div class="w3-row-padding">';
    while($row = mysqli_fetch_array($result)) {
         echo '
    <div class="w3-third w3-container w3-margin-bottom">
      <img src="img/'.$row['resc_foto'].'" alt="'.$row['rec_nombre'].'" style="width:100%" class="w3-hover-opacity">
      <div class="w3-container w3-white">
        <p><b>'.$row['rec_nombre'].'</b></p>
        <div style="height:70px;">
        <p><b>Descripcion: </b>'.$row['rec_desc'].'</p>
        <p><b>Estado: </b><i class="fa fa-circle fa-fw"';
        if ($row['rec_estado']=='Reservado') {
           echo 'style="color:red"';
        } 
        if ($row['rec_estado']=='Disponible') {
           echo 'style="color:green"';
        } 
        if ($row['rec_estado']=='Averiado') {
           echo 'style="color:orange"';
        } 
        echo '></i>'.$row['rec_estado'].'</p>
        </div>';
        echo '<div style="height:30px; margin-bottom: 5px;">';
        if ($row['rec_estado']=='Reservado') {
           echo 'Reservado por: Piter <br />';
        } 
        echo '</div>';
        if (isset($_SESSION['username'])) {
          if($row['rec_estado']=="Reservado" OR $row['rec_estado']=="Averiado"){
            echo "<button class='w3-btn w3-grey w3-disabled w3-margin-bottom'>Reservar</button>";
            echo '<div class="w3-right"><button class="w3-button" type="submit"><i class="fa fa-exclamation-triangle fa-fw"></i></button></div>';
          }
          else{
           echo '
            <form action="incidencia.proc.php" method="GET" >
            <input type="hidden" name="usuarios" value="'.$_SESSION['username'].'">
            <input type="hidden" name="recursos" value="'.$row['rec_id'].'">
            <div class="w3-right"><button class="w3-button" type="submit"><i class="fa fa-exclamation-triangle fa-fw"></i></button></div>
          </form>';
            echo '<form action="reservas.proc.php" method="GET" >
            <input type="hidden" name="usuarios" value="'.$_SESSION['username'].'">
            <input type="hidden" name="recursos" value="'.$row['rec_id'].'">
            <input class="w3-button w3-light-grey w3-margin-bottom" type="submit" name="reserva" value="Reservar">
          </form>';
          }
        }

     echo '</div>  
    </div>';
        $cont++;
    } echo "</div>";
}while(($cont%3!=0)&&(mysqli_num_rows($result)!=$cont)); 

mysqli_close($conexion);
?>
</body>
</html>