<?php 
  include 'mysql.php'; 
  session_start();
  if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
  } else {
    header("Location: indexEN.php");
    exit;
  }

  $stmt = $mysql->prepare("SELECT vorname, nachname FROM accounts WHERE username = '$username'");
  $stmt->execute();
  while($row = $stmt->fetch()) {
   $vorname = $row["vorname"];
   $nachname = $row["nachname"];
  }
  $stmt = $mysql->prepare("SELECT status FROM verlauf WHERE username = '$username' ORDER BY timestamp DESC LIMIT 1 ");
  $stmt->execute();
  while($row = $stmt->fetch()) {
  $checked = $row["status"];
  }
?>

<!doctype html>
<html lang="en">
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Corona Check in</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
       
    <script> 
    //jQuery

     

      $(document).ready(function() {
        $("input:checkbox").change(function() {
          if($(this).is(":checked")) { 
          // checkbox is checked 
              var username = "<?php echo $username; ?>";
              var vorname = "<?php echo $vorname; ?>";
              var nachname = "<?php echo $nachname; ?>";
              var status = "CheckIn";
              var timestamp = new Date().toLocaleString();
              $('#contentCI').html(timestamp);
              $('#content').html(timestamp);
              $.ajax({              
                url: "checkIntoDb.php",
                type: "POST",
                data: {
                  status: status,
                  timestamp: timestamp,
                  username: username           
                },
                cache: false          				
              });

                  $.ajax({
                  dataType: 'JSON',
                  url: 'sendmail.php',
                  type: 'POST',
                  data: {
                  vorname: vorname,
                  nachname: nachname,
                  status: status,
                  timestamp: timestamp,        
                },
                  cache: false,
            
                success: function(response){
                  $('#msg').fadeIn('slow')
                  if(response){
                    console.log(response);
                    if(response['isSuccess']){
                      $('#msg').html('<div class="alert alert-success">'+ response['msg']  +'</div>');
                  
                      $('input, textarea').val(function() {
                        return this.defaultValue;
                      });
                     }
                  else{
                    $('#msg').html('<div class="alert alert-danger">'+ response['msg'] +'</div>');
                  }
                    setTimeout(function() {
                      $('#msg').fadeOut("slow");
                    }, 2000 );
                  }
                },
                error: function(){
                  $('#msg').fadeIn('slow')
                  $('#msg').html('<div class="alert alert-danger">Errors occur. Please try again later.</div>');
                  setTimeout(function() {
                    $('#msg').fadeOut("slow");
                  }, 2000 );
                }

                  });
              }
              else {
                
                var username = "<?php echo $username; ?>";
          var vorname = "<?php echo $vorname; ?>";
          var nachname = "<?php echo $nachname; ?>";
          var status = "CheckOut";
          var timestamp = new Date().toLocaleString();
          $('#contentCO').html(timestamp);
          $('#content').html(timestamp);
          $.ajax({              
            url: "checkIntoDb.php",
            type: "POST",
            data: {
              vorname: vorname,
              nachname: nachname,
              status: status,
              timestamp: timestamp,
              username: username            
            },
            cache: false			
          });

          $.ajax({
        dataType: 'JSON',
        url: 'sendmail.php',
        type: 'POST',
        data: {
              vorname: vorname,
              nachname: nachname,
              status: status,
              timestamp: timestamp,        
            },
        cache: false,
        
        success: function(response){
          $('#msg').fadeIn('slow')

          if(response){
            console.log(response);
            if(response['isSuccess']){
             $('#msg').html('<div class="alert alert-success">'+ response['msg']  +'</div>');
              
              $('input, textarea').val(function() {
                 return this.defaultValue;
              });
            }
            else{
              $('#msg').html('<div class="alert alert-danger">'+ response['msg'] +'</div>');
            }
            setTimeout(function() {
              $('#msg').fadeOut("slow");
			      	}, 2000 );
          }
        },
        error: function(){
          $('#msg').fadeIn('slow')
          $('#msg').html('<div class="alert alert-danger">Errors occur. Please try again later.</div>');
          setTimeout(function() {
              $('#msg').fadeOut("slow");
			      	}, 2000 );
        }
         
      });
              }
                
              $("#tabledata").load("load-table.php"); 
                });         
                  });

    </script>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

        <!-- Bootstrap core CSS -->
            <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
        </style>
        <!-- Custom styles for this template -->
        <link href="checkin.css" rel="stylesheet">
      </head>


      <body>
      <form id="coronainfo" class="form-horizontal mt-4">
          <div id="msg"></div>
      </form>

      <div class="bg-modal">
            <div class="modal-content">
                    <table class="content-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>TimeStamp</th>
                                <th>CheckIn/CheckOut</th>
                            </tr>
                        </thead>
                        <tbody id="tabledata">
                    </table>
                <div class="close">
                    +
                </div>
            </div>
      </div>

        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="padding: 2px 0px 2px 30px;background-color:#2e5aa3;box-shadow: 0px 1px 10px 0px black;">

      <a class="navbar-brand" href="https://www.hs-heilbronn.de/"><img src="images/Logo.png"></a>
      <button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul style="padding-right: 80px" class="nav navbar-nav ml-auto">

          <li class="nav-item">
            <a class="nav-link" style="color:#ffaf4d;font-size: 20px;padding: 7.5px 7.5px 7.5px 7.5px" href="checkinDE.php">DE</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" style="font-size: 20px;padding: 7.5px 7.5px 7.5px 7.5px" href="#">EN</a>
          </li>
          <li class="nav-item">
            <button class="btn-sm" style="color:#ffaf4d;font-size: 20px;background:none;border:none;padding: 7.5px 7.5px 7.5px 7.5px" id="verlauf">History</button>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="color:#ffaf4d;font-size: 20px;padding: 7.5px 7.5px 7.5px 7.5px" href="logoutEN.php">Sign Out</a>
          </li>

        </ul>

    </nav>

    <main role="main">

      <div class="container container2">
        <!-- Example row of columns -->
          <div style="background-color:#f5f5f5;color:grey;width:100%;border:1px solid grey">
            <p style="margin:1%">
            </p>
            <p style="margin:1%">
            Due to the Situation caused by Covid-19, all employees of the Heilbronn University
            of Applied Sciences are required to check in/check out when entering/exiting the buildings of the University.
            Please Press the Button, so we can log your stay in the system.
            </p>
          </div>

          <br>
          <div style="width:100%; background-color:#2e5aa3;box-shadow: 5px 5px 5px 0px #888888">
          <br>
            <center><h4 id="check" style="color:white">Press the Button to check in.</h4></center>
            <br>



    <table style="table-layout:fixed">
        <td style="vertical-align:top">
    <center>
        <img src="images/Entry.png" id="leftPic" style="width:75%">
    </center>
        </td>
    <td style="vertical-align:top">

    <center>
    <label class="switch">
      <input id="button" onclick="myFunction()" type="checkbox">
      <span class="slider round"></span>
    </label>
    </center>

    <div id="status" class="table" style="display:none;width:none;color:white" >
                        <table>
                            <tr>
                                <tr><b>Checked Out:</b></tr>
                                <tr><div id="contentCO">no timestamp recorded yet</div></tr>
                            </tr>
                        </table>
                    </div>

                    <div id="table" class="table" style="display:none;width:none;color:white">
                        <table>
                            <tr>
                                <tr><b>Checked In:</b></tr>
                                <tr><div id="contentCI">no timestamp recorded yet</div></tr>
                            </tr>
                        </table>
                    </div>

        </td>

    <td style="vertical-align:top">
    <center>
    <img src="images/Inside.png" id="rightPic" style="width:75%;display:none">
    </center>
    </td>

    </table>

      <center>
      <div id="info" style="display:none;width:70%;border:1px solid #ffaf4d;color:white;background-color:#1c3763;border-radius:10px;">
       <p id="infotext" style="margin:1%;text-align:left">Check in successful! You can now move within the University.
       Make sure to follow the AHA-Rules and please point out to people who aren't following them. When leaving the University,
       please press the Button again.
       </p>
      </div>
      </center>
      <br>

          </div>
          </div>

    <br>

        </main>
    <footer class="footer mt-auto py-3">
      <div class="container">

            <center>
            <img src="images/AHAen.png"
            style="width:100%">
            </center>
            <br>
            <p>
            <b>Corona Rule</b>
            <a class="btn btn-secondary float-right" href="https://www.bundesregierung.de/breg-de/themen/coronavirus/aha-a-formel-1774474" role="button" style="background-color:#2e5aa3">Learn more &raquo;</a>
            </p>
            <p>&copy; www.bundesregierung.de
            </p>

          </div>

          </footer>
    <footer class="footer mt-auto py-3" style="background-color:#1c3763">
      <p style="color:white; margin-left:1%">&copy; Heilbronn University of Applied Sciences 2020</p>
      <p>
      <a href="impressumEN.php" style="color:white; margin-left:1%">&rangle; Imprint</a>
      <a href="Datenschutzerklärung.php" style="color:white; margin-left:1%">&rangle; Privacy</a>
      </p>
      </div>
    </footer>
    <script>$("#tabledata").load("load-table.php"); </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
          <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="checkInEN.js"></script>
    <script src="coronastelle.js"></script>
    <script type="text/javascript">var checked = "<?= $checked ?>";</script>
    <script type="text/javascript" src="checkInEN.js"></script>
</html>
