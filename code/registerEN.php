<!DOCTYPE html>
<html>
<head>

<link href="stylesIndex.css" rel="stylesheet" type="text/css">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
      <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
     
      <script> 
      //jQuery
      
        $(document).ready(function() {
          $('#submit').on('click', function() {
            var username = $_POST["username"];
            var firstname = $_POST["fname"];
            var lastname = $_POST["lname"];
            var email = $_POST["email"];
  
  
            $.ajax({
          dataType: 'JSON',
          url: 'sendregistermail.php',
          type: 'POST',
          data: {
                vorname: vorname,
                nachname: nachname,
                username: username,
                email: email        
              },
          cache: false
        });
          });         
        });
        </script>

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
        <a class="nav-link" style="color:#ffaf4d; font-size: 20px; padding: 7.5px 7.5px 7.5px 7.5px" href="register.php">DE</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" style="font-size: 20px; padding: 7.5px 7.5px 7.5px 7.5px" href="#">EN</a>
      </li>
    </ul>
</nav>

    <?php
    if(isset($_POST["submit"])){
      require("mysql.php");
      $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user"); //Username überprüfen
      $stmt->bindParam(":user", $_POST["username"]);
      $stmt->execute();
      $count = $stmt->rowCount();
      if (preg_match('~@hs-heilbronn\.de$~',($_POST["email"])) || preg_match('~@stud.hs-heilbronn\.de$~',($_POST["email"]))) {
      if (preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $_POST["pw"])) {
      if($count == 0){
        //Username ist frei
        $stmt = $mysql->prepare("SELECT * FROM accounts WHERE EMAIL = :email"); //Username überprüfen
        $stmt->bindParam(":email", $_POST["email"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 0){
          if($_POST["pw"] == $_POST["pw2"]){
            //User anlegen
            $stmt = $mysql->prepare("INSERT INTO accounts (USERNAME, PASSWORD, VORNAME, NACHNAME, EMAIL, TOKEN) VALUES (:user, :pw, :firstname, :lname, :email, null)");
            $stmt->bindParam(":user", $_POST["username"]);
            $hash = password_hash($_POST["pw"], PASSWORD_BCRYPT);
            $stmt->bindParam(":pw", $hash);
            $stmt->bindParam(":email", $_POST["email"]);
            $stmt->bindParam(":firstname", $_POST["firstname"]);
            $stmt->bindParam(":lname", $_POST["lname"]);
            $stmt->execute();
            echo "Your account has been created";
            require("sendregistermail.php");
          } else {
            echo "The passwords do not match";
          }
        } else {
          echo "Email already taken";
        }
      } else {
        echo "The username is already taken";
      }
      } else {
        echo "Password too weak";
      }
      } else {
        echo "Registration is only possible with HHN Emails";
      }
    }
     ?>

    <div class="container-fluid">
    <div class ="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-3">
        <br></br>
        <br>
          <form action="registerEN.php" method="post" class="form-container">
          <h1>Register</h1><br>
            <div class="form-group">
              <input class="form-control" aria-describedby="usernameHelp" type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
              <input class="form-control" aria-describedby="usernameHelp" type="text" name="fname" placeholder="Firstname" required>
            </div>
            <div class="form-group">
              <input class="form-control" aria-describedby="usernameHelp" type="text" name="lname" placeholder="Lastname" required>
            </div>
            <div class="form-group">
              <input class="form-control" aria-describedby="emailHelp" type="text" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
              <input class="form-control" type="password" name="pw" placeholder="Password" required>
            </div>
            <div class="form-group">
              <input class="form-control" type="password" name="pw2" placeholder="Repeat password" required>
            </div>
            <button style="background-color: #2e5aa3; border-color: #2e5aa3;" class="btn btn-primary btn-block" type="submit" name="submit">Create</button><br>
            <a href= "indexEN.php">Do you already have an account?</a><br>
            <a href= "Datenschutzerklärung.php">Data protection</a>
            <br></br>
            <a style="font-size: 14px">Only e-mail addresses from Heilbronn University are valid.</a>
            <br></br>
            <a style="font-size: 14px">Passwords have a minimum length of 8 and should consist of letters and numbers, special characters are recommended.</a>
          </form>
          <br></br>
        </div>
    </div>
</div>

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
  <p style="color:white; margin-left:1%">&copy; Hochschule Heilbronn 2020</p>
  <p>
  <a href="impressumEN.php" style="color:white; margin-left:1%">&rangle; imprint</a>
  <a href="Datenschutzerklärung.php" style="color:white; margin-left:1%">&rangle; Data protection</a>
  </p>
  </div>
</footer>
</body>
</html>