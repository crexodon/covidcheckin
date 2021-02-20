<?php
require('phpmailer/PHPMailerAutoload.php');
require('mysql.php');  

$username = $_POST["username"];
$email = $_POST["email"];
$firstname = $_POST["fname"];;
$lastname =$_POST["lname"];;

$code = uniqid(true);
$stmt = $mysql->prepare("INSERT INTO confirmEmail(CODE, EMAIL) VALUES('$code','$email')");
$stmt->execute();

       
          $mail = new PHPMailer(true);
          $mail->CharSet = 'UTF-8'; 
          $mail->isSMTP();                 
          $mail->Host = 'smtp.gmail.com';  
          $mail->SMTPAuth = true;                           
          $mail->Username = 'team6checkin@gmail.com';               
          $mail->Password = '8KxYy77hZtFVs6A';                      
          $mail->SMTPSecure = 'ssl';                            
          $mail->Port = 465;                                 

          $mail->setFrom('team6checkin@gmail.com', 'team6checkin'); //Absender email, Anzeige name
          $mail->addAddress($email);  //Empfänger email, Anzeige name

          $url = "http://" . $_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]) . "emailConfirm.php?code=$code";
          $mail->isHTML(true);                               
          $mail->Subject = 'Registrierung auf der Covid Checkin Website';
          $mail->Body    = "Sehr geehrte/r $firstname $lastname  <br /> vielen Dank für Ihre Registrierung auf covidcheckin.de.</br> 
                            Email bestätigen: <a href='$url'>Link</a>";

          if(!$mail->send()) {
              echo 'Message could not be sent.';
              echo 'Mailer Error: ' . $mail->ErrorInfo;
          } 
?>