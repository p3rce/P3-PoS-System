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



function getTotalGrade9(){
  global $con;

    //tally number of "9" in attendee grade tab
    $grade = "9";
    $sql = mysqli_query($con, "SELECT attendee_grade FROM tickets2 WHERE attendee_grade='$grade'");
    $num = mysqli_num_rows($sql);

    if($num == 0){
      echo '0';
    } else{
      echo $num;
    }

}

function getTotalGrade10(){
  global $con;
  //tally number of "10" in attendee grade tab
  $grade = "10";
  $sql = mysqli_query($con, "SELECT attendee_grade FROM tickets2 WHERE attendee_grade='$grade'");
  $num = mysqli_num_rows($sql);

  if($num == 0){
    echo '0';
  } else{
    echo $num;
  }
}

function getTotalGrade11(){
  global $con;
  //tally number of "11" in attendee grade tab
  $grade = "11";
  $sql = mysqli_query($con, "SELECT attendee_grade FROM tickets2 WHERE attendee_grade='$grade'");
  $num = mysqli_num_rows($sql);

  if($num == 0){
    echo '0';
  } else{
    echo $num;
  }
}

function getTotalGrade12(){
  global $con;
  //tally number of "12" in attendee grade tab
  $grade = "12";
  $sql = mysqli_query($con, "SELECT attendee_grade FROM tickets2 WHERE attendee_grade='$grade'");
  $num = mysqli_num_rows($sql);

  if($num == 0){
    echo '0';
  } else{
    echo $num;
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
  <title>View Data - LHS Events</title>
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
      <div class="container text-center" style="margin-top:5px;">

       


        <h2>Total Tickets Sold:</h2><h2 style="font-weight:bold;"><?php echo $row2['tickets_sold'];?></h2>
        <br>
        <h2>Total Dollars Made:</h2><h2 style="font-weight:bold;"><?php getTotalDollarsMade(); ?></h2>

        <br>


        
        <div id="piechart" class="text-center"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Semi ', 'Sales'],
  ['Grade 9', <?php getTotalGrade9();?>],
  ['Grade 10', <?php getTotalGrade10();?>],
  ['Grade 11', <?php getTotalGrade11();?>],
  ['Grade 12', <?php getTotalGrade12();?>],
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Sales based on Grade', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>


          </div>




      </div>



    </div>

      <!-- END BODY -->

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