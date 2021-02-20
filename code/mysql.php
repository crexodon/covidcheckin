<?php
$host = "covidcheck-mariadb";
$name = "covidcheckin";
$user = "web";
$passwort = "";
$port = "3306";
try{
    $mysql = new PDO("mysql:host=$host;port=$port;dbname=$name", $user, $passwort);
} catch (PDOException $e){
    echo "SQL Error: ".$e->getMessage();
}
 ?>
