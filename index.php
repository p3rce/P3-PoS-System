<?php

//LHS EVENTS//
//Created by: Pierce Goulimis//
//Date: June 13th 2019//

require('inc/config.php');


    
    if(isset($_POST['login_submit'])){
      $username = mysqli_real_escape_string($con, $_POST['login_username']);
      $password = mysqli_real_escape_string($con, $_POST['login_password']);
          
      $query = "SELECT * FROM users WHERE username='$username' AND userpassword='$password'";
      $result = mysqli_query($con, $query);
      $res = mysqli_num_rows($result);
      $row = mysqli_fetch_assoc($result);


      if($res == 1){

         //add to db last login ip
         $current_ip = $_SERVER['REMOTE_ADDR']; //user IP address
         $loggingin_email = $email;
   
         if(mysqli_query($con, "UPDATE users SET last_login_ip='$current_ip' WHERE username='$username'")){
           //added to last login
           session_start();
                           
           // Store data in session variables and redirect to home
           $_SESSION["loggedin"] = true;
           $_SESSION["username"] = $username;
           header("Location: home");
         } else{
           //error
           echo '
           <div class="alert alert-danger" role="alert">
           There was an error. Please try again later
           </div>
           '; 
         }


      } else{


        echo '
        <div class="alert alert-danger" role="alert">
         Incorrect login details!
        </div>
        ';


      }



    }











?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" href="data/favicon.png">
  <title>LHS Events</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link href="https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed&display=swap" rel="stylesheet">

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">


</head>

<body>
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-dark primary-color">
   <a href="index" class="navbar-brand"><img src="data/logo.png" height="30" style="
   height: 166px;
   margin-bottom: -130px;
   position: absolute;
   top: -52px;
   margin-left: -9px;
"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="login"></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="signup"></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="ourteam"></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index">Admin Login</a>
              <li>
          </ul>
        </div>
      </nav>

      <!-- END NAV BAR !-->
      <!-- START BODY -->
      <div class="container" style="margin-top:13%;">
        <h1 class="text-center font-weight-bold" style="padding-top:20px;">Admin Login</h1>

          <!--most recent event -->

            <div class="container">
              <form action="" method="POST">
               <input class="form-control" style="margin-top:10px;margin-bottom:10px;" type="text" placeholder="Admin Username" name="login_username">
               <input class="form-control" style="margin-top:10px;margin-bottom:10px;" type="password" placeholder="Admin Password" name="login_password">
                  <div class="text-center">
                  <!-- <div class="g-recaptcha" data-sitekey="6LcWla8UAAAAABRYHIB12TETZRdWR0lNc6xhT1nC"></div> -->
                    <button type="submit" class="btn btn-primary" name="login_submit" style="text-decoration:none;color:white;margin-top:40px;">Log In</button>
                        
                    </div>
                   
              </div>

              </form>

            

        </div>





      <!-- END BODY -->
<!-- Footer -->
<footer class="page-footer font-small blue fixed-bottom">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© <?php echo date("Y");?> Copyright
    LHS Events. All Rights Reserved
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->


  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
</body>


</html>