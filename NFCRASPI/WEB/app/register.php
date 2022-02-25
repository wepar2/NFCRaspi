<?php
$response = array();
include 'db/db_connect.php';
include 'functions.php';
 
//Get the input request parameters
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); //convert JSON into array
 
//Check for Mandatory parameters
if(isset($input['username']) && isset($input['password']) && isset($input['full_name']) && isset($input['email'])){
	$username = $input['username'];
	$password = $input['password'];
	$fullName = $input['full_name'];
	$email    = $input['email'];
	
	//Check if user already exist
	if(!userExists($username)){
		
		//Generate a unique password Hash
		$passwordmd5 = md5($password);
		
		//Query to register new user
		$insertQuery  = "INSERT INTO member(username, full_name, email, password_hash) VALUES (?,?,?,?)";
		if($stmt = $con->prepare($insertQuery)){
			$stmt->bind_param("ssss",$username,$fullName,$email,$passwordmd5);
			$stmt->execute();
			$response["status"] = 0;
			$response["message"] = "Usuario creado";
			$stmt->close();
		}
	}
	else{
		$response["status"] = 1;
		$response["message"] = "Usuario existe";
	}
}
else{
	$response["status"] = 2;
	$response["message"] = "Faltan parametros obligatorios";
}
echo json_encode($response);
?>