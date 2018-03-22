<?php
	//Guardamos en la variable $usuario el nombre de usuario que ha introducido el usuario en index.php
	$usuario = $_POST['username'];
	//Guardamos en la variable $passwd la contraseña de usuario que ha introducido el usuario en index.php
	$passwd = $_POST['pwd'];

	//nos conectamos a la base de datos y guardamos el enlace de conexión en $conexion
	$conexion=mysqli_connect("localhost", "root", "", "proyecto2");
	$acentos = mysqli_query($conexion, "SET NAMES 'utf8'");
	//miramos si la conexión se ha realizado correctamente
	//si no es correcta, mostrar error
	if(!$conexion){
	    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
	    echo "Error de depuración: " . mysqli_connect_errno() . PHP_EOL;
	    echo "Error de depuración: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	//si es correcta, seguimos trabajando
	} else {

		//Primero hacemos una query para saber si el usuario que nos han introducido existe, si existe realizaremos la comprobación de que la contraseña sea la correcta, sino le indicaremos error ya que el usuario esta mal introducido o no existe

		$queryuser = "SELECT usu_user FROM usuarios WHERE usu_user='$usuario'";
		$resultadouser=mysqli_query($conexion, $queryuser);
		//si la consulta devuelve más de 0 registros, es que el usuario existe, por lo tanto, procederemos a hacer la comprobación de la contraseña
		if(mysqli_num_rows($resultadouser)>0){
			
			//Hacemos una consulta del usuario y contraseña como filtros para acabar de comprobar que todo esta bien
			$queryusrpaswdd = "SELECT usu_user,usu_pwd FROM usuarios WHERE usu_user='$usuario' AND usu_pwd='$passwd'";
						
			$login=mysqli_query($conexion, $queryusrpaswdd);
			//Si la consulta devuelve más de 0 registros, es que el usuario existe, por lo tanto, iremos a la página principal de la intranet
			if(mysqli_num_rows($login)>0){
				header("location: reservas.php");
			} else {
				//Si cuando hace la consulta no muestra más de 0 resultados significa que el usuario que a introducido mal la contraseña
				header("location: index.php?errorpasswd=Contraseña incorrecta&nom_user=$usuario#resultado");
			}
		} else {
			//Usuario no existe, reedirecionamos al usuario a la página principal
			// header("location: index.php#resultado");
			header("location: index.php?erroruser=El usuario no existe o esta mal introducido#resultado");
		}
	}	
?>
