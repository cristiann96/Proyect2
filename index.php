<?php
session_start();
if (isset($_SESSION ['username'])) {
	header("location: reservas.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bienvenido!</title>
<script type="text/javascript" src="js/funciones.js"></script>
<style>

	div.central {
		text-align: center;
		padding-top: 10px;
		padding-bottom: 10px;
		border: 2px solid black;
		width: 420px;
		height: 50%;
		margin-left: auto;
		margin-right: auto;

	}
	
	h2 {
		text-align: center;
	}

	.ejercicio{
	background-color: lightgray;
	display: inline-block;
	margin: 5px 5px;
	padding: 15px 15px;
	width:20%;
	height:100px;
	position: relative;
	border-radius:10px;
	box-shadow:10px 10px 5px #888888;
	/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#1e5799+0,2989d8+50,207cca+51,7db9e8+100;Blue+Gloss+Default */
	background: #1e5799; /* Old browsers */
	background: -moz-linear-gradient(top,  #1e5799 0%, #2989d8 50%, #207cca 51%, #7db9e8 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#1e5799), color-stop(50%,#2989d8), color-stop(51%,#207cca), color-stop(100%,#7db9e8)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  #1e5799 0%,#2989d8 50%,#207cca 51%,#7db9e8 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  #1e5799 0%,#2989d8 50%,#207cca 51%,#7db9e8 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  #1e5799 0%,#2989d8 50%,#207cca 51%,#7db9e8 100%); /* IE10+ */
	background: linear-gradient(to bottom,  #1e5799 0%,#2989d8 50%,#207cca 51%,#7db9e8 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e5799', endColorstr='#7db9e8',GradientType=0 ); /* IE6-9 */
	}
	.modalmask {
	position: fixed;
	font-family: Arial, sans-serif;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	background: rgba(0,0,0,0.8);
	z-index: 99999;
	opacity:0;
	-webkit-transition: opacity 400ms ease-in;
	-moz-transition: opacity 400ms ease-in;
	transition: opacity 400ms ease-in;
	pointer-events: none;
	}
	.modalmask:target {
		opacity:1;
		pointer-events: auto;
	}
	.modalbox{
		width: 500px;
		height: 310px;
		position: relative;
		padding: 5px 20px 13px 20px;
		background: #fff;
		border-radius:3px;
		-webkit-transition: all 500ms ease-in;
		-moz-transition: all 500ms ease-in;
		transition: all 500ms ease-in;

	}

	.movedown {
		margin: 0 auto;
	}
	.rotate {
		margin: 10% auto;
		-webkit-transform: scale(-5,-5);
		transform: scale(-5,-5);
	}
	.resize {
		margin: 10% auto;
		width:0;
		height:0;

	}
	.modalmask:target .movedown{
		margin:10% auto;
	}
	.modalmask:target .rotate{
		transform: rotate(360deg) scale(1,1);
	    -webkit-transform: rotate(360deg) scale(1,1);
	}

	.modalmask:target .resize{
		width: 500px;
		height: 310px;
		/*overflow-y: scroll;*/
	}



	.close {
		background: #606061;
		color: #FFFFFF;
		line-height: 25px;
		position: absolute;
		right: 1px;
		text-align: center;
		top: 1px;
		width: 24px;
		text-decoration: none;
		font-weight: bold;
		border-radius:3px;
		font-size:16px;
	}

	.close:hover {
		background: #FAAC58;
		color:#222;
	}

	div.error {
		color: red;
	}

</style>
</head>
<body>
	<div class="central">
		BIENVENIDO A LA INTRANET! <br /><br />
		<section>
			<article>
				<a href="#resultado" onclick="funcion1()"><input type="button" name="Login" value="Login"></a>
				<a href="reservas.php" onclick="funcion1()"><input type="button" name="Consultadisp" value="Consultar disponibilidad"></a>
			</article>
		</section>
	</div>
	<div id="resultado" class="modalmask">
		<div class="modalbox movedown" id="resultadoContent">
			<a href="#close" title="Close" class="close">X</a>
			<form name="formlogin" action="checklogin.php" method="POST">
				<h2 id="tituloResultado">LOGIN</h2>
				<div class="central" id="contenidoResultado">
					
					<b>Usuario</b><br />
					<div class="error">
					<?php
						if(isset($_REQUEST['erroruser'])){
							echo "<b>".$_REQUEST['erroruser'] ."</b><br/>";
						}
						if(isset($_REQUEST['nom_user'])){
							$nombre_user = $_REQUEST['nom_user'];
						} else {
							$nombre_user="";
						}
					?>
					</div>

					<input type="text" name="usuario" placeholder="Introduce nombre de usuario" required="" value="<?php echo $nombre_user; ?>" /><br /><br />				
					<b>Contraseña</b><br />
					<div class="error">
					<?php
						if(isset($_REQUEST['errorpasswd'])){
							echo "<b>".$_REQUEST['errorpasswd'] ."</b><br/>";
						}
					?>
					</div>
					<input type="password" placeholder="Introduce la contraseña" name="pwd" required="" value="" /> <br /><br />
					<input type="submit" value="ACCEDER">
				</div>
			</form>
		</div>
	</div>
</body>
</html>