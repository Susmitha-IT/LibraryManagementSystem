<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="icon" href="booklandis.png" type="image/x-icon">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 30px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    h3 {
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }

    .btn-primary:hover {
      background-color: #0069d9;
      border-color: #0062cc;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h3>Create Category in Library</h3>
        <form action="" method="POST">
          <div class="form-group">
            <label for="category">Enter Category</label><br>
            <input type="text" name="category" class="form-control">
			<p style="  color: lightblue;">Use underscore '_' for space.</p>
          </div>
          <button type="submit" name="create" class="btn btn-primary">Create</button>
        </form>
        <?php
		 if (isset($_POST['create'])) {
        if (isset($_POST['category'])) {
          $category = strtolower($_POST['category']);
          $category = str_replace(' ', '', $category);
          $link = mysqli_connect("localhost", "root", "root", "bookdb");
          if ($link === false) {
            die("ERROR: Could not connect..." . mysqli_connect_error());
          }
          $sql = "CREATE TABLE $category (
  Book_Number INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  ISBN VARCHAR(70) NOT NULL UNIQUE,
  Title VARCHAR(70) NOT NULL,
  Author VARCHAR(70) NOT NULL,
  Edition INT,
  Date_arrived DATE NOT NULL,
  Quantity INT,
  Price INT,
   Total_Quantity INT,
  Borrowed_Quantity INT DEFAULT 0,
  Available_Quantity INT
)";
          if (mysqli_query($link, $sql)) {
            echo '<div class="alert alert-success mt-3" role="alert">' . $category . ' category created in the library</div>';
          } else {
            echo '<div class="alert alert-danger mt-3" role="alert">ERROR: Could not create ' . $sql . '</div>';
          }
          mysqli_close($link);
        }
		 }
        ?>
      </div>
      <div class="col-md-6">
        <form action="" method="post">
          <h3>Add Book in Category</h3>
          <div class="form-group">
            <label for="category">Category</label>
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
    echo '<select name="category" class="form-control">';
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
            <label for="isbno">Enter ISBN</label>
            <input type="text" name="isbno" class="form-control">
          </div>
          <div class="form-group">
            <label for="title">Enter Title</label>
            <input type="text" name="title" class="form-control">
          </div>
          <div class="form-group">
            <label for="author">Enter Author</label>
            <input type="text" name="author" class="form-control">
          </div>
          <div class="form-group">
            <label for="edition">Enter Edition</label>
            <input type="number" name="edition" placeholder="eg.7th edition / 1998" class="form-control">
          </div>
          <div class="form-group">
            <label for="dof">Enter Date of Arrival</label>
            <input type="date" name="dof" class="form-control">
          </div>
          <div class="form-group">
            <label for="qty">Enter Quantity</label>
            <input type="number" name="qty" class="form-control">
          </div>
          <div class="form-group">
            <label for="price">Enter Price</label>
            <input type="number" name="price" class="form-control">
          </div>
          <button type="submit" name="insert" class="btn btn-primary">Add</button>
        </form>
        <?php
		 if (isset($_POST['insert'])) {
        if (isset($_POST['category']) && isset($_POST['isbno']) && isset($_POST['title']) && isset($_POST['author']) && isset($_POST['edition']) && isset($_POST['dof']) && isset($_POST['qty']) && isset($_POST['price'])) {
          $category = $_POST['category'];
          $isbno = $_POST['isbno'];
          $title = $_POST['title'];
          $author = $_POST['author'];
          $edition = $_POST['edition'];
          $dof = $_POST['dof'];
          $qty = $_POST['qty'];
          $price = $_POST['price'];
          $link = mysqli_connect("localhost", "root", "root", "bookdb");
          if ($link === false) {
            die("ERROR: Could not connect" . mysqli_connect_error());
          }
          $isbno = mysqli_real_escape_string($link, $isbno);
          $title = mysqli_real_escape_string($link, $title);
          $author = mysqli_real_escape_string($link, $author);
          $edition = mysqli_real_escape_string($link, $edition);
          $dof = mysqli_real_escape_string($link, $dof);
          $qty = mysqli_real_escape_string($link, $qty);
          $price = mysqli_real_escape_string($link, $price);
          $sql = "INSERT INTO $category (ISBN, Title, Author, Edition, Date_arrived, Quantity, Price,Total_Quantity,Available_Quantity) VALUES ('$isbno', '$title', '$author', '$edition', '$dof', '$qty', '$price', '$qty', '$qty')";

          if (mysqli_query($link, $sql)) {
            echo '<div class="alert alert-success mt-3" role="alert">Book added successfully</div>';
          } 
          mysqli_close($link);
        }
		 }
        ?>
      </div>
    </div>
  </div>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
