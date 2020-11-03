<?php
//LHS EVENTS//
//Created by: Pierce Goulimis//
//Date: June 13th 2019//

require('inc/config.php');




if(isset($_GET['ticket_id']) && isset($_GET['email'])){
    //ticket id in url, check if real
$rawticketid = $_GET['ticket_id'];
$ticketid = mysqli_real_escape_string($con, $rawticketid);
$rawemail = $_GET['email'];
$useremail = mysqli_real_escape_string($con, $rawemail);
$ticketidquery = "SELECT * FROM tickets2 WHERE ticket_id='$ticketid' AND attendee_email='$useremail'";
$ticket_result = mysqli_query($con, $ticketidquery);


if ($ticket_result->num_rows > 0){

    $ticket_row = $ticket_result->fetch_assoc();



} else{
    header("Location: index");
}



} else{
  header("Location: index");
}


function getTicketInfo(){
    //user waiver approved, get all info
    global $con;
    global $ticket_row;

    //check first if ticket banned

    if($ticket_row['ticket_banned'] == "1"){
        //ticket has been banned

        echo '<h1 class="text-center">😬Ticket Banned😬</h1>
        
        <h5 class="text-center">Your ticket has been banned. You are unable to attend the event and you will not recieve a
        refund for your ticket(s).
        
        </h5>
        
        
        ';
        



    } else{

        //ticket not banned
        //check if 2 people

    if($ticket_row['date_fullname'] == ""){
        //only bought 1 ticket
        $partner = "";
    } else{
        $partner = "Second Attendee: <br>" . $ticket_row['date_fullname'] . "";
    }






    echo '
    <h1 class="text-center" style="margin-top:15px;">eTicket ID #' . $ticket_row['ticket_id'] . '</h1>
    <h5 class="text-center">Please bring this along with your Student ID to the event. If you are bringing a date, they must bring their Student ID or any
    ID that has their Fullname and Photo on it. If we are not able to identify you, you will be not allowed inside the event and no refund will be given.</h5>


        <section class="container">
<!-- <h1>Your Tickets</h1> -->



  <div class="row">

    <article class="card fl-left">


      <section class="date">


        <time datetime="">

          <span style="font-size:larger;">YOUR TICKET</span>
        </time>

      </section>

      <section class="card-cont">

        <small>@LEASIDESEMI2020</small>

        <h3 style="text-decoration:none;">' . $ticket_row['event_name'] . '</h3>

        <div class="even-date">

         <i class="fa fa-calendar"></i>

         <time>
           <span style="margin-left:3px;"> ' . $ticket_row['event_date'] . '</span>

           <span>' . $ticket_row['event_time'] . '</span>
         </time>

        </div>

        <div class="even-info">

          <i class="fa fa-map-marker"></i>
          <p>
            ' . $ticket_row['event_location'] . '
          </p>

        </div>

        <a href="">' . $ticket_row['ticket_id'] . '</a>

      </section>
    </article>




    <article class="card fl-left">


      <section class="date">


        <time datetime="">

          <span style="font-size:larger;">INFO CARD</span>
        </time>

      </section>

      <section class="card-cont">

        <small>@LEASIDESEMI2020</small>

        <h3 style="text-decoration:none;">BUYER: <br>' . $ticket_row['attendee_fullname'] . '</h3>
        

        <div class="even-date">

         

         <time>
           <h3 style="text-decoration:none;">' . $partner . '</h3>

           <span>Amount Payed: $' . $ticket_row['amount_payed'] . '</span>
         </time>

        </div>

        <div class="even-info">

          
          <p>
          
        
          </p>

        </div>

       

      </section>
    </article>








  </div>
  
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
  <title>View Ticket - LHS Events</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">

  <!-- ticket temp -->
  <style type="text/css">
@import url('https://fonts.googleapis.com/css?family=Oswald');
*
{
  margin: 0;
  padding: 0;
  border: 0;
  box-sizing: border-box
}

body
{
  background-color: #dadde6;
  font-family: arial
}

.fl-left{float: left}

.fl-right{float: right}

.container
{
  width: 90%;
  margin: 100px auto
}

h1
{
  text-transform: uppercase;
  font-weight: 900;
  border-left: 10px solid #fec500;
  padding-left: 10px;
  margin-bottom: 30px
}

.row{overflow: hidden}

.card
{
  display: table-row;
  width: 49%;
  background-color: #fff;
  color: #989898;
  margin-bottom: 10px;
  font-family: 'Oswald', sans-serif;
  text-transform: uppercase;
  border-radius: 4px;
  position: relative
}

.card + .card{margin-left: 2%}

.date
{
  display: table-cell;
  width: 25%;
  position: relative;
  text-align: center;
  border-right: 2px dashed #dadde6
}

.date:before,
.date:after
{
  content: "";
  display: block;
  width: 30px;
  height: 30px;
  background-color: #DADDE6;
  position: absolute;
  top: -15px ;
  right: -15px;
  z-index: 1;
  border-radius: 50%
}

.date:after
{
  top: auto;
  bottom: -15px
}

.date time
{
  display: block;
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%)
}

.date time span{display: block}

.date time span:first-child
{
  color: #2b2b2b;
  font-weight: 600;
  font-size: 250%
}

.date time span:last-child
{
  text-transform: uppercase;
  font-weight: 600;
  margin-top: -10px
}

.card-cont
{
  display: table-cell;
  width: 75%;
  font-size: 85%;
  padding: 10px 10px 30px 50px
}

.card-cont h3
{
  color: #3C3C3C;
  font-size: 130%
}

.row:last-child .card:last-of-type .card-cont h3
{
  text-decoration: line-through
}

.card-cont > div
{
  display: table-row
}

.card-cont .even-date i,
.card-cont .even-info i,
.card-cont .even-date time,
.card-cont .even-info p
{
  display: table-cell
}

.card-cont .even-date i,
.card-cont .even-info i
{
  padding: 5% 5% 0 0
}

.card-cont .even-info p
{
  padding: 30px 50px 0 0
}

.card-cont .even-date time span
{
  display: block
}

.card-cont a
{
  display: block;
  text-decoration: none;
  width: 80px;
  height: 30px;
  background-color: #D8DDE0;
  color: #fff;
  text-align: center;
  line-height: 30px;
  border-radius: 2px;
  position: absolute;
  right: 10px;
  bottom: 10px
}

.row:last-child .card:first-child .card-cont a
{
  background-color: #037FDD
}

.row:last-child .card:last-child .card-cont a
{
  background-color: #F8504C
}

@media screen and (max-width: 860px)
{
  .card
  {
    display: block;
    float: none;
    width: 100%;
    margin-bottom: 10px
  }
  
  .card + .card{margin-left: 0}
  
  .card-cont .even-date,
  .card-cont .even-info
  {
    font-size: 75%
  }
}


        </style>


</head>

<body>
        <!-- NAVBAR -->

      <!-- END NAV BAR !-->
      <!-- START BODY -->
      <div class="container">

        <?php
            getTicketInfo();


        ?>




        </div>

      <!-- END BODY -->
<!-- Footer -->
<!-- Footer -->
<footer class="page-footer font-small blue fixed-bottom " style="margin-top:0%;">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© <?php echo date("Y");?> Copyright
    LHS Events. All Rights Reserved | A Pierce Goulimis Production
  </div>
  <!-- Copyright -->

</footer>
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
