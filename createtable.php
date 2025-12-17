<?php

include("conn.php");
mysqli_select_db($con,"restaurant");
$sql= "create table reservation(
	id int AUTO_INCREMENT PRIMARY KEY, 
	first_name varchar(20),
	last_name varchar(20),
	phone_no varchar(25),
	email varchar(50),
	no_of_person INT,
	date date,
	time time	
)";

$result= mysqli_query($con,$sql);

if(!$result){
	die("Error: ".mysqli_error($con));
}
else{
	echo "Table create Successful";
}


?>
