<?php
  include 'mysql.php'; 
  session_start();
  if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
  }
  $status = $_POST['status'];
  $timestamp = $_POST['timestamp'];
  $vorname = $_POST['vorname'];
  $nachname = $_POST['nachname'];



    require('phpmailer/PHPMailerAutoload.php');
       
          $mail = new PHPMailer;
          $mail->CharSet = 'UTF-8'; 
          $mail->isSMTP();                 
          $mail->Host = 'smtp.gmail.com';  
          $mail->SMTPAuth = true;                           
          $mail->Username = 'team6checkin@gmail.com';               
          $mail->Password = '8KxYy77hZtFVs6A';                      
          $mail->SMTPSecure = 'ssl';                            
          $mail->Port = 465;                                 

          $mail->setFrom('team6checkin@gmail.com', 'team6checkin'); //Absender email, Anzeige name
          $mail->addAddress('graceffa@stud.hs-heilbronn.de');  //Epfänger email, Anzeige name

          $mail->isHTML(true);                               
          $mail->Subject = 'Neuer ' . $status;
          $mail->Body    = 'Der folgender Nutzer hat sich gemeldet: ' .$username . ' <br />Vorname: ' . $vorname . ' <br />Nachname: ' . $nachname  . ' <br />Zeitstempel: ' . $timestamp . ' <br />Status: ' . $status;

          if(!$mail->send()) {
              echo 'Message could not be sent.';
              echo 'Mailer Error: ' . $mail->ErrorInfo;
          } else {
              $isSuccess = true;
              $msg = 'Übermittlung an Coronastelle erfolgreich';
          }
      
          $data = array(
              'isSuccess' => $isSuccess,
              'msg' => $msg
          );
          echo json_encode($data);
?>