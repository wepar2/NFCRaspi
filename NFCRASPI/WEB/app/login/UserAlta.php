<?php
if($_SERVER['REQUEST_METHOD']=='POST'){

	include 'dbconfig.php';
	 
	$con = mysqli_connect($servername, $username, $password, $dbname);

	$nombre = $_POST['Nombre_pa'];
	$apellido = $_POST['Apellido_pa'];
	$usuario = $_POST['Usuario_pa'];
	$email = $_POST['email_pa'];
	$password_pa = $_POST['password_pa'];
	$telefono = $_POST['telefono_pa'];
	$direccion = $_POST['direccion_pa']

	//$passwordMD = md5($password_pa);

	//$admin = 1;

	//$fechaRegistro = date('m/d/Y g:ia');

	$CheckSQL = "SELECT * FROM administradores WHERE email='$email'";
	 
	$check = mysqli_fetch_array(mysqli_query($con,$CheckSQL));
	 
	if(isset($check)){

	 	echo 'El Email ya existe';

	}
	else{ 

		$Sql_Query = "INSERT INTO administradores (nombre, apellido, email, usuario, pass, telefono, direccion) values ('$nombre','$apellido','$email',$usuario','$password_pa','$telefono','$direccion')";

		if(mysqli_query($con,$Sql_Query)){
			
		 	echo 'Registro Correcto';
		}
		else
		{
		 	echo 'Algo salió mal-SALE POR AQUI';
		}
	}
}
	
	mysqli_close($con);
?>