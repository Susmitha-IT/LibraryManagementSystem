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
    <h2>Login</h2>
    <form action=" " method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <div class="signup-link">
      <p>New user? <a href="signup.php">Sign up here</a></p>
   
<?php
session_start();
$conn = mysqli_connect("localhost", "root", "root", "userdb");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form inputs
    $username = $_POST["username"];
    $password = $_POST["password"];


    $query = "SELECT * FROM users WHERE username = '$username'";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row["password"];
        if (password_verify($password, $storedPassword)) {
            $_SESSION["username"] = $username;
            header("Location: user_dashboard.php");
            exit;
        } else {
            echo "<br><br><p style='color:red'>Invalid username or password.<p>";
        }
    } else {
        echo "<br><br><p style='color:red'>Invalid username or password.</p>";
    }
}
mysqli_close($conn);
?>
 </div>
  </div>
</body>
</html>