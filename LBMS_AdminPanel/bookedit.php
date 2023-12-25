<!DOCTYPE html>
<html>
<head>
  <title>Search Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" href="booklandis.png" type="image/x-icon">
  <style>
    .container {
      margin-top: 50px;
    }
    .search-button {
      margin-top: 20px;
    }
    #search-results {
      margin-top: 40px;
    }
	.dialog-box {
      display: none;
      position: fixed;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      width: 300px;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
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
        </div>
		<div class="col-lg-4 col-md-6">
    <div class="form-group">
      <input type="text" id="bookNumber" name="bookNumber" class="form-control" placeholder="Enter Book Number">
    </div>
  </div>
         <div class="col-lg-4 col-md-6">
    <div class="form-group">
      <input type="text" id="isbn" name="isbn" class="form-control" placeholder="Enter ISBN">
    </div>
  </div>
  </div>
  <div class="row">
  <div class="col-lg-4 col-md-6">
    <div class="form-group">
      <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title">
    </div>
  </div>

  <div class="col-lg-4 col-md-6">
    <div class="form-group">
      <input type="text" id="author" name="author" class="form-control" placeholder="Enter Author">
    </div>
  </div>
  <div class="col-lg-4 col-md-6">
    <div class="form-group">
      <input type="text" id="edition" name="edition" class="form-control" placeholder="Enter Edition">
    </div>
  </div>
  </div>
  <div class="row">
  <div class="col-lg-4 col-md-6">
    <div class="form-group">
      <input type="text" id="dateArrived" name="dateArrived" class="form-control" placeholder="Enter Date Arrived">
    </div>
  </div>


  <div class="col-lg-4 col-md-6">
    <div class="form-group">
      <input type="text" id="quantity" name="quantity" class="form-control" placeholder="Enter Quantity">
    </div>
  </div>
  <div class="col-lg-4 col-md-6">
    <div class="form-group">
      <input type="text" id="price" name="price" class="form-control" placeholder="Enter Price">
    </div>
  </div>

</div>
      </div><center>
      <button type="submit" name="search-button" class="btn btn-primary search-button">Search</button></center>
    </form>
  

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


      $link = mysqli_connect("localhost", "root", "root", "bookdb");
      if ($link === false) {
        die("ERROR: Could not connect" . mysqli_connect_error());
      }

     
      $query = "SELECT `Book_Number`, `ISBN`, `Title`, `Author`, `Edition`, `Date_arrived`, `Quantity`, `Price` FROM $category WHERE 1=1";

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
      $result = mysqli_query($link, $query);

      if ($result) {
        if (mysqli_num_rows($result) > 0) {
		  ?>
		     <div class="table-responsive">
      <table class="table table-bordered">
          <thead><tr><th>Book Number</th><th>ISBN</th><th>Title</th><th>Author</th><th>Edition</th><th>Date Arrived</th><th>Quantity</th><th>Price</th> <th>Actions</th></tr></thead>
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
			echo '<td><button class="btn btn-primary edit-button" data-category="' . $category . '" data-booknumber="' . $row['Book_Number'] . '" data-isbn="' . $row['ISBN'] . '" data-title="' . $row['Title'] . '" data-author="' . $row['Author'] . '" data-edition="' . $row['Edition'] . '" data-datearrived="' . $row['Date_arrived'] . '" data-quantity="' . $row['Quantity'] . '" data-price="' . $row['Price'] . '" style="background-color: #f0ad4e; border-color: #eea236;"><i style="font-size:24px" class="fa">&#xf044;</i>Edit</button></td>';
            echo '</tr>';
          }
          echo '</tbody></table></div>';
		  ?>
		  

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="editForm" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Book</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
		  <div class="form-group">
            <label for="category">Category</label>
            <input type="text" id="editCategory" name="editCategory" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label for="bookNumber">Book Number</label>
            <input type="text" id="editBookNumber" name="editBookNumber" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" id="editISBN" name="editISBN" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="editTitle" name="editTitle" class="form-control">
          </div>
          <div class="form-group">
            <label for="author">Author</label>
            <input type="text" id="editAuthor" name="editAuthor" class="form-control">
          </div>
          <div class="form-group">
            <label for="edition">Edition</label>
            <input type="number" id="editEdition" name="editEdition" class="form-control">
          </div>
          <div class="form-group">
            <label for="dateArrived">Date Arrived</label>
            <input type="date" id="editDateArrived" name="editDateArrived" class="form-control">
          </div>
          <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" id="editQuantity" name="editQuantity" class="form-control">
          </div>
          <div class="form-group">
            <label for="price">Price</label>
            <input type="number" id="editPrice" name="editPrice" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="saveButton" name="saveButton">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
 $(document).ready(function() {
  $('.edit-button').click(function() {
    var category = $(this).data('category');
    var bookNumber = $(this).data('booknumber');
    var isbn = $(this).data('isbn');
    var title = $(this).data('title');
    var author = $(this).data('author');
    var edition = $(this).data('edition');
    var dateArrived = $(this).data('datearrived');
    var quantity = $(this).data('quantity');
    var price = $(this).data('price');
    
    $('#editCategory').val(category);
    $('#editBookNumber').val(bookNumber);
    $('#editISBN').val(isbn);
    $('#editTitle').val(title);
    $('#editAuthor').val(author);
    $('#editEdition').val(edition);
    $('#editDateArrived').val(dateArrived);
    $('#editQuantity').val(quantity);
    $('#editPrice').val(price);

    $('#editModal').modal('show');
  });

  $('#saveButton').click(function(e) {
    e.preventDefault(); // Prevent the form from submitting normally

    // Get the form input values
    var editedCategory = $('#editCategory').val();
    var editedBookNumber = $('#editBookNumber').val();
    var editedISBN = $('#editISBN').val();
    var editedTitle = $('#editTitle').val();
    var editedAuthor = $('#editAuthor').val();
    var editedEdition = $('#editEdition').val();
    var editedDateArrived = $('#editDateArrived').val();
    var editedQuantity = $('#editQuantity').val();
    var editedPrice = $('#editPrice').val();

    // Send an AJAX request to the PHP code
    $.ajax({
      type: 'POST',
      url: 'book_process.php',
      data: {
        saveButton: true,
        editCategory: editedCategory,
        editBookNumber: editedBookNumber,
        editISBN: editedISBN,
        editTitle: editedTitle,
        editAuthor: editedAuthor,
        editEdition: editedEdition,
        editDateArrived: editedDateArrived,
        editQuantity: editedQuantity,
        editPrice: editedPrice
      },
      success: function(response) {
        // Handle the response from the PHP code
        $('#editModal').modal('hide');
        location.reload();
        
      },
      error: function(xhr, status, error) {
        console.error(error); // Log any errors to the console
      }
    });
  });
});
</script>

		  <?php
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



