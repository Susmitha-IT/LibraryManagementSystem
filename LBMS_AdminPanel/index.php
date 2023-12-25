<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="icon" href="booklandis.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
  <style>
    body {
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }

    .layer {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
    }

    .layer1 {
      background: linear-gradient(to right, #8e2de2, #4a00e0);
    }

    .layer2 {
      background: linear-gradient(to right, #ff6a00, #ee0979);
    }

    .layer3 {
      background: linear-gradient(to right, #2193b0, #6dd5ed);
    }

    .login-container {
      background-color: #ffffff;
      max-width: 400px;
      margin: 150px auto;
      padding: 40px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      text-align: center;
      position: relative;
      z-index: 1; /* Ensure login container appears above layers */
    }

    h2 {
      margin-bottom: 20px;
      color: #4caf50;
      font-size: 28px;
    }

    form {
      margin-top: 20px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #4caf50;
      color: #ffffff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button[type="submit"]:hover {
      background-color: #45a049;
    }

    img {
      max-width: 80%;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <!-- Layers for animation -->
  <div class="layer layer1" data-aos="fade-up" data-aos-duration="1000"></div>
  <div class="layer layer2" data-aos="fade-up" data-aos-duration="1200"></div>
  <div class="layer layer3" data-aos="fade-up" data-aos-duration="1400"></div>

  <div class="container">
    <div class="login-container" data-aos="fade" data-aos-duration="800">
      <img src="booklandis.png" alt="BookLandia Logo">
      <h2>BookLandia Admin Panel</h2>
      <form action="" method="POST">
        <div class="form-group">
          <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="form-group">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <?php
          session_start();
          if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if ($username == "admin" && $password == "12345") {
				 $_SESSION["username"] = $username;
              header("Location: dashboard.php");
              exit;
            }   
            echo "<br><p class='text-center text-danger'>Invalid username or password.</p>";
          }
        ?>
      </form>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script>
    AOS.init({
      duration: 1200,
    });
  </script>
</body>
</html>
