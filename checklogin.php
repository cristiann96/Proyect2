<?php
session_start();

$conexion = mysqli_connect ('localhost', 'root', '', 'proyecto2');
    if (!$conexion) {
        echo "Error: No se pudo conectar a MySQL. " . PHP_EOL;
        echo "Errno de depuración: " . mysqli_connect_errno () . PHP_EOL;
        echo "Error de depuración: " . mysqli_connect_error () . PHP_EOL;
        exit;
    }
$usuario=$_POST['usuario'];
$password=$_POST['pwd'];
$sql="SELECT * FROM usuarios WHERE usu_user = '$usuario'";
$result=mysqli_query($conexion, $sql);
$filas=mysqli_num_rows($result);
if (mysqli_num_rows($result)>0) {
	$row=mysqli_fetch_array($result);
	if ($row['usu_pwd']==$password) {
		$_SESSION ['loggedin']=true;
		$_SESSION ['username']=$usuario;
		$_SESSION ['start']=time();
		$_SESSION ['expire']=$_SESSION ['start']+(500*60);
		echo "Bienvenido ".$_SESSION ['username'];
		header("location: reservas.php");
	}else{
		header("location: index.php?errorpasswd=Contraseña incorrecta&nom_user=$usuario#resultado");
	}

}else{
	header("location: index.php?erroruser=El usuario no existe o esta mal introducido#resultado");
}
mysqli_close($conexion);
?>