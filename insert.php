<?php
// Database connection settings
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "restaurant"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the form
    $first_name = $_POST['first_name'];
    $lastName = $_POST['last_name'];
	$phone_no = $_POST['phone_no'];
	$email = $_POST['email'];
	$persons = $_POST['no_of_person'];
	$date = $_POST['date'];
    $time = $_POST['time'];


    // Prepare the SQL query to insert data into the 'reservation' table
	
    $sql = "INSERT INTO reservation(first_name,last_name,phone_no,email,no_of_person,date,time) VALUES ('$first_name','$lastName','$phone_no','$email','$persons','$date',' $time')";

    // Execute the query and check for success
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>