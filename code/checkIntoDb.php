<?php
include 'mysql.php';

$status = $_POST['status'];
$timestamp= $_POST['timestamp'];
$username = $_POST['username'];
  
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else{
  date_default_timezone_set('Europe/Berlin');
  $stmt = $mysql->prepare("INSERT INTO verlauf(status,timestamp,username)VALUES('$status','$timestamp','$username')");
  $stmt->execute();
}

?>