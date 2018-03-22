<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
session_start();
$q = $_GET['q'];
$conexion = mysqli_connect ('localhost', 'root', '', 'proyecto2');
    if (!$conexion) {
        echo "Error: No se pudo conectar a MySQL. " . PHP_EOL;
        echo "Errno de depuración: " . mysqli_connect_errno () . PHP_EOL;
        echo "Error de depuración: " . mysqli_connect_error () . PHP_EOL;
        exit;
    }
    if ($q == "Todo"){
        $sql="SELECT * FROM recursos";
    }elseif(($q == "Averiado") || ($q == "Disponible") || ($q == "Reservado")) {
        $sql="SELECT * FROM recursos WHERE rec_estado = '".$q."'";
    }else{
        $sql="SELECT * FROM recursos WHERE rec_tipo = '".$q."'";
    }
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
         echo '<div style="height:50px; margin-bottom: 5px;">';
        if ($row['rec_estado']=='Reservado') {

            $queryreservadopor="SELECT usu_user FROM reservas WHERE res_fin = '0000-00-00 00:00:00' AND rec_id = '".$row['rec_id']."'";
            // echo $queryreservadopor;
            $reservadopor = mysqli_query($conexion,$queryreservadopor);
            if (mysqli_num_rows($reservadopor)>0) {

                while ($registro=mysqli_fetch_array($reservadopor)) {
                    echo '<b><br />Reservado por: </b>'.$registro['usu_user'].' <br />';
              }
              
            }

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
            $nombre = "reservar_form_recursos".$row['rec_id'];
            echo '<form id="'.$nombre.'" action="reservas.proc.php" method="GET" >
            <input type="hidden" name="usuarios" value="'.$_SESSION['username'].'">
            <input type="hidden" name="recursos" value="'.$row['rec_id'].'">
            <input type="button" class="w3-button w3-light-grey w3-margin-bottom" onclick="ConfirmarReserva('.$row['rec_id'].')" name="reserva" value="Reservar">
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