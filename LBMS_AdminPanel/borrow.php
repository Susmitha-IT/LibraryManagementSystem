<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Borrow Book</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="icon" href="booklandis.png" type="image/x-icon">
  <style>
    .error {
      color: red;
    }
    .custom-fieldset {
      border: none;
      background: linear-gradient(to bottom, #e6f2ff, #b3d9ff);
      border-radius: 10px;
      padding: 20px;
    }
  </style>
</head>
<body>
  <br><br><br><br>
  <div class="container">
    <form method="POST" action="" class="custom-fieldset">
      <legend style="text-align: left;">Book and User Confirmation</legend>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="bookId">Enter Book ISBN</label>
          <input type="text" class="form-control" id="bookId" name="bookId" placeholder="Enter Book ISBN">
          <small id="bookIdError" class="error"></small>
        </div>
        <div class="form-group col-md-6">
          <label for="bookCategory">Select book category</label>
          <select class="form-control" id="bookCategory" name="bookCategory">
              <option value="">Select book category</option>
			<?php
            $link = mysqli_connect("localhost", "root", "root", "bookdb");
        if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        $sql = "SHOW TABLES FROM if0_35463838_bookdb";
        if ($result = mysqli_query($link, $sql)) {
            if (mysqli_num_rows($result) <= 0) {
                echo "<p>No categories present in the library</p>";
            } else {
                echo "<ul class='category-list'>";
                while ($row = mysqli_fetch_array($result)) {
                    $tableName = $row[0];
                    echo "<option value='$tableName'>$tableName</option>";
                }
                echo "</ul>";
            }
            mysqli_free_result($result);
        } else {
            echo "ERROR: Could not execute $sql. " . mysqli_error($link);
        }
        mysqli_close($link);
        ?>
          </select>
          <small id="bookCategoryError" class="error"></small>
        </div>
      </div>
      <div class="form-group">
        <label for="userId">Enter User email</label>
        <input type="email" class="form-control" id="userId" name="userId" placeholder="Enter User email">
        <small id="userIdError" class="error"></small>
      </div>
      <button id="borrowButton" name="borrowButton" class="btn btn-primary">Borrow</button>
    </form>
    <br>
    <h5 style="color: orange;">Note: Users cannot borrow more than one copy of the same book.</h5>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#borrowForm').submit(function(e) {
        e.preventDefault();
        $('.error').text('');
        var bookId = $('#bookId').val();
        var userId = $('#userId').val();
        var bookCategory = $('#bookCategory').val();
        var isValid = true;

        if (!bookId) {
          $('#bookIdError').text('Book ID is required.');
          isValid = false;
        }

        if (!userId) {
          $('#userIdError').text('User ID is required.');
          isValid = false;
        }

        if (!bookCategory) {
          $('#bookCategoryError').text('Please select a category.');
          isValid = false;
        }

        if (isValid) {
          this.submit();
        }
      });
    });
  </script>

  <?php
if (isset($_POST['borrowButton'])) {

  $bookId = $_POST['bookId'];
  $userId = $_POST['userId'];
  $bookCategory = $_POST['bookCategory'];

  if (empty($bookId)) {
    echo "Book ID is required.";
    exit;
  }

  if (empty($userId)) {
    echo "User ID is required.";
    exit;
  }

  if (empty($bookCategory)) {
    echo "Please select a category.";
    exit;
  }
  
  $link = mysqli_connect("localhost", "root", "root", "bookdb");
  if ($link === false) {
    die("ERROR: Could not connect" . mysqli_connect_error());
  }
   
  $bookQuery = "SELECT * FROM $bookCategory WHERE ISBN = '$bookId'";
  $bookResult = mysqli_query($link, $bookQuery);
 
  $conn = mysqli_connect("localhost", "root", "root", "userdb")
;
  if ($conn === false) {
    die("ERROR: Could not connect" . mysqli_connect_error());
   }

  $userQuery = "SELECT * FROM users WHERE email = '$userId'";
  $userResult = mysqli_query($conn, $userQuery);

  // Check if book and user records exist
  if (mysqli_num_rows($bookResult) > 0 && mysqli_num_rows($userResult) > 0) {
 
 
$updateQuery = "UPDATE $bookCategory
SET Borrowed_Quantity = Borrowed_Quantity + 1,
    Available_Quantity = Available_Quantity - 1
WHERE ISBN = '$bookId' AND Available_Quantity > 0";
 
 
$conn1= mysqli_connect("localhost", "root", "root", "borrow_return");
if ($conn1 === false) {
    die("ERROR: Could not connect" . mysqli_connect_error());
}


// Get today's date
$today = date("Y-m-d");

// Calculate the due date as 10 days from today
$dueDate = date("Y-m-d", strtotime("+10 days", strtotime($today)));

// Set the default status to "Borrowed"
$status = "Borrowed";


// Insert data into the borrowings table
$insertQuery = "INSERT INTO borrowings ( `user_id`, `book_id`, `book_category`, `borrowed_at`, `returned_at`, `due_date`, `status`, `fine`)
               VALUES ('$userId', '$bookId', '$bookCategory', '$today', NULL, '$dueDate', '$status',0)";

// Execute the INSERT query
if (mysqli_query($conn1, $insertQuery) && mysqli_query($link, $updateQuery)) {
	  echo "<br><center><h5 style='color:green'>Book borrowed !<h5></center><br>";
	echo '
<center><div class="table-responsive">
  <table class="table table-bordered" style="width:80%">
    <thead>
      <tr>
        <th>User ID</th>
        <th>Book ID</th>
        <th>Book Category</th>
        <th>Borrowed at</th>
        <th>Due date</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
';
echo '
      <tr>
        <td>'.$userId.'</td>
        <td>'.$bookId.'</td>
        <td>'.$bookCategory.'</td>
        <td>'.$today.'</td>
        <td>'.$dueDate.'</td>
        <td>'.$status.'</td>
      </tr>
';
echo '</tbody></table></div></center>';
} else {
	 echo "<br><br><center><h5 style='color:orange'>Book is not available..Check the copies of book!<h5></center><br><br>";
	exit;
    echo "Error inserting data: " . mysqli_error($conn1);
}
mysqli_close($conn1);


  } else {	
    echo "<br><br><center><h4 style='color:red'>Invalid book ID or user ID.<h4></center>";
  }
  mysqli_close($conn);
}
?>
</div>
</body>
</html>
