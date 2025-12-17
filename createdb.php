<?php
include("conn.php");

$sql= "create database restaurant";
$result= mysqli_query($con, $sql);

if(!$result){
	die("Error: ".mysqli_error($con));
}
else{
	echo "Database create Successful";
}

?>
