<?php
// signup_process.php - ආරක්ෂිතව මුරපද Hash කර users Table එකට ඇතුළු කිරීම

// PHP දෝෂ තිරයේ පෙන්වීමට (වැඩ කරන අතරතුර මෙය තබා ගන්න)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// 1. Database connection settings
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
    
    // 2. Form එකෙන් දත්ත ලබා ගැනීම
    // ඔබගේ HTML කේතය අනුව first_name සහ last_name ද ලබා ගනී.
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $passwd = $_POST['passwd'];
    // signup.php නිවැරදි කළ පසු මෙම නම භාවිතා වේ
    $confirm_passwd = $_POST['confirm_passwd']; 

    // 3. මුරපද ගැලපේදැයි පරීක්ෂා කිරීම (HTML නිවැරදි කළ පසු මෙය ක්‍රියා කරයි)
    if ($passwd !== $confirm_passwd) {
        // die("❌ මුරපද දෙක නොගැලපේ! නැවත උත්සාහ කරන්න. <a href='signup.php'>Go Back</a>");
        echo "❌ මුරපද දෙක නොගැලපේ! නැවත උත්සාහ කරන්න. <a href='signup.php'>Go Back</a>";
        $conn->close();
        exit();
    }
    
    // 4. මුරපදය Hash කිරීම (ආරක්ෂක පියවර)
    // password_hash() මඟින් මුරපදය කියවිය නොහැකි Hash එකක් බවට පත් කරයි.
    $hashed_password = password_hash($passwd, PASSWORD_DEFAULT);

    // 5. Prepared Statement භාවිතයෙන් දත්ත users Table එකට ඇතුළු කිරීම
    // ඔබගේ users Table එකේ ඇත්තේ email සහ password පමණි.
    $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    
    // Bind parameters: 2 strings (ss) - දත්ත ඇතුළත් කිරීම
    $stmt->bind_param("ss", $email, $hashed_password);

    if ($stmt->execute()) {
        echo "✅ ඔබ සාර්ථකව ලියාපදිංචි විය! දැන් ඔබට Login විය හැක. <a href='login.php'>Login Here</a>";
    } else {
        // දෝෂයක් ආවොත් (බොහෝ විට email එක UNIQUE නිසා)
        echo "❌ ලියාපදිංචි වීමේ දෝෂයක් සිදුවිය. මෙම ඊමේල් ලිපිනය දැනටමත් භාවිතා කර තිබිය හැක: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close();
?>