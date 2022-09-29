<?php
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');

$conn = mysqli_connect("localhost", "root", "", "urpc's");

if (!$conn) {
	die("No hay conexión: " . mysqli_connect_error());
}

session_start();

if (isset($_POST['emailLoginField']) && isset($_POST['passLoginField'])) {
	function validar($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);

		return $data;
	}
}

$email = validar($_POST['emailLoginField']);
$pass = validar($_POST['passLoginField']);

if (empty($email)) {
	echo "Ingresa tu correo electrónico";
	exit();
} else if (empty($pass)) {
	echo "Ingresa tu contraseña";
	exit();
} else {
	$sql = "SELECT *  FROM `usuarios` WHERE `Correo` = '$email' AND `Contraseña` = '$pass'";
	$rs = mysqli_query($conn, $sql);

	if (mysqli_num_rows($rs) === 1) {
		$fila = mysqli_fetch_assoc($rs);

		if ($fila['Correo'] === $email && $fila['Contraseña'] === $pass) {
			$nombre = $fila['Nombre'];
			echo nl2br("Inicio de Sesión Exitoso.\n Bienvenido, " . $nombre . ".");

			$_SESSION['Nombre'] = $fila['Nombre'];
			$_SESSION['Correo'] = $fila['Correo'];
			$_SESSION['ID'] = $fila['ID'];

			header("Location: choices.php");
			exit();
		}
	} else if (mysqli_num_rows($rs) === 0) {
		echo "Email o Contraseña Incorrectos.";
		exit();
	} else {
		echo "Esta cuenta está registrada más de una vez.";
		exit();
	}
}
 
?>