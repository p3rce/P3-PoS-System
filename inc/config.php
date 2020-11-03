<?php

//LHS EVENTS//
//Created by: Pierce Goulimis//
//Date: June 13th 2019//

$con = mysqli_connect("localhost","root","","lhsevents_db2"); //connect to db

//Maintenance Mode

$maintenance = 0;

if($maintenance == 1){
    header("location: maintenance");
} else{
    //do nothing
    
}


//Coming Soon Mode

$comingsoon = 0;

if($comingsoon == 1){
    header("location: hello");
} else{
    //do nothing
}







?>