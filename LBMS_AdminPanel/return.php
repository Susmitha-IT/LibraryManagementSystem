<?php
$link = mysqli_connect("localhost", "root", "root", "borrow_return");
  if ($link === false) {
    die("ERROR: Could not connect" . mysqli_connect_error());
  }
$today = date("Y-m-d");
$sql = "UPDATE `borrowings` SET `status`='Overdue',`fine` = DATEDIFF('$today', `due_date`) * 5 WHERE `due_date` < '$today' AND `returned_at` IS NULL";
  
if(mysqli_query($link, $sql))
{
    echo "";
} else
{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
} 
mysqli_close($link);
?>

<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Return Book</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="icon" href="booklandis.png" type="image/x-icon">
  <style>
    .error {
      color: red;
    }
    .custom-fieldset {
      border: none;
      background:linear-gradient(to bottom, rgba(230, 204, 179, 0.2), rgba(179, 134, 59, 0.2));
      border-radius: 10px;
      padding: 20px;
    }
  </style>
</head>
<body>
<br><br><br><br>
<center>
  <div class="container">
    <form method="POST" action=" ">
      <fieldset class="custom-fieldset" style="width:80%">
        <legend style="text-align:left">Book and User Confirmation</legend>
        <div class="form-group">
          <input type="text" class="form-control" id="bookId" name="bookId" placeholder="Enter Book ISBN">
          <small id="bookIdError" class="error"></small>
        </div>
		 <div class="form-group">
          <select class="form-control" id="bookCategory" name="bookCategory">
            <option value="">Select book category</option>
			<?php
            $link = mysqli_connect("localhost", "root", "root", "bookdb");
        if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        $sql = "SHOW TABLES FROM bookdb";
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
        <div class="form-group">
          <input type="email" class="form-control" id="userId" name="userId" placeholder="Enter User email">
          <small id="userIdError" class="error"></small>
        </div>
        <button id="returnButton" name="returnButton" class="btn btn-primary">Return</button></center>
      </fieldset>
    </form>
  

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#borrowForm').submit(function(e) {
        e.preventDefault(); // Prevent form submission

        // Clear previous error messages
        $('.error').text('');

        // Get input values
        var bookId = $('#bookId').val();
        var userId = $('#userId').val();
        var bookCategory = $('#bookCategory').val();

        // Perform validation
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

        // If all inputs are valid, proceed with form submission
        if (isValid) {
          this.submit();
        }
      });
    });
  </script>
<script>
    function playNotificationSound() {
            var audio = new Audio('notification.mp3');

            // Create a Promise to play the audio
            var playPromise = audio.play();

            if (playPromise !== undefined) {
                playPromise.then(function () {
                    // Audio started playing successfully
                    alert("Collect the fine!");
                }).catch(function (error) {
                    // An error occurred while starting audio playback
                    console.error('Audio playback error:', error);
                });
            } else {
                // Audio autoplay is not supported, show alert directly
                alert("Collect the fine!");
            }
        }
</script>
<?php
if (isset($_POST['returnButton'])) {

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
 
  $conn = mysqli_connect("localhost", "root", "root", "userdb");
  if ($conn === false) {
    die("ERROR: Could not connect" . mysqli_connect_error());
   }

  $userQuery = "SELECT * FROM users WHERE email = '$userId'";
  $userResult = mysqli_query($conn, $userQuery);


  if (mysqli_num_rows($bookResult) > 0 && mysqli_num_rows($userResult) > 0) {
 
 
$updateBook = "UPDATE $bookCategory SET Borrowed_Quantity = Borrowed_Quantity - 1, Available_Quantity = Available_Quantity + 1 WHERE ISBN = '$bookId' AND Available_Quantity < Total_Quantity";
 
$conn1= mysqli_connect("localhost", "root", "root", "borrow_return");
if ($conn1 === false) {
    die("ERROR: Could not connect" . mysqli_connect_error());
}

$today = date("Y-m-d");
$updateQuery = "UPDATE borrowings 
               SET returned_at = '$today', status = 
               CASE 
                   WHEN status = 'Borrowed' THEN 'Returned'
                   WHEN status = 'Overdue' THEN 'Returned and Fine collected'
               END 
               WHERE `user_id` = '$userId' AND `book_id` = '$bookId' AND `book_category` = '$bookCategory' AND `returned_at` IS NULL AND `status` IN ('Borrowed', 'Overdue')";

$status="Returned/ Fine collected";
$fineQuery="SELECT `user_id`, `book_id`, `book_category`, `borrowed_at`, `returned_at`, `due_date`, `status`, `fine` FROM `borrowings` WHERE `user_id`='$userId'";

$fineResult=mysqli_query($conn1, $fineQuery);

if (mysqli_query($conn1, $updateQuery)!== false && mysqli_num_rows($fineResult) > 0 && mysqli_affected_rows($conn1) && mysqli_query($link, $updateBook)!== false) {
	echo "<br><center><h5 style='color:green'>Book returned !<h5></center><br>";
	echo '
<center><div class="table-responsive">
  <table class="table table-bordered" style="width:80%">
    <thead>
      <tr>
        <th>User ID</th>
        <th>Book ID</th>
        <th>Book Category</th>
        <th>Returned date</th>
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
        <td>'.$status.'</td>
      </tr>
';
echo '</tbody></table></div>';
 if (mysqli_num_rows($fineResult) > 0) {
        $row = mysqli_fetch_assoc($fineResult);
        $fine = $row['fine'];
        echo "<h4>Fine: $fine</h4>"; 
		if ($fine > 0) {
        echo '<script>playNotificationSound();</script>';
    }
    }
echo '</center>';
} else {
	echo "<br><center><h5 style='color:orange'>Check the quantity of book and return !<h5></center><br>";
    echo "<br><br><center><h4 style='color:red'>The book is not borrowed by this user.<h4></center>";
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