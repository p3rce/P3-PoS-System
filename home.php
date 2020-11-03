<?php
//LHS EVENTS//
//Created by: Pierce Goulimis//
//Date: June 13th 2019//

require('inc/config.php');
error_reporting(0);
session_start();

if($_SESSION["username"]){
    //do nothing, correct session
    $isLoggedIn = $_SESSION['username'];
} else{
    header("location: index");
}


$sql = mysqli_query($con, "SELECT * FROM users WHERE username='$isLoggedIn'");
$row = mysqli_fetch_assoc($sql);

$sql2 = mysqli_query($con, "SELECT * FROM events2");
$row2 = mysqli_fetch_assoc($sql2);


function getTotalDollarsMade(){
  global $con;
  


  //get all money earned

  $result= mysqli_query($con, "SELECT SUM(amount_payed) AS totalsum FROM tickets2");

$row = mysqli_fetch_assoc($result); 

$sum = $row['totalsum'];

if($sum == 0){
  echo '0';
} else{
  echo $sum;
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
  <meta http-equiv="refresh" content="6000;url=logout" />
  <title>Home - LHS Events</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">

  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-6475599804372323",
    enable_page_level_ads: true
  });
</script>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark primary-color">
        <a class="navbar-brand" href="home">LHS Events Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout">Log Out</a>
              <li>
          </ul>
        </div>
      </nav>

      <!-- END NAV BAR !-->
      <!-- START BODY -->
      <div class="container">

        <h1 class="text-center" style="margin-top:15px;">Welcome, <?php echo $row['username'];?></h1>




      <div class="container text-center" style="margin-top:15px;margin-left:-10px;">

      <a href="generate_ticket" style="margin-left:5px;margin-right:5px;" class="btn btn-primary">Generate Ticket 🥳🥳</a>

      <a href="ticket_checker" style="margin-left:5px;margin-right:5px;" class="btn btn-primary">Ticket Checker 🎟️🎟️</a>

      <a href="guest_list" style="margin-left:5px;margin-right:5px;" class="btn btn-primary">Guest List 💃🎉</a>

      <a href="view_data" style="margin-left:5px;margin-right:5px;" class="btn btn-primary">View Data 🗽</a>



      </div>



    </div>

      <!-- END BODY -->
<!-- Footer -->
<footer class="page-footer font-small blue fixed-bottom " style="margin-top:20%;">

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