<?php

/**
* Queries the database and checks whether the user already exists
* 
* @param $username
* 
* @return
*/
function userExists($username){
	$query = "SELECT username FROM member WHERE username = ?";
	global $con;
	if($stmt = $con->prepare($query)){
		$stmt->bind_param("s",$username);
		$stmt->execute();
		$stmt->store_result();
		$stmt->fetch();
		if($stmt->num_rows == 1){
			$stmt->close();
			return true;
		}
		$stmt->close();
	}
 
	return false;
}

?>