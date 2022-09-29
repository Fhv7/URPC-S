<?php
// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');

$conn = mysqli_connect("localhost", "root", "","urpc's");

if (!$conn) {
	die("No hay conexión: ".mysqli_connect_error());
}

// get the post records
$name = $_POST['nameRegField'];
$email = $_POST['emailRegField'];
$pass = $_POST['passRegField'];

// database insert SQL code
$sql = "INSERT INTO `usuarios` (`ID`, `Correo`, `Nombre`, `Contraseña`) VALUES (NULL, '$email', '$name', '$pass');";

// insert in database 
$rs = mysqli_query($conn, $sql);

if($rs)
{
	echo "Registro Exitoso";
}

?>