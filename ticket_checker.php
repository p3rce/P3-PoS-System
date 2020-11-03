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






?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" href="data/favicon.png">
  <meta http-equiv="refresh" content="6000;url=logout" />
  <title>Ticket Checker - LHS Events</title>
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



        <div class="container" style="margin-top:20px;">
        <h1 class="text-center font-weight-bold">Ticket Checker</h1>

        <!-- display orders -->

        <!-- Editable table -->
<div class="card text-center" style="margin-top:10px;">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Enter a First & Last Name</h3>
  <div class="card-body">
    <form action="" method="POST">
    <input type="text" name="search_email" autocomplete="off" class="form-control" placeholder="First & Last Name">
      <button class="btn btn-success" name="search_submit">CHECK</button>
  </form>
</div>

</div>
<!-- Editable table -->
<?php
       //Ticket checker


if(isset($_POST['search_submit'])){

    $ticket_id = mysqli_real_escape_string($con, $_POST['search_email']);
    
    
        //check if real and get info
        $ticket_query = mysqli_query($con, "SELECT * FROM tickets2 WHERE attendee_fullname='$ticket_id'");
        $ticket_num = mysqli_num_rows($ticket_query);
    
    
        if($ticket_num >= 1){

          while($ticket_row = mysqli_fetch_assoc($ticket_query)){
             //ticket exists
             $realticket_id = $ticket_row['ticket_id'];
             $fullname = $ticket_row['attendee_fullname'];
             $datename = $ticket_row['date_fullname'];
             $amountpayed = $ticket_row['amount_payed'];
             $grade = $ticket_row['attendee_grade'];
 
 
             if($ticket_row['ticket_banned'] == 0){
                 //not banned
                 $ticketbanned = "NOT BANNED";
             } else{
                 $ticketbanned = "BANNED";
             }
     
             echo '
             <div class="alert alert-info" role="alert" style="margin-top:2%;">
             ID: ' . $realticket_id . '<br>
             Full Name: ' . $fullname . '<br>
             Grade: ' . $grade . '<br>
             Date Name: ' . $datename . '<br>
             Amount Payed: ' . $amountpayed . '<br>
             Ticket Banned: ' . $ticketbanned . '<br>
             
             </div>
             ';
          }
    
    
    
    
        } else{
            echo '
          <div class="alert alert-danger" role="alert" style="margin-top:2%;">
           Ticket with Purchaser Name "' . $ticket_id . '" does not exist!
          </div>
          ';
        }
    
    
    
    
    
    
    
    }     

     ?>   </div>



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