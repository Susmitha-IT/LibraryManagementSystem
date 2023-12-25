
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fine Book</title>
  <link rel="icon" href="booklandis.png" type="image/x-icon">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

  <div class="container mt-5">
    <h2>Fine check</h2>
    <form method="POST">
      <div class="form-row">
        <div class="form-group col-md-2">
          <label for="user_id">User ID</label>
          <input type="text" name="user_id" id="user_id" class="form-control">
        </div>
        <div class="form-group col-md-2">
          <label for="book_id">Book ID</label>
          <input type="text" name="book_id" id="book_id" class="form-control">
        </div>
        <div class="form-group col-md-2">
          <label for="book_category">Book Category</label>
          <input type="text" name="book_category" id="book_category" class="form-control">
        </div>
        <div class="form-group col-md-2">
          <label for="end_date">Due Date</label>
          <input type="date" name="due_date" id="due_date" class="form-control">
        </div>
        <div class="form-group col-md-2">
          <label for="status">Status</label>
          <select name="status" id="status" class="form-control">
		  <option value="Returned and Fine collected">Returned and Fine collected</option>
            <option value="borrowed">Borrowed</option>
            <option value="returned">Returned</option>
			<option value="Overdue">Overdue</option>
          </select>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Check</button>
    </form>
 <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $user_id = $_POST["user_id"];
      $book_id = $_POST["book_id"];
      $book_category = $_POST["book_category"];
      $due_date = $_POST["due_date"];
      $status = $_POST["status"];

      $sql = "SELECT * FROM `borrowings` WHERE 1=1";

      if (!empty($user_id)) {
          $sql .= " AND `user_id` = '$user_id'";
      }

      if (!empty($book_id)) {
          $sql .= " AND `book_id` = '$book_id'";
      }

      if (!empty($book_category)) {
          $sql .= " AND `book_category` = '$book_category'";
      }
      
	 
	  if (!empty($due_date)) {
          $sql .= " AND `due_date` = '$due_date'";
      }
      //if (!empty($start_date) && !empty($end_date)) {
      //   $sql .= " AND `borrowed_at`  = '$book_category'";
      //}

      if (!empty($status)) {
          $sql .= " AND `status` = '$status'";
      }

      $link = mysqli_connect("localhost", "root", "root", "borrow_return");
      if ($link === false) {
          die("ERROR: Could not connect" . mysqli_connect_error());
      }

      $result = mysqli_query($link, $sql);

      mysqli_close($link);

      echo '<h5 class="mt-5">Search Results</h5>';
      echo '<table class="table table-bordered table-striped mt-4">';
      echo '<thead><tr><th>User ID</th><th>Book ID</th><th>Book Category</th><th>Borrowed Date</th><th>Returned Date</th><th>Due Date</th><th>Status</th><th>Fine</th></tr></thead>';
      echo '<tbody>';

      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              echo '<tr>';
              echo '<td>' . $row['user_id'] . '</td>';
              echo '<td>' . $row['book_id'] . '</td>';
              echo '<td>' . $row['book_category'] . '</td>';
              echo '<td>' . $row['borrowed_at'] . '</td>';
              echo '<td>' . $row['returned_at'] . '</td>';
              echo '<td>' . $row['due_date'] . '</td>';
              echo '<td>' . $row['status'] . '</td>';
			  echo '<td>' . $row['fine'] . '</td>';
              echo '</tr>';
          }
      } else {
          echo '<tr><td colspan="7">No results found.</td></tr>';
      }

      echo '</tbody></table>';
  }
  ?>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
?>






