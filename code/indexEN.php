<?php
session_start();

if(isset($_POST["submit"])){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user"); //Username überprüfen
  $stmt->bindParam(":user", $_POST["username"]);
  $stmt->execute();
  $count = $stmt->rowCount();
  if($count == 1){
    //Username ist frei
    $row = $stmt->fetch();
    if(password_verify($_POST["pw"], $row["PASSWORD"])){
      if(is_null($row["ACTIVE"])){
        echo "Account has not been confirmed";
      }
      else {
        session_start();
        $_SESSION["username"] = $row["USERNAME"];
        header("Location: checkinEN.php");
      }  
    } else {
      echo "Login failed";
    }
  } else {
    echo "Login failed";
  }
}
?>

<!DOCTYPE html>
<html>
<head>



<link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

<!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
</style>
<!-- Custom styles for this template -->



  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="indexRegister.css?v=<?php echo time(); ?>">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="padding: 2px 0px 2px 30px;background-color:#2e5aa3;box-shadow: 0px 1px 10px 0px black;">

  <a class="navbar-brand" href="https://www.hs-heilbronn.de/%22%3E"> <img src="images/Logo.png"></a>

    <ul style="padding-right: 80px" class="nav ml-auto">
    
	    <li class="nav-item">
        <a class="nav-link" style="color:#ffaf4d; font-size: 20px; padding: 7.5px 7.5px 7.5px 7.5px" href="index.php">DE</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" style="font-size: 20px; padding: 7.5px 7.5px 7.5px 7.5px" href="#">EN</a>
      </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class ="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-3">
        <br></br>
        <br>
          <form action="indexEN.php" method="post" class="form-container">
          <h1>Login</h1><br>
            <div class="form-group">
              <input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
              <input class="form-control" id="pw" type="password" name="pw" placeholder="Password" required>
            </div>
            <div class="form-group form-check">
              <input class="form-check-input" type="checkbox" id="checkpw" onclick="zeigePasswort()">
              <label class="form-check-label" for="exampleCheck1">Show password in plain text</label>
            </div>
            <button style="background-color: #2e5aa3; border-color: #2e5aa3;" class="btn btn-primary btn-block" type="submit" name="submit">log in</button>
            <br></br>
            <a href="registerEN.php">Don't have an account yet?</a><br>
            <a href="requestReset.php">Forgot Password?</a>
          </form>
          <br></br>
        </div>
    </div>
</div>
    <script>
      // Passwort im Klartext anzeigen

      function zeigePasswort() {
      if (document.getElementById("checkpw").checked == true) {
        document.getElementById("pw").type = "text";
      }
      else {
        document.getElementById("pw").type = "password";
      }
      }
    </script>

<footer class="footer mt-auto py-3">
  
  <div class="container">
      
        <center>
        <img src="images/AHAen.png"
        style="width:100%">
        </center>
        <br>
        <p>
        <b>AHA Rule</b>
        <a class="btn btn-secondary float-right" href="https://www.bundesregierung.de/breg-de/themen/coronavirus/aha-a-formel-1774474" role="button" style="background-color:#2e5aa3">More about the AHA rule &raquo;</a>
        </p>
        <p>&copy; www.bundesregierung.de
        </p>
     
      </div>
      </footer>
<footer class="footer mt-auto py-3" style="background-color:#1c3763">
  <p style="color:white; margin-left:1%">&copy; Heilbronn University 2020</p>
  <p>
  <a href="impressumEN.php" style="color:white; margin-left:1%">&rangle; Imprint</a>
  <a href="Datenschutzerklärung.php" style="color:white; margin-left:1%">&rangle; Data protection</a>
  </p>
  </div>
</footer>
  </body>
</html>