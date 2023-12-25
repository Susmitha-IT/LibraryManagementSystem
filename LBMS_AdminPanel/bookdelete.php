<!DOCTYPE html>
<html>
<head>
  <title>Search Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="icon" href="booklandis.png" type="image/x-icon">
  <style>
    .container {
      margin-top: 50px;
    }
    .search-button {
      margin-top: 20px;
    }
    #search-results {
      margin-top: 50px;
    }
  </style>
</head>
<body>
  <div class="container">
    <form action="" method="POST">
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <div class="form-group">
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
                echo '<select name="category" class="form-control" required><option value="">Select category</option>';
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
          </div>
          <div class="form-group">
            <input type="text" id="bookNumber" name="bookNumber" class="form-control" placeholder="Enter Book Number">
          </div>
          <div class="form-group">
            <input type="text" id="isbn" name="isbn" class="form-control" placeholder="Enter ISBN">
          </div>
          <div class="form-group">
            <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title">
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="form-group">
            <input type="text" id="author" name="author" class="form-control" placeholder="Enter Author">
          </div>
          <div class="form-group">
            <input type="text" id="edition" name="edition" class="form-control" placeholder="Enter Edition">
          </div>
          <div class="form-group">
            <input type="text" id="dateArrived" name="dateArrived" class="form-control" placeholder="Enter Date Arrived">
          </div>
          <div class="form-group">
            <input type="text" id="quantity" name="quantity" class="form-control" placeholder="Enter Quantity">
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="form-group">
            <input type="text" id="price" name="price" class="form-control" placeholder="Enter Price">
          </div>
          <div class="form-group">
            <input type="text" id="totalQuantity" name="totalQuantity" class="form-control" placeholder="Enter Total Quantity">
          </div>
          <div class="form-group">
            <input type="text" id="borrowedQuantity" name="borrowedQuantity" class="form-control" placeholder="Enter Borrowed Quantity">
          </div>
          <div class="form-group">
            <input type="text" id="availableQuantity" name="availableQuantity" class="form-control" placeholder="Enter Available Quantity">
          </div>
        </div>
      </div><center>
      <button type="submit" name="search-button" class="btn btn-primary search-button">Search</button></center>
    </form>
  </div>

  <div class="container" id="search-results">
         <?php
    if (isset($_POST['search-button'])) {
		$category=$_POST['category'];
      $bookNumber = $_POST['bookNumber'];
      $isbn = $_POST['isbn'];
      $title = $_POST['title'];
      $author = $_POST['author'];
      $edition = $_POST['edition'];
      $dateArrived = $_POST['dateArrived'];
      $quantity = $_POST['quantity'];
      $price = $_POST['price'];
      $totalQuantity = $_POST['totalQuantity'];
      $borrowedQuantity = $_POST['borrowedQuantity'];
      $availableQuantity = $_POST['availableQuantity'];

      $link = mysqli_connect("localhost", "root", "root", "bookdb");
      if ($link === false) {
        die("ERROR: Could not connect" . mysqli_connect_error());
      }

      $query = "SELECT * FROM $category WHERE 1=1";

      if (!empty($bookNumber)) {
        $query .= " AND Book_Number LIKE '%$bookNumber%'";
      }

      if (!empty($isbn)) {
        $query .= " AND ISBN LIKE '%$isbn%'";
      }

      if (!empty($title)) {
        $query .= " AND Title LIKE '%$title%'";
      }

      if (!empty($author)) {
        $query .= " AND Author LIKE '%$author%'";
      }

      if (!empty($edition)) {
        $query .= " AND Edition LIKE '%$edition%'";
      }

      if (!empty($dateArrived)) {
        $query .= " AND Date_arrived LIKE '%$dateArrived%'";
      }

      if (!empty($quantity)) {
        $query .= " AND Quantity LIKE '%$quantity%'";
	  }
    
      if (!empty($price)) {
        $query .= " AND Price LIKE '%$price%'";
      }

      if (!empty($totalQuantity)) {
        $query .= " AND Total_Quantity LIKE '%$totalQuantity%'";
      }

      if (!empty($borrowedQuantity)) {
        $query .= " AND Borrowed_Quantity LIKE '%$borrowedQuantity%'";
      }

      if (!empty($availableQuantity)) {
        $query .= " AND Available_Quantity LIKE '%$availableQuantity%'";
      }

      
      $result = mysqli_query($link, $query);

      if ($result) {
        if (mysqli_num_rows($result) > 0) {
		  ?>
		  <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		     <div class="table-responsive">
      <table class="table table-bordered">
          <thead><tr><th>Book Number</th><th>ISBN</th><th>Title</th><th>Author</th><th>Edition</th><th>Date Arrived</th><th>Quantity</th><th>Price</th><th>Total Quantity</th><th>Borrowed Quantity</th><th>Available Quantity</th><th>Action</th></tr></thead>
		  <?php
          echo '<tbody>';
          while ($row = mysqli_fetch_array($result)) {
            echo '<tr>';
            echo '<td>' . $row['Book_Number'] . '</td>';
            echo '<td>' . $row['ISBN'] . '</td>';
            echo '<td>' . $row['Title'] . '</td>';
            echo '<td>' . $row['Author'] . '</td>';
			echo '<td>' . $row['Edition'] . '</td>';
			echo '<td>' . $row['Date_arrived'] . '</td>';
			echo '<td>' . $row['Quantity'] . '</td>';
			echo '<td>' . $row['Price'] . '</td>';
			echo '<td>' . $row['Total_Quantity'] . '</td>';
			echo '<td>' . $row['Borrowed_Quantity'] . '</td>';
			echo '<td>' . $row['Available_Quantity'] . '</td>';
			 echo "<td>";
                  echo "<button type='button' class='btn btn-danger btn-sm delete-button' data-toggle='modal' data-target='#confirmationDialog' data-category='".$category."' data-id='".$row['ISBN']."'><i class='material-icons' style='font-size:25px;color:white'>delete</i></button>";
                  echo "</td>";
            echo '</tr>';
          }
          echo '</tbody></table></div>';
        } else {
          echo '<p>No results found.</p>';
        }
      } else {
        echo '<p class="text-danger">ERROR: Could not execute the query: ' . mysqli_error($link) . '</p>';
      }

      mysqli_close($link);
	  }
    
    ?>
  </div>
    <div class="modal fade" id="confirmationDialog" tabindex="-1" role="dialog" aria-labelledby="confirmationDialogLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="confirmationDialogLabel">Confirmation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure you want to proceed?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-primary" id="confirmButton" name="confirmButton">OK</button>
            </div>
          </div>
        </div>
      </div>

      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
      <script>
        $(document).ready(function() {
          var deleteId,inCategory;

          $('.delete-button').click(function() {
            deleteId = $(this).data('id');
			inCategory =$(this).data('category');
            $('#confirmationDialog').modal('show');
          });

          $('#confirmButton').click(function(e) {
            e.preventDefault();
             $.ajax({
            type: 'GET',
            url: 'book_process.php',
      data: {
        confirmButton: true,
        delid: deleteId,
        category: inCategory,
       
      },
      success: function(response) {
        // Handle the response from the PHP code
        $('#confirmationDialog').modal('hide');
        location.reload();
      },
      error: function(xhr, status, error) {
        console.error(error); // Log any errors to the console
      }
    });
			
          });
        });
      </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



