<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="login.css" type="text/css">
</head>
<body>
    <div class="signup-box">
        <h1>Sign up</h1>
        <h4>Take a minute for signup</h4>
        <form action="signup_process.php" method="POST">
            <label>First Name</label>
            <input type="text" name="first_name" placeholder="">
            <label>Last Name</label>
            <input type="text" name="last_name" placeholder="">
            <label>Email</label>
            <input type="email" name="email"  placeholder="">
            <label>Password</label>
            <input type="password" name="passwd" placeholder="">
            <label>Confirm Password</label>
            <input type="password" name="confirm_passwd" placeholder="">
            <input type="submit"value="submit">
        </form>
    <p>By clicking the submit button,you agree to our<br>
    <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>
    </p>
    </div>
    <p class="p-2">Already have an account? <a href="login.php">Login Here</a>
    </p>
</body>
</html>