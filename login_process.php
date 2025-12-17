<?php
// login_process.php - Login checking and verification code

// Database connection settings (same as in your other files)
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "restaurant"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1.Retrieving data from the form (according to the name attributes in login.php)
    $email = $_POST['email'];
    $passwd = $_POST['passwd'];
    
    // 2.Finding the relevant email in the database using a prepared statement
// Here, the password hash is SELECTed.
    $sql = "SELECT password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    
    // Bind parameters: 1 string (s)
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result(); // give result

    if ($result->num_rows === 1) {
        // 3.If the email is found, get the Hashed Password
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // 4.Verify the Password
// password_verify() checks whether the password entered by the user matches the hash in the database.
        if (password_verify($passwd, $hashed_password)) {
            
            // Login succesfully!
            
            // You can start a session and identify the user here:
            // session_start();
            // $_SESSION['loggedin'] = true;
            // $_SESSION['email'] = $email;
            
            echo "✅ Welcome! Login successful. You will be redirected to the main page.";
            
            // Redirecting to the main page after success
            // header("Location: index.php"); 
            // exit();
        } else {
            // The password is incorrect
            echo "Incorrect password. Try again.";
        }
    } else {
        // The email is not in the database.
        echo "This email address is not registered.";
    }
    
    $stmt->close();
}

$conn->close();
?>
