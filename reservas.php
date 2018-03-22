<!DOCTYPE html>
<html>
<title>Reservas</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="js/ejercicios.js"></script>
<script type="text/javascript">
var stateObj = { foo: "bar" };
function change_my_url()
{
   history.pushState(stateObj, "page 2", "reservas.php");
}
</script>
<script>
//funcion para hacer la confirmacion de reservas
function ConfirmarReserva(rec_num) {
  var respuesta = confirm("¿Está seguro que desea confirmar la reserva de este recurso?");
    if (respuesta == true) {
      var id="reservar_form_recursos"+rec_num;
      document.getElementById(id).submit();   
    }
}
//funcion para confirmar la liberacion de reservas
function ConfirmarLiberacion(rec_num) {
  var respuesta = confirm("¿Está seguro que desea liberar este recurso?");
    if (respuesta == true) {
      var id="liberar_form_recursos"+rec_num;
      document.getElementById(id).submit();   
    }
}
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}

// When the user clicks anywhere outside of the modal, close it
var modal = document.getElementById('ticketModal');
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script>
//funcion para cambiar el boton de buscar por un input de tipo texto
function showInput(){
  var x = document.getElementById("navBuscar");
  x.innerHTML='<input type="text" size="30" placeholder="Buscar" class="w3-padding-small w3-margin-right w3-bar-item w3-hide-small w3-right" style="margin-top:5px; margin-bottom:5px;" onkeyup="showQuery(this.value)" onblur="showIcon()">';
}
//funcion para cambiar el input de tipo texto a un boton
function showIcon(){
  var x = document.getElementById("navBuscar");
  x.innerHTML='<a href="#" class="w3-padding-large w3-hover-red w3-hide-small w3-bar-item w3-right" onclick="showInput()"><i class="fa fa-search"></i></a>';
}
//funcion para buscar y mostrar los datos cuando hacemos clic en un boton del apartado filtros
function showUser(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","filtros.php?q="+str,true);
  xmlhttp.send();
}
//funcion para buscar y mostrar los datos cuando hacemos una busqueda en la barra de busqueda
function showQuery(str) {
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","query.php?q="+str,true);
  xmlhttp.send();
}
</script>
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
</style>
<?php
session_start();
$modalreserva="hola";
if (isset($_REQUEST['res'])) {
 $modalreserva=$_REQUEST['res'];
}
if (isset($_REQUEST['inc'])) {
 $modalreserva=$_REQUEST['inc'];
}
    $conexion = mysqli_connect ('localhost', 'root', '', 'proyecto2');
    if (!$conexion) {
        echo "Error: No se pudo conectar a MySQL. " . PHP_EOL;
        echo "Errno de depuración: " . mysqli_connect_errno () . PHP_EOL;
        echo "Error de depuración: " . mysqli_connect_error () . PHP_EOL;
        exit;
    }
    if (isset($_REQUEST['recursos'])){
      $sqlrec = "SELECT * FROM recursos WHERE rec_tipo = '".$_REQUEST['recursos']."'";
    }
    else{
      $sqlrec = "SELECT * FROM recursos";
    }

?>
<?php if ($modalreserva=="ok") {
?>
<body class="w3-light-grey w3-content" style="max-width:1920px" onload="showUser('Todo'); document.getElementById('reservasActivas').style.display='block'">
<?php }else if ($modalreserva=="ko") {
?>
<body class="w3-light-grey w3-content" style="max-width:1920px" onload="showUser('Todo'); document.getElementById('incidenciasActivas').style.display='block'">
<?php }else{
?>
<body class="w3-light-grey w3-content" style="max-width:1920px" onload="showUser('Todo')">
<?php } ?>
<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-black w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="reservas.php" class="w3-bar-item w3-button w3-padding-large">INICIO</a>
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){ ?>
    <div class="w3-dropdown-hover w3-hide-small">
      <button class="w3-padding-large w3-button" title="Reservas">RESERVAS <i class="fa fa-caret-down"></i></button>
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
        <a href="#" class="w3-bar-item w3-button" onclick="document.getElementById('reservasActivas').style.display='block'">Reservas activas</a>
        <a href="#" class="w3-bar-item w3-button" onclick="document.getElementById('historialReservas').style.display='block'">Historial de reservas</a>
        <a href="#" class="w3-bar-item w3-button" onclick="document.getElementById('estadisticaReservas').style.display='block'">Estadisticas de uso</a>
      </div>
    </div>
    <div class="w3-dropdown-hover w3-hide-small">
      <button class="w3-padding-large w3-button" title="Incidencias">INCIDENCIAS <i class="fa fa-caret-down"></i></button>
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
        <a href="#resultado" class="w3-bar-item w3-button" <a href="#" class="w3-bar-item w3-button" onclick="document.getElementById('incidenciasActivas').style.display='block'">Incidencias en curso</a>
        <?php if($_SESSION['username']=='stecnico'){ ?>
        <a href="#" class="w3-bar-item w3-button" onclick="document.getElementById('historialIncidencias').style.display='block'">Incidencias resueltas</a>
        <?php } ?>
      </div>
    </div>
    <div class="w3-dropdown-hover w3-hide-small w3-right w3-margin-right">
      <button class="w3-padding-large w3-button" title="Reservas"><?php echo strtoupper($_SESSION['username']); ?>&nbsp&nbsp&nbsp&nbsp<i class="fa fa-power-off fa-fw"></i></button>
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
        <a href="logout.php" class="w3-bar-item w3-button">Cerrar sesión</a>
      </div>
   </div>
   <?php } else{ ?>
   <div class="w3-dropdown-hover w3-hide-small w3-right w3-margin-right">
      <button class="w3-padding-large w3-button" title="Reservas">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-power-off fa-fw"></i></button>
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
        <a href="index.php" class="w3-bar-item w3-button">Iniciar sesión</a>
      </div>
   </div>
   <?php } ?>
    <div id="navBuscar">
      <a href="#" class="w3-padding-large w3-hover-red w3-hide-small w3-bar-item w3-right" onclick="showInput()"><i class="fa fa-search"></i></a>
    </div>
  </div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
  <a href="#band" class="w3-bar-item w3-button w3-padding-large">INICIO</a>
  <a href="#tour" class="w3-bar-item w3-button w3-padding-large">RESERVAS</a>
  <a href="#contact" class="w3-bar-item w3-button w3-padding-large">INCIDENCIAS</a>
</div>
<!-- !PAGE CONTENT! -->

<div class="w3-main" style="margin-left:10%; margin-right:10%;">

  <!-- Header -->
  <header id="portfolio">
    <div class="w3-container w3-margin-top">
    <h1><b>Intranet: Reservas</b></h1>
    <div class="w3-section w3-bottombar w3-padding-16">
      <span class="w3-margin-right">Filtros:</span> 
      <button id="todo" class="w3-button w3-black" onclick="showUser('Todo'), todito()">Todo</button>
      <button id="aulas" class="w3-button w3-white" onclick="showUser('Aulas'), aulas()"><i class="fa fa-book w3-margin-right"></i>Aulas</button>
      <button id="despachos" class="w3-button w3-white w3-hide-small" onclick="showUser('Despachos/Salas'), despachos()"><i class="fa fa-users w3-margin-right"></i>Despachos/Salas</button>
      <button id="material" class="w3-button w3-white w3-hide-small" onclick="showUser('Material de trabajo'), material()"><i class="fa fa-laptop w3-margin-right"></i>Material de trabajo</button>
    </div>
    </div>
  </header>
  
  <!-- First Photo Grid-->
<div id="txtHint"><b>Aqui van los recursos</b></div>

<!-- Cajas modales-->
  <div id="reservasActivas" class="w3-modal">
    <div class="w3-modal-content">
      <header class="w3-container w3-black"> 
        <span onclick="document.getElementById('reservasActivas').style.display='none'; change_my_url()" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Reservas Activas</h2>
      </header>
      <div class="w3-container">
        <?php
          $usuario=$_SESSION['username'];
              $sql = "SELECT `reservas`.*, `recursos`.`rec_estado`, `recursos`.`rec_nombre`
                      FROM `recursos`
                      INNER JOIN `reservas` ON `reservas`.`rec_id` = `recursos`.`rec_id` WHERE `reservas`.`res_fin` = '0000-00-00 00:00:00' AND `recursos`.`rec_estado` = 'Reservado' AND `reservas`.`usu_user` = '$usuario'";
              $reserva = mysqli_query($conexion, $sql);
              echo "<table class='w3-table w3-bordered'>
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
                $nombre = "reservar_form_recursos".$res['rec_id'];
                echo '<tr>
                <td>'.$res['res_id'].'</td>
                <td>'.$res['rec_nombre'].'</td>
                <td>'.date_format($fechaini, 'd-m-y H:i:s').'</td>
                <td>
                  <form id="'.$nombre.'" action="modreservas.proc.php" method="GET" >
                    <input type="hidden" name="usuarios" value="'.$_SESSION['username'].'">
                    <input type="hidden" name="recursos" value="'.$res['rec_id'].'">
                    <input type="hidden" name="reservas" value="'.$res['res_id'].'">
                    <input type="button" class="w3-button w3-light-grey w3-margin-bottom" onclick="ConfirmarReserva('.$res['rec_id'].')" type="submit" name="reserva" value="Liberar">
                  </form>
                </td>
                </tr>';
              }
              echo "</table>";

          ?>

      </div>
      <footer class="w3-container w3-black">
        <p></p>
      </footer>
    </div>
  </div>


<div id="historialReservas" class="w3-modal">
    <div class="w3-modal-content">
      <header class="w3-container w3-black"> 
        <span onclick="document.getElementById('historialReservas').style.display='none'; change_my_url()" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Historial de reservas</h2>
      </header>
      <div class="w3-container">
        <?php
          $usuario=$_SESSION['username'];
              $sql = "SELECT `reservas`.*, `recursos`.`rec_estado`, `recursos`.`rec_nombre`
                      FROM `recursos`
                      INNER JOIN `reservas` ON `reservas`.`rec_id` = `recursos`.`rec_id` WHERE `reservas`.`res_acabada` = 'Si' AND `reservas`.`usu_user` = '$usuario'";
              $reserva = mysqli_query($conexion, $sql);
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

          ?>

      </div>
      <footer class="w3-container w3-black">
        <p></p>
      </footer>
    </div>
  </div>

  <div id="estadisticaReservas" class="w3-modal">
    <div class="w3-modal-content">
      <header class="w3-container w3-black"> 
        <span onclick="document.getElementById('estadisticaReservas').style.display='none'; change_my_url()" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Historial de reservas</h2>
      </header>
      <div class="w3-container">
        <?php
        $diferencia = array();
          $contador=0;
          $sumainterval=0;
          $usuario=$_SESSION['username'];
              $sql = "SELECT `reservas`.*, `recursos`.`rec_estado`, `recursos`.`rec_nombre`
                      FROM `recursos`
                      INNER JOIN `reservas` ON `reservas`.`rec_id` = `recursos`.`rec_id` WHERE `reservas`.`res_acabada` = 'Si'";
              $reserva = mysqli_query($conexion, $sql);
              echo "<table class='w3-table-all w3-hoverable'>
                      <thead>
                        <tr class='w3-light-grey'>
                          <th>Recurso</th>
                          <th>Tiempo total reservado</th>
                        </tr>
                      </thead>";

              while($res = mysqli_fetch_array($reserva)){
                $resnombre = $res['rec_nombre'];
                $sqlres = "SELECT `reservas`.*, `recursos`.`rec_estado`, `recursos`.`rec_nombre`
                FROM `recursos`
                INNER JOIN `reservas` ON `reservas`.`rec_id` = `recursos`.`rec_id` WHERE `reservas`.`res_acabada` = 'Si' AND `recursos`.`rec_nombre` = '$resnombre'";
                $historial = mysqli_query($conexion, $sqlres);
                while ($his = mysqli_fetch_array($historial)) {
                $contador++;
                $fechaini = date_create($res['res_inicio']);//usamos date_create para poder
                $fechafin = date_create($res['res_fin']);
                $diferencia[$contador]= date_diff($fechaini, $fechafin);
                $stringdif=$diferencia[$contador]->format('%y years %m months %d days %h hours %i minutes %s seconds').'<br>';
                //$sumainterval = $sumainterval + $stringdif; 

                


                  
                }
               
              }
               echo '<td>En construccion</td>';
              echo "</table>";

          ?>

      </div>
      <footer class="w3-container w3-black">
        <p></p>
      </footer>
    </div>
  </div>


  <div id="incidenciasActivas" class="w3-modal">
    <div class="w3-modal-content">
      <header class="w3-container w3-black"> 
        <span onclick="document.getElementById('incidenciasActivas').style.display='none'; change_my_url()" class="w3-button w3-display-topright">&times;</span>
        <h2>Incidencias Activas</h2>
      </header>
      <div class="w3-container">
        <?php
              $usuario=$_SESSION['username'];
              if ($_SESSION['username']=='stecnico'){
                $sql="SELECT `incidencias`.*, `recursos`.`rec_nombre` FROM `recursos` INNER JOIN `incidencias` ON `incidencias`.`rec_id` = `recursos`.`rec_id` WHERE `incidencias`.`inc_fin` = 'No'";
              }
              else{
                $sql="SELECT `incidencias`.*, `recursos`.`rec_nombre` FROM `recursos` INNER JOIN `incidencias` ON `incidencias`.`rec_id` = `recursos`.`rec_id` WHERE `incidencias`.`inc_fin` = 'No' AND `incidencias`.`usu_user` = '$usuario'";
              }

              $incidencia = mysqli_query($conexion, $sql);
              echo "<table class='w3-table w3-bordered'>
                      <thead>
                        <tr class='w3-light-grey'>
                          <th>Numero de incidencia</th>
                          <th>Recurso averiado</th>
                          <th>Fecha de incidencia</th>
                          <th>Resolver incidencia</th>
                        </tr>
                      </thead>";

              while($inc = mysqli_fetch_array($incidencia)){
                $fechaini = date_create($inc['inc_fecha_incidencia']);//usamos date_create para poder
                echo '<tr>
                <td>'.$inc['inc_id'].'</td>
                <td>'.$inc['rec_nombre'].'</td>
                <td>'.date_format($fechaini, 'd-m-y H:i:s').'</td>
                <td>';
                    if ($_SESSION['username']=='stecnico') {

                    echo '<form action="modincidencias.proc.php" method="GET" >
                      <input type="hidden" name="usuarios" value="'.$_SESSION['username'].'">
                      <input type="hidden" name="recursos" value="'.$inc['rec_id'].'">
                      <input type="hidden" name="incidencias" value="'.$inc['inc_id'].'">
                      <input class="w3-button w3-light-grey w3-margin-bottom" type="submit" name="incidencia" value="Cerrar incidencia">';
                    }
                 echo'</form>
                </td>
                </tr>';
              }
              echo "</table>";
          ?>

      </div>
      <footer class="w3-container w3-black">
        <p></p>
      </footer>
    </div>
  </div>


<div id="historialIncidencias" class="w3-modal">
    <div class="w3-modal-content">
      <header class="w3-container w3-black"> 
        <span onclick="document.getElementById('historialIncidencias').style.display='none'; change_my_url()" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Historial de incidencias</h2>
      </header>
      <div class="w3-container">
        <?php
          $usuario=$_SESSION['username'];
              $sql="SELECT `incidencias`.*, `recursos`.`rec_nombre` FROM `recursos` INNER JOIN `incidencias` ON `incidencias`.`rec_id` = `recursos`.`rec_id` WHERE `incidencias`.`inc_fin` = 'Si'";
              $incidencia = mysqli_query($conexion, $sql);
              echo "<table class='w3-table-all w3-hoverable'>
                      <thead>
                        <tr class='w3-light-grey'>
                          <th>Numero de incidencia</th>
                          <th>Recurso averiado</th>
                          <th>Fecha de apertura</th>
                          <th>Fecha de cierre</th>
                        </tr>
                      </thead>";

              while($inc = mysqli_fetch_array($incidencia)){
                $fechaini = date_create($inc['inc_fecha_incidencia']);//usamos date_create para poder
                $fechafin = date_create($inc['inc_fecha_solucion']);
                echo '<tr>
                <td>'.$inc['inc_id'].'</td>
                <td>'.$inc['rec_nombre'].'</td>
                <td>'.date_format($fechaini, 'd-m-y H:i:s').'</td>
                <td>'.date_format($fechafin, 'd-m-y H:i:s').'</td>
                </tr>';
              }
              echo "</table>";

          ?>

      </div>
      <footer class="w3-container w3-black">
        <p></p>
      </footer>
    </div>
  </div>
  <!-- Footer -->
  <footer class="w3-container w3-padding-32">
  <div class="w3-black w3-center w3-padding-24">Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-opacity">w3.css</a></div>

<!-- End page content -->
</div>
</footer>
</body>
</html>
