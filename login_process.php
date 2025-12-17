<?php
// login_process.php - Login පරීක්ෂා කිරීමේ සහ සත්‍යාපනයේ කේතය

// Database connection settings (ඔබගේ අනෙකුත් ගොනුවල ඇති ආකාරයටම)
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
    
    // 1. Form එකෙන් දත්ත ලබා ගැනීම (login.php එකේ name attributes අනුව)
    $email = $_POST['email'];
    $passwd = $_POST['passwd'];
    
    // 2. Prepared Statement භාවිතයෙන් Database එකේ අදාළ Email එක සොයා ගැනීම
    // මෙහිදී මුරපද Hash එක SELECT කර ගනී.
    $sql = "SELECT password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    
    // Bind parameters: 1 string (s)
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result(); // ප්‍රතිඵල ලබා ගනී

    if ($result->num_rows === 1) {
        // 3. Email එක හමුවුවහොත්, Hashed Password එක ලබා ගැනීම
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // 4. මුරපදය පරීක්ෂා කිරීම (Verify the Password)
        // password_verify() මඟින් පරිශීලකයා ඇතුළු කළ මුරපදය, Database එකේ ඇති Hash එක සමඟ ගැලපේදැයි පරීක්ෂා කරයි.
        if (password_verify($passwd, $hashed_password)) {
            
            // Login සාර්ථකයි!
            
            // ඔබට මෙතැනින් Session එකක් ආරම්භ කර පරිශීලකයා අඳුනා ගත හැක:
            // session_start();
            // $_SESSION['loggedin'] = true;
            // $_SESSION['email'] = $email;
            
            echo "✅ සාදරයෙන් පිළිගනිමු! Login සාර්ථකයි. ඔබව ප්‍රධාන පිටුවට යොමු කෙරේ...";
            
            // සාර්ථක වීමෙන් පසු ප්‍රධාන පිටුවට යොමු කිරීම
            // header("Location: index.php"); 
            // exit();
        } else {
            // මුරපදය වැරදියි
            echo "❌ මුරපදය වැරදියි. නැවත උත්සාහ කරන්න.";
        }
    } else {
        // Email එක Database එකේ නැත
        echo "❌ මෙම ඊමේල් ලිපිනය ලියාපදිංචි වී නොමැත.";
    }
    
    $stmt->close();
}

$conn->close();
?>