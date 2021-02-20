<?php
    header('Content-Type: text/html; charset=UTF-8');
    require('phpmailer/PHPMailerAutoload.php');
    require('mysql.php');   
    if(isset($_POST["email"])) {
    
        $emailTo = $_POST["email"];

        $stmt = $mysql->prepare("SELECT * FROM accounts WHERE email='$emailTo'");
        $stmt->execute(); 
        $count = $stmt->rowCount();
        if ($count == 0) {
            echo 'Diese Email existiert nicht';         
        } else {
          $code = uniqid(true);
          $stmt = $mysql->prepare("INSERT INTO resetRequests(CODE, EMAIL) VALUES('$code','$emailTo')");
          $stmt->execute();

          $mail = new PHPMailer(true);
          $mail->CharSet = 'UTF-8'; 
          try {
              $mail->isSMTP();                 
              $mail->Host = 'smtp.gmail.com';  
              $mail->SMTPAuth = true;                           
              $mail->Username = 'team6checkin@gmail.com';               
              $mail->Password = '8KxYy77hZtFVs6A';                      
              $mail->SMTPSecure = 'ssl';                            
              $mail->Port = 465;                                 

              $mail->setFrom('team6checkin@gmail.com', 'team6checkin'); //Absender email, Anzeige name
              $mail->addAddress($emailTo);  //Empfänger email, Anzeige name
              $mail->addReplyTo('no-reply@covidcheckin.de', 'No reply'); //no-reply

              $url = "http://" . $_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]) . "resetPassword.php?code=$code";
              $mail->isHTML(true);                               
              
              $mail->Subject = 'Passwort zurücksetzen - Covidcheckin.de';
              $mail->Body    = "<h1>Sie haben eine Anfrage zum ändern ihres Passworts angefragt</h1></br>
                                Passwort ändern: <a href='$url'>Link</a>";

              $mail->send();
              echo 'Link um das Passwort zurückzusetzen wurde an die Email gesendet';

          } catch (Exception $e) {
              echo 'Nachricht konnte nicht versendet werden. Mailer Error:', $mail->ErrorInfo;
          }
          exit();
        }
    }
          
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Passwort vergessen</title>
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
                <h1>Passwort vergessen?</h1><br>
                Kein Problem! Hier können Sie Ihr altes Passwort zurücksetzen und ein neues anlegen. </br></br>
                E-Mail-Adresse eingeben 
                    <div class="form-group">
                        <input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" type="text" name="email" autocomplete="off" required>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit" name="submit">Absenden</button>
                    <br></br>
                </form>
                <br></br>
                </div>
            </div>
        </div>
    </body>
</html>