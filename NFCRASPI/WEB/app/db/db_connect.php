<?php
define('DB_USER', "u974320120_ilock");
define('DB_PASSWORD', "Coin2019@"); 
define('DB_DATABASE', "u974320120_ilock"); 
define('DB_SERVER', "localhost"); 
 
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
 
// Check connection
if(mysqli_connect_errno())
{
	echo "Fallo al conectar por mysql: " . mysqli_connect_error();
}
 
?>