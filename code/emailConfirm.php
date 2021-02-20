<?php
include("mysql.php");

if(!isset($_GET["code"])) {
  exit("etwas ist schiefgelaufen!");
}

$code = $_GET["code"];
$stmt = $mysql->prepare("SELECT email FROM confirmEmail WHERE code='$code'");
$stmt->execute();
$count = $stmt->rowCount();

if ($count == 0) {
  exit("Der Link ist abgelaufen");
}
    $row = $stmt->fetch();
    $email = $row["email"];

    $stmt = $mysql->prepare("UPDATE accounts SET ACTIVE=1 WHERE email='$email'");
    $stmt->execute();
    $stmt = $mysql->prepare("DELETE FROM confirmEmail WHERE code='$code'");

    if($stmt->execute()) {   
      header("Location: index.php");   
      exit();
    } else {
      echo("Bestätigung der Email fehlgeschlagen");
      exit();
    }
  

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Email Bestätigung</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">
    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    </style>
    <!-- Custom styles for this template -->
    <link href="checkin.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="padding: 2px 0px 2px 80px;background-color:#2e5aa3;box-shadow: 0px 1px 10px 0px black;">
      <a class="navbar-brand" href="https://www.hs-heilbronn.de/"><img src="images/HHN.png"></a>
      <button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    </nav>
    <div class="container-fluid">
        <div class ="row justify-content-center">
            <div class="col-12 col-sm-6 col-md-3">
            <br></br>
              <h1>Email wurde bestätigt!</h1></br></br></br>                             
              <br></br>
            </div>
        </div>
    </div>
    </body>
</html>