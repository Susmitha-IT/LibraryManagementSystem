<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Book Search</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet" href="css/search.css">
    

</head>
<body>
    <div class="container">
         <div class="container">
        <h2 class="my-4 text-center">Recently added books</h2>
        <form id="searchForm" action=" " method="POST">
            <div class="form-row">
                <div class="col-md-4">
				 <div class="form-group">
                        <label for="author">Genre / Category</label>
                 <?php
            $link = mysqli_connect("localhost", "root", "root", "bookdb");
            if ($link === false) {
              die("ERROR: Could not connect" . mysqli_connect_error());
            }
            $sql = "SHOW TABLES FROM bookdb";
            $result = mysqli_query($link, $sql);
            if ($result) {
              if (mysqli_num_rows($result) < 0) {
                echo '<p class="text-danger">No categories present..<br>Cannot insert records!</p>';
              } else {
                echo '<select name="category" class="form-control" required><option value="">Select</option>';
                while ($row = mysqli_fetch_array($result)) {
                  echo '<option>' . $row[0] . '</option>';
                }
                echo '</select>';
              }
              mysqli_free_result($result);
            } else {
              echo '<p class="text-danger">ERROR: Could not execute the query: ' . mysqli_error($link) . '</p>';
            }
            mysqli_close($link);
            ?>   
                </div></div>
                <div class="form-group col-md-4">
                    <label for="author">Arrived from</label>
                    <input type="date" class="form-control" id="arrive" name="arrive" placeholder="Enter Author">
                </div>
                <div class="form-group col-md-4">
                    <label for="title">Till</label>
                    <input type="date" class="form-control" id="till" name="till" placeholder="Enter Title">
                </div>
            </div>
			<center>
            <button type="submit" class="btn btn-primary">Find</button>
            <button type="button" class="btn btn-secondary" id="resetBtn">Reset</button>
			</center>
        </form>

        <div id="searchResults" class="my-4 card-container">
       


        </div>
    </div>

       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
      $(window).scroll(function() {
            $('.fadeInUp').each(function() {
                var elementTop = $(this).offset().top;
                var windowHeight = $(window).height();
                var scrollTop = $(window).scrollTop();
                if (elementTop - windowHeight < scrollTop) {
                    $(this).addClass('animated');
                }
            });
        });

     
         $('#resetBtn').click(function() {
            $('#searchForm')[0].reset();
            $('#searchResults').html('');
        });
    </script>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "bookdb";
    $found_results = 0;
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the search terms from POST data
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $fromDate = mysqli_real_escape_string($conn, $_POST['arrive']);
    $tillDate = mysqli_real_escape_string($conn, $_POST['till']);


    $sql = "SELECT `Book_Number`, `ISBN`, `Title`, `Author`, `Edition`, `Date_arrived`,  `Price`, `Available_Quantity` FROM `$category` WHERE `Date_arrived` BETWEEN '$fromDate' AND '$tillDate'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Display the results in card format
                echo "<div class='card'>";
                echo "<em><h4>" . ucfirst($category) . "</h4></em>";
                echo "<p>Book Number: " . $row["Book_Number"] . "</p>";
                echo "<p>ISBN: " . $row["ISBN"] . "</p>";
                echo "<p>Title: " . $row["Title"] . "</p>";
                echo "<p>Author: " . $row["Author"] . "</p>";
                echo "<p>Edition: " . $row["Edition"] . "</p>";
                echo "<p>Date Arrived: " . $row["Date_arrived"] . "</p>";
                echo "<p>Price: " . $row["Price"] . "</p>";
				 echo "<p>Available Quantity: " . $row["Available_Quantity"] . "</p>";
                echo "</div>";

                $found_results++;
            }
        } else {
            echo "No results found.";
        }
    } else {
        echo "Error executing the query: " . mysqli_error($conn);
    }

    echo "</div>";
    echo "<br><p style='margin-left: 15em; '>Found " . $found_results . " results.</p>";
    $conn->close();
}
?>

