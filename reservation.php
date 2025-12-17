<!DOCTYPE html >
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Form </title>
    <link rel="stylesheet" href="reservation.css">
</head>
<body>
    <section class="banner">
        <h1>BOOK YOUR TABLE NOW</h1>
        <div class="card-content">
            <h3>Reservation Form</h3>

            <form action="insert.php" method="POST">
                <div class="form-row">
                    <input type="text" name="first_name" placeholder="First Name" autocomplete="off" required>
                    <input type="text" name="last_name" placeholder="Last Name"  autocomplete="off" required>
                </div>
            
                <div class="form-row">
                    <input type="text" name="phone_no" placeholder="Phone Number"  autocomplete="off" required>
                    <input type="email" name="email" placeholder="Email"  autocomplete="off" required>
                </div>
                                    
                <div class="form-row">
                    <input type="number" name="no_of_person" placeholder="How many Persons?" min="1" required>
                    <input type="date" name="date" required>
                    <select name="time" required>
                        <option value="" disabled selected>Select hour</option>
                        <option value="10:00">10:00</option>
                        <option value="12:00">12:00</option>
                        <option value="14:00">14:00</option>
                        <option value="16:00">16:00</option>
                        <option value="18:00">18:00</option>
                        <option value="20:00">20:00</option>
                    </select>
                </div>
                <div class="form-row">
                    <input type="submit" name="submit" value="BOOK TABLE">
                    
                </div>
                
            </form>
            
    </div>
    <br>
    <p><b>Do you haven't an account? </p><br><a href="signup.php">Sign Up Now</a>
    </section>
      
    
</body>
</html>