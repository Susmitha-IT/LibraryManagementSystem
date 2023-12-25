<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Book Search</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet" href="css/search.css">
	<style>
table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    
    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    
    th {
      background-color: #f2f2f2;
    }
    
    tbody tr:hover {
      background-color: #f5f5f5;
    }
    
    /* Center align text in the Book Id and Title columns */
    th:first-child,
    td:first-child {
      text-align: center;
    }
    
    /* Make the Book Image column smaller */
    td:nth-child(9) {
      width: 100px;
    }
.alb{
	width: 100px;
	height: 100px;
	padding :5px;
}
.alb img{
	width:100%;
	height:100%;
}

#fullImageContainer {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5); /* Adjust the opacity as needed */
      z-index: 9999;
    }
    
    #fullImageContainer img {
      display: block;
      max-width: 80%;
      max-height: 80%;
      margin: 0 auto;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
	  .table-responsive {
         overflow-x: auto;
      }
</style>
<script>
    function showFullImage(imgSrc) {
      var fullImg = document.getElementById('fullImage');
      fullImg.src = imgSrc;
      
      var container = document.getElementById('fullImageContainer');
      container.style.display = "block";
    }
    
    function closeFullImage() {
      var container = document.getElementById('fullImageContainer');
      container.style.display = "none";
    }
  </script>
</head>
<body>
       <div class="container">
      <div class="container">
          <h2 class="my-4 text">E-Book Search</h2>
         <form method="post" class="form-inline">
            <div class="form-group">
               <label for="title"></label>
               <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="form-group">
               <label for="author"></label>
               <input type="text" class="form-control" id="author" name="author" placeholder="Enter author">
            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" class="btn btn-primary">Search</button>
         </form>

         <?php
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST["title"];
            $author = $_POST["author"];
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "ebook";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
               die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM ebooks WHERE title LIKE '%$title%' AND author LIKE '%$author%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
               echo '<br><h5>Search Results:</h5>';
               echo '<div class="table-responsive"> <div class="col-sm-6 col-md-4 col-lg-3"><table class="table table-bordered">';
               echo '<tr><th>Title</th><th>Author</th><th>Description</th><th>Category</th><th>Publication year</th><th>ISBN</th><th>Link</th><th>Book</th></tr>';
               while ($row = $result->fetch_assoc()) {
                  echo '<tr>';
                  echo '<td>' . $row['title'] . '</td>';
                  echo '<td>' . $row['author'] . '</td>';
                  echo '<td>' . $row['description'] . '</td>';
                  echo '<td>' . $row['category'] . '</td>';
                  echo '<td>' . $row['publication_year'] . '</td>';
                  echo '<td>' . $row['isbn'] . '</td>';
                  echo '<td><a href="' . $row['url'] . '" target="_blank">' . $row['url'] . '</a></td>';

                  echo '<td><img src="http://localhost/LBMS_AdminPanel/' . $row['image_url'] . '" onclick="showFullImage(this.src)" width="100" height="100"></td>';
                  echo '</tr>';
               }
               echo '</table></div></div>';
            } else {
               echo '<h2>No results found.</h2>';
            }

            $conn->close();
         }
         ?>
         <div id="fullImageContainer" onclick="closeFullImage()">
            <img id="fullImage" src="">
         </div>
      </div>
   </div>
</body>
</html>

