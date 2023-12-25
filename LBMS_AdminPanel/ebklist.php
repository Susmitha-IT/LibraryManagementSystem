<?php 
$servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "ebook";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
<html>
<head>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="icon" href="booklandis.png" type="image/x-icon">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
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
a{
	text-decoration:none;
	colorblack;
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

<?php
$sql="SELECT * FROM ebooks";
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){?>
	    <div class="table-responsive">
        <div class="col-sm-6 col-md-4 col-lg-3">
                    <table class="table table-bordered">
            <tr>
			<th>S.No</th>
               <th>Book Id</th>
                <th>Title</th>
                <th>Author</th>
                <th>Description</th>
                <th>Category</th>
				<th>Publication year</th>
                <th>ISBN</th>
				 <th>Link</th>
				  <th>Book</th>
				  <th>Featured Book</th>
				  <th>Date Added</th>
                </tr>
				<?php
				$i=1;
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
			       echo '<td>' . $i . '</td>';
                echo "<td>" . $row['book_id'] . "</td>";
				 echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['author'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['category'] . "</td>";
				echo "<td>" . $row['publication_year'] . "</td>";
				echo "<td>" . $row['isbn'] . "</td>";
				echo '<td><a href="' . $row['url'] . '" target="_blank">' . $row['url'] . '</a></td>';

                echo "<td>";?><div class="alb"><img src="<?=$row['image_url']?>" onclick="showFullImage(this.src)"></div><?php echo "</td>";
				if( $row['featured_book'] ==1){$r='Yes';}else{$r="No";}
				echo "<td>" . $r . "</td>";
				echo "<td>" . $row['date_added'] . "</td>";
            echo "</tr>";
			$i++;
        }
        echo "</table></div></div>";
        // Free result set
        mysqli_free_result($result);

?>
	<?php
	}
    }?>
	  <div id="fullImageContainer" onclick="closeFullImage()">
    <img id="fullImage" src="">
  </div>


</body>
</html>

