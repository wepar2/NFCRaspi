<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){

		include 'dbconfig.php';
		 
		$con = mysqli_connect($servername, $username, $password, $dbname);
		 
		$email = $_POST['email'];
		$password = $_POST['password'];
		 
		$passwordMD = md5($password);

		$Sql_Query = "select * from administradores where email = '$email' and pass = '$passwordMD' ";
		 
		$check = mysqli_fetch_array(mysqli_query($con,$Sql_Query));
		 
		if(isset($check)){
		 
			echo "Datos Encontrados";
		}
		else{
			echo "Nombre de usuario o contraseña inválido. Por favor intente de nuevo";
		}
	 
	}else{
		echo "Revisar otra vez";
	}


	mysqli_close($con);

?>