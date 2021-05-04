<?php
$hostname="localhost";
$user="root";
$pwd="";
$db="id14620765_badacdb2";

                    //Hostname, DB User, Password, DB Name
 $con=mysqli_connect("localhost","id14620765_badacdb2","c-DMKcd+9\s4Iuq8", "id14620765_badacdb");
// $con=mysqli_connect("localhost","root","", "id14620765_badacdb2");
if(!$con)
{
	die("Could not because".mysqli_error());
}