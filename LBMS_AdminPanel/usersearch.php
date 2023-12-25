
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="icon" href="booklandis.png" type="image/x-icon">
<style>
    form{
		padding:30px;
	}
	.search-submit {
      background: none;
      border: none;
      font-size: 34px;
      color: #000;
      cursor: pointer;
    }
</style>
</head>
<body>
  <div class="container">
    <form action=" " method ="post" class="mb-4">
      <div class="form-row">
        <div class="col-md-3 form-group">
          <input type="text" placeholder="Username" id="username" class="form-control" name="username">
        </div>
        <div class="col-md-3 form-group">
          <input type="email" placeholder="Email" id="email" class="form-control" name="email">
        </div>
        <div class="col-md-3 form-group">
          <select id="status" class="form-control" name="status">
            <option value=""> Status </option>
            <option value="approved">Approve</option>
            <option value="pending">Pending</option>
            <option value="reject">Reject</option>
          </select>
        </div>
		        <div class="col-md-3 form-group">
		 <button type="submit" class="search-submit"><i class="fas fa-search"></i></button>
      </div>
	  </div>
    </form>

    
          <?php
$conn = mysqli_connect("localhost", "root", "root", "userdb");
        $username = isset($_POST['username']) ? $_POST['username'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $status = isset($_POST['status']) ? $_POST['status'] : '';
$query = "SELECT * FROM users WHERE 1=1";

if (!empty($username)) {
  $query .= " AND username LIKE '%$username%'";
}

if (!empty($email)) {
  $query .= " AND email LIKE '%$email%'";
}

if (!empty($status)) {
  $query .= " AND status = '$status'";
}

// Execute the query
$result = mysqli_query($conn, $query);
 if(mysqli_num_rows($result) > 0){
	 ?>
	 <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Created At</th>
			 <th>Status</th>
			<th>Action</th>
          </tr>
        </thead>
        <tbody>
<?php

while ($row = mysqli_fetch_assoc($result)) {
 echo "<tr>";
		  echo "<td>".$row['id']."</td>";
		   echo "<form action='admin_process.php' method='post'>";
		  echo "<td>" . $row['username'] . "</td>";
          echo "<td>" . $row['email'] . "</td>";
          echo "<td>" . $row['created_at'] . "</td>";
		  echo "<td>" . $row['status'] . "</td>";
		    echo "<input type='hidden' name='id' value='".$row['id']."'>";
		   echo "<td>";
          echo "<button type='submit' name='approve' class='btn btn-success btn-sm'>Approve</button>&nbsp;&nbsp;&nbsp;";
          echo "<button type='submit' name='reject' class='btn btn-danger btn-sm'>Reject</button>";
          echo "</td></form>";
          echo "</tr>";
}

echo "</table>";
 }
 else{
        echo "No records match were found.";
    }
mysqli_close($conn);
?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>







