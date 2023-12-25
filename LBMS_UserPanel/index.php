<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booklandia Library</title>
	<link rel="icon" href="booklandia.png" type="image/x-icon">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 
  <style>
  
body {
  font-family: Arial, sans-serif;
}

.hero {
  position: relative;
  height: 600px;
  overflow: hidden;
}
.glass-overlay {
  position: absolute;
  top: 50%; /* Adjust the positioning as needed */
  left: 50%;
  transform: translate(-50%, -50%);
  width: 100%;
  max-width: 600px; /* Adjust the maximum width as needed */
  padding: 20px;
  text-align:center;
  background-color: rgba(0, 0, 0, 0.7);
  border-radius: 15px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  color: #fff;
}

.hero:before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image:url('home.jpg');
  background-size: cover;
  background-position: center;
}

h1 {
  font-size: 48px;
  font-weight: bold;
  margin-bottom: 20px;
}

.welcome-text {
  font-size: 24px;
  margin-bottom: 20px;
}

.container {
  margin-top: 80px;
}

.card {
  border: none;
  border-radius: 15px;
  box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
  border: 1px solid rgba(255, 255, 255, 0.18);
  padding: 30px;
  text-align: center;
  transition: transform 0.3s;
}

.card:hover {
  transform: scale(1.05);
}

.card-title {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 15px;
}

.card-text {
  font-size: 18px;
}

footer {
  background-color: #333;
  color: #fff;
  text-align: center;
  padding: 20px;
  margin-top: 80px;
}

/* Animation on Scroll */
.fade-in {
  opacity: 0;
  transition: opacity 1s ease-in-out;
}

.fade-in.fade-in-show {
  opacity: 1;
}

#map {
  height: 400px;
  width: 100%;
}

.mapcontainer {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff; /* Updated background color to white */
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
.container1 .contactInfo .box:hover .icon 
{
	background: #00bcd4;
	color: #fff;
}
.container1 .contactInfo .txt
{
	color: #1b2141;
	margin-top: 50px;
	font-weight: 700;
	padding-left: 10px;
	border-left: 50px solid #e14842;
	line-height: 1em;
}
.sci 
{
	position: relative;
	display: flex;
	gap: 30px;
	margin: 20px 0;
}
.sci li 
{
	list-style: none;
}
.sci li a 
{
	color: #1b2141;
	font-size: 2em;
	transition: 0.5s;
}
.sci li a:hover 
{
	color: #00bcd4;
}
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap');
 .ebook-section {
         background-color: #f8f9fa;
         padding: 50px 0;
         text-align: center;
      }

      .ebook-content {
         max-width: 600px;
         margin: 0 auto;
      }
</style>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Booklandia Library</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#aboutus">About us</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#map">Location</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="./login.php">Log In</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <section class="hero">

    <div class="glass-overlay">
      <h1 class="fade-in">Welcome to the BookLandia Library</h1>
      <p class="welcome-text fade-in">Manage your books, borrowings, and more!</p>
    </div>
  </section>

  <section id="aboutus" class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6">
        <div class="card fade-in">
          <h2 class="card-title">Books</h2>
          <p class="card-text">Explore and search the available books in the library.</p>
          <a href="#" class="btn btn-primary">View Books</a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card fade-in">
          <h2 class="card-title">Borrowed Books</h2>
          <p class="card-text">See the books you have currently borrowed and their due dates.</p>
          <a href="#" class="btn btn-primary">View Borrowed Books</a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card fade-in">
          <h2 class="card-title">Profile</h2>
          <p class="card-text">Manage your account details and update your information.</p>
          <a href="#" class="btn btn-primary">Edit Profile</a>
        </div>
      </div>
    </div>
  </section><br><br><br><br><br>
  <div class="ebook-section">
      <div class="container">
         <div class="ebook-content">
            <h2>Explore Our Digital E-Book Collection</h2>
            <p class="lead">Discover a vast collection of digital e-books in various genres. Read anytime, anywhere on your favorite device.</p>
            <p>Our e-books are accessible and convenient, providing a rich reading experience. Whether you're into fiction, non-fiction, or educational material, we've got something for everyone.</p>
            <a href="#ebookCatalog" class="btn btn-primary btn-lg">Browse E-Book Catalog</a>
         </div>
      </div>
   </div>
   <div class="mapcontainer">
    <div id="map"></div>
  </div>

  <script>
    // JavaScript code for displaying the map
    function initMap() {
      var location = { lat: 9.915384, lng: 78.135641 }; // Replace with your desired location's coordinates9.915384, 78.135641
      var map = new google.maps.Map(document.getElementById('map'), {
        center: location,
        zoom: 12
      });

      var marker = new google.maps.Marker({
        position: location,
        map: map,
        title: 'Desired Location'
      });
    }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFkNVlyJge38tvaA3vlGKNBrAxSLBfdFA&callback=initMap" async defer></script>
  <footer>
   
      
        <p>&copy; 2023 Library Management System. All rights reserved.</p>
        <br>
        <h6>Contact Us</h6><br>
        <p>Email: <a href='info@booklandialibrary.com'>info@booklandialibrary.com</a></p>
        <p>Phone: <a href='+1 (123) 456-7890'>+1 (123) 456-7890</a></p>

  
</footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    // Animation on Scroll
    window.addEventListener('scroll', reveal);

    function reveal() {
      var reveals = document.querySelectorAll('.fade-in');

      for (var i = 0; i < reveals.length; i++) {
        var windowHeight = window.innerHeight;
        var revealTop = reveals[i].getBoundingClientRect().top;
        var revealPoint = 150;

        if (revealTop < windowHeight - revealPoint) {
          reveals[i].classList.add('fade-in-show');
        }
      }
    }
  </script>
  
</body>

</html>