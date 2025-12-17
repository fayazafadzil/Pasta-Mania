<?php
 $host="localhost";
 $user="root";
 $passwd="";

 
 $con= mysqli_connect($host,$user,$passwd);
 if(!$con){
 	//echo "error";
 	die("Connection faild: " . mysqli_connect_error($con));
 	
 }
 else{
 	echo "connection Successful";
 }
?>
