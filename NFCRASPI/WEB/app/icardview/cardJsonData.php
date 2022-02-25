<?php
include 'dbconfig.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
} 

//$sql = "SELECT * FROM personal";

$sql = "SELECT personal.*,acceso.fechaEntrada FROM personal left join acceso on personal.uid = acceso.uid where acceso.fechaEntrada in (select max(fechaEntrada) from acceso group by acceso.uid) or acceso.fechaEntrada is NULL";

$result = $conn->query($sql);

if ($result->num_rows >0) {
 // output data of each row
 while($row[] = $result->fetch_assoc()) {
 
 $tem = $row;
 
 $json = json_encode($tem);
 
 
 }
 
} else {
 echo "0 results";
}
 echo $json;
$conn->close();
?>