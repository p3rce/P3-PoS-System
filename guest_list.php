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

$totalTicketsSold = $row2['tickets_sold'];

$sql3 = mysqli_query($con, "SELECT * FROM tickets2 ORDER BY attendee_fullname");




function getGuests(){
  global $con;
  global $row; //users row
  global $row2; //event row
  global $sql3;





  while($ticket_row = mysqli_fetch_assoc($sql3)){
    //ticket exists
    $realticket_id = $ticket_row['ticket_id'];
    $fullname = $ticket_row['attendee_fullname'];
    $datename = $ticket_row['date_fullname'];
    $amountpayed = $ticket_row['amount_payed'];
    $email = $ticket_row['attendee_email'];
    $ticketbanned = $ticket_row['ticket_banned'];


    if($ticketbanned == "1" && $datename == ""){
      //banned, no date
      echo '
      <li class="list-group-item" style="font-size:12px;"><strong>' . $fullname . '</strong> <span class="badge badge-danger">TICKET BANNED</span></li>
      
      ';
    } else{
      
      if($ticketbanned == "1" && $datename != ""){

        //banned, with date

        echo '
      <li class="list-group-item" style="font-size:12px;"><strong>' . $fullname . '</strong> with their date <strong>' . $datename . '</strong> <span class="badge badge-danger">TICKET BANNED</span></li>
      
      ';


    } else{


      if($datename == ""){
        //no date
        echo '
        <li class="list-group-item" style="font-size:12px;"><strong>' . $fullname . '</strong></li>
        
        ';
      }
      else{
        //coming with date
        echo '
        <li class="list-group-item" style="font-size:12px;"><strong>' . $fullname . '</strong> with their date <strong>' . $datename . '</strong></li>
        
        ';
      }




    }



   

    
 }




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
  <title>Guest List - LHS Events</title>
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

      <div class="card" style="margin-top:10px;">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Guest List (<?php echo $totalTicketsSold;?>)</h3><button class="btn btn-warning" onclick="window.print()">Print Guest List</button>
  <div class="card-body">
    <div id="table" class="table">
      <!-- <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i
            class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span> -->
        
      <table class="table table-bordered text-center">
        <thead>
          <tr>
            
          </tr>
        </thead>
        <ul class="list-group">
        <?php

          getGuests();

          ?>
          

        </ul>
      </table>
    </div>
  </div>
</div>
      



    </div>

      <!-- END BODY -->
<!-- Footer -->

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