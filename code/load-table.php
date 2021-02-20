<?php
  include 'mysql.php';
  session_start();
  if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
  }

  $stmt = $mysql->prepare("SELECT id, timestamp, status FROM verlauf WHERE username = '$username'");
  $stmt->execute();
  $count = $stmt->rowCount();
  if ($count > 0) {
  // output data of each row
  while($row = $stmt->fetch()) {
  echo "<tr><td>" . $row["id"]. "</td><td>" . $row["timestamp"] . "</td><td>"
  . $row["status"]. "</td></tr>";
  }
  echo "</table>";
  }
?>