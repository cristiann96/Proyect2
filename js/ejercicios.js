var todito=function() {
  document.getElementById('todo').className="w3-button w3-black";
  document.getElementById('aulas').className="w3-button w3-white";
  document.getElementById('despachos').className="w3-button w3-white";
  document.getElementById('material').className="w3-button w3-white";
}
var aulas=function() {
  document.getElementById('todo').className="w3-button w3-white";
  document.getElementById('aulas').className="w3-button w3-black";
  document.getElementById('despachos').className="w3-button w3-white";
  document.getElementById('material').className="w3-button w3-white";
}
var despachos=function() {
  document.getElementById('todo').className="w3-button w3-white";
  document.getElementById('aulas').className="w3-button w3-white";
  document.getElementById('despachos').className="w3-button w3-black";
  document.getElementById('material').className="w3-button w3-white";
}
var material=function() {
  document.getElementById('todo').className="w3-button w3-white";
  document.getElementById('aulas').className="w3-button w3-white";
  document.getElementById('despachos').className="w3-button w3-white";
  document.getElementById('material').className="w3-button w3-black";
}
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
  xmlhttp.open("GET","tiltmaximo2.php?q="+str,true);
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