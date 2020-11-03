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

function getTicketID(){
    global $con;
    #get a random nine digit value for ticketid
    $values = 'abcdefghijklmnopqrstuvwxyz01234567891011121314151617181920212223242526';
    $shuffled = str_shuffle($values);
    $shuffled = substr($shuffled,1,9);
    $assigned_ticketid = strtoupper($shuffled);
    echo $assigned_ticketid;




}


if(isset($_POST['ticket_submit'])){
    $event_name = mysqli_real_escape_string($con, $_POST['ticket_eventname']);
    $event_location = mysqli_real_escape_string($con, $_POST['ticket_location']);
    $event_date = mysqli_real_escape_string($con, $_POST['ticket_date']);
    $event_time = mysqli_real_escape_string($con, $_POST['ticket_time']);
    $attendee_fullname = mysqli_real_escape_string($con, $_POST['ticket_attendeefullname']);
    $attendee_grade = mysqli_real_escape_string($con, $_POST['ticket_attendeegrade']);
    $attendee_email = "EMAIL DISABLED";
    $date_fullname = mysqli_real_escape_string($con, $_POST['ticket_datefullname']);
    $ticket_id = mysqli_real_escape_string($con, $_POST['ticket_id']);
    $amount_payed = mysqli_real_escape_string($con, $_POST['ticket_amountpayed']);
    $admin_whoissued = mysqli_real_escape_string($con, $_POST['ticket_adminwhoissued']);



    if(mysqli_query($con, "INSERT INTO tickets2 (event_name, event_location,
    event_date, event_time, attendee_fullname, attendee_grade, attendee_email,
    date_fullname, ticket_id, amount_payed, admin_whoissued)
    VALUES ('$event_name','$event_location','$event_date',
    '$event_time','$attendee_fullname','$attendee_grade','$attendee_email',
    '$date_fullname','$ticket_id','$amount_payed','$admin_whoissued')")){

        //update tickets sold
        $tickets_bought = mysqli_real_escape_string($con, $_POST['ticket_amount']);
        $event_query = mysqli_query($con, "SELECT * FROM events2");
        $event_row = mysqli_fetch_assoc($event_query);
        $current_ticketsold = $event_row['tickets_sold'];

            if($tickets_bought == "1"){
                //bought 1 ticket
                $new_ticketsold = $current_ticketsold + 1;

                mysqli_query($con, "UPDATE events2 SET tickets_sold='$new_ticketsold'");
                
            } else{
                //bought 2 
                $new_ticketsold = $current_ticketsold + 2;

                mysqli_query($con, "UPDATE events2 SET tickets_sold='$new_ticketsold'");
            }



        //uploaded to tickets db, send ticket to user
        echo '
           <div class="alert alert-success" role="alert">
           Ticket Generated for ' . $attendee_fullname . '!
           </div>
           '; 





                  // $url2 = "https://www.lhsevents.ca/viewticket?ticket_id=$ticket_id&email=$attendee_email";
                  // $to = $attendee_email;
                  // $to_fullname = $attendee_fullname;
    
                  // $subject = 'LEASIDESEMI2020 | ETicket';
    
                  // $message .= '<p>Click below to view your ticket! We look forward to seeing you at the event! ';
    
                  // $message .= '<br>';
    
                  // $message .= '<a href="' . $url2 . '">Click here</a> <br>';
    
                  // $message .= '<br>';
    
                  // $message .= 'DO NOT REPLY TO THIS EMAIL';
    
                  // $headers .= "From: LEASIDESEMI2020 <noreply@lhsevents.ca>\r\n";
    
                  // $headers .= "Reply-To: noreply@lhsevents.ca\r\n";
    
                  // $headers .= "Content-Type: text/html\r\n";
    
                  // mail($to, $subject, $message, $headers);



    } else{
        //error
        echo '
           <div class="alert alert-danger" role="alert">
           There was an error. Please try again later
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
  <meta http-equiv="refresh" content="6000;url=logout" />
  <title>Generate Ticket - LHS Events</title>
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

        <h1 class="text-center" style="margin-top:15px;">Generate Ticket</h1>




      <div class="container text-center" style="margin-top:15px;margin-left:-10px;">

        <form action="" method="POST">

                <input type="text" style="margin-top:10px;margin-bottom:10px;" class="form-control disabled" name="ticket_eventname" value="December Semi Formal">
                <input type="text" style="margin-top:10px;margin-bottom:10px;" class="form-control disabled" name="ticket_location" value="Fiction Club">
                <input type="text" style="margin-top:10px;margin-bottom:10px;" class="form-control disabled" name="ticket_date" value="December 5">
                <input type="text" style="margin-top:10px;margin-bottom:10px;" class="form-control disabled" name="ticket_time" value="8:00PM - 11:00PM">
                <select style="width:100%;" name="ticket_amount" min="1" max="2" class="browser-default custom-select">
                     <option required selected="" disabled>Amount of Tickets Bought</option>
                     <option value="1">1</option>
                     <option value="2">2</option>

                    </select>
                <input type="text" style="margin-top:10px;margin-bottom:10px;" required class="form-control" name="ticket_attendeefullname" placeholder="Buyer Fullname">
                <select style="width:100%;" name="ticket_attendeegrade" class="browser-default custom-select">
                     <option required selected="" disabled>BUYER GRADE</option>
                     <option value="9">Grade 9</option>
                     <option value="10">Grade 10</option>
                     <option value="11">Grade 11</option>
                     <option value="12">Grade 12</option>


                    </select>
                <!-- <input type="email" style="margin-top:10px;margin-bottom:10px;" required class="form-control" name="ticket_attendeeemail" placeholder="Attendee Email"> -->
                <input type="text" style="margin-top:10px;margin-bottom:10px;" class="form-control" name="ticket_datefullname" placeholder="Date Fullname">
                <select style="width:100%;" name="ticket_amountpayed" class="browser-default custom-select">
                     <option required selected="" disabled>AMOUNT THEY PAYED YOU</option>
                     <option value="30">[EARLY BIRD PRICE] $30 (1 Ticket Bought)</option>
                     <option value="60">[EARLY BIRD PRICE] $60 (2 Tickets Bought)</option>
                     <option value="35">[NORMAL PRICE] $35 (1 Ticket Bought)</option>
                     <option value="70">[NORMAL PRICE] $70 (2 Tickets Bought)</option>
                     <option value="40">[GRADE 9 PRICE] $40 (1 Ticket Bought)</option>
                     <option value="80">[GRADE 9 PRICE] $80 (2 Tickets Bought)</option>

                    </select>
                <input type="text" style="margin-top:10px;margin-bottom:10px;" class="form-control disabled" name="ticket_id" value="<?php echo getTicketID();?>">
                <input type="text" style="margin-top:10px;margin-bottom:10px;" class="form-control disabled" name="ticket_adminwhoissued" value="<?php echo $row['username'];?>">


                <button type="submit" name="ticket_submit" class="btn btn-success">Generate Ticket</button>

            </form>
      </div>



    </div>

      <!-- END BODY -->
<!-- Footer -->
<footer class="page-footer font-small blue " style="margin-top:20%;">

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