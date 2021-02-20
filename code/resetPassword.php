<?php
include("mysql.php");

if(!isset($_GET["code"])) {
  exit("Der Link ist abgelaufen");
}

$code = $_GET["code"];
$stmt = $mysql->prepare("SELECT email FROM resetRequests WHERE code='$code'");
$stmt->execute();
$count = $stmt->rowCount();

if ($count == 0) {
  exit("Der Link ist abgelaufen");
}

if(isset($_POST["password"])) {
  if($_POST["password"] != $_POST["password2"]){
    echo("Die Angegebenen Passwörter stimmen nicht überein");
  } else {
    $pw = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $row = $stmt->fetch();
    $email = $row["email"];

    $stmt = $mysql->prepare("UPDATE accounts SET PASSWORD='$pw' WHERE email='$email'");
    $stmt->execute();
    $stmt = $mysql->prepare("DELETE FROM resetRequests WHERE code='$code'");
    if($stmt->execute()) {   
      header("Location: index.php");   
      exit();
    } else {
      echo("Zurücksetzen des Passworts fehlgeschlagen");
      exit();
    }
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Passwort zurücksetzen</title>
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
      <a class="navbar-brand" href="https://www.hs-heilbronn.de/"><img src="images/Logo.png"></a>
      <button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    </nav>
    <div class="container-fluid">
        <div class ="row justify-content-center">
            <div class="col-12 col-sm-6 col-md-3">
            <br></br>
            <form method="POST">
              <h1>Neues Passwort festlegen</h1></br></br></br>              
                <div class="form-group">
                  <input class="form-control" type="password" name="password" placeholder="Neues Passwort">
                  </br>
                  <input class="form-control" type="password" name="password2" placeholder="Passwort wiederholen">
                </div>
                <br>
                <button class="btn btn-primary btn-block" type="submit" name="submit">Absenden</button>
                <br></br>
              </form>
              <br></br>
            </div>
        </div>
    </div>
    </body>
</html>