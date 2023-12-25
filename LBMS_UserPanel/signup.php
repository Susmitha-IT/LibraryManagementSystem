<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Booklandia Library</title>
	<link rel="icon" href="booklandia.png" type="image/x-icon">
   <link rel="stylesheet" href="css/logsign.css">
</head>
<body>
  <div class="container">
    <h2>Sign Up</h2>
    <form action=" " method="POST">
      <input type="text" name="username" placeholder="Username" required>
	   <input type="email" name="email" placeholder="Email"required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Sign Up</button>
    </form>
    <div class="signup-link">
      <p>Registered ? <a href="login.php">Log In</a></p>
  
<?php

$conn = mysqli_connect("localhost", "root", "root", "userdb");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $equery = "SELECT * FROM users WHERE email = '$email'";
	$eresult = mysqli_query($conn, $equery);
if (mysqli_num_rows($eresult) > 0) {
    // Handle the duplicate entry
    echo "<p>Email already exists!</p>";
}else {
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Create the SQL query to insert the user into the database
    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
	


    if (mysqli_query($conn, $query)) {
        echo "<p>Registration successful. You can login when approved <a href='login.php'>Log In</a>.</p>";
    } else {
          echo "Error: " . mysqli_error($conn);
    }
}
}


mysqli_close($conn);
?>
  </div>
  </div>
</body>
</html>