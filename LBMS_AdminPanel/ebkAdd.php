<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Information Form</title>
  <link rel="icon" href="booklandis.png" type="image/x-icon">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .form-container {
      border:1px solid black;
      border-radius: 5px;
      padding: 15px;
    }
	input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
	background: #caf0f8;
    padding: 6px 12px;
    cursor: pointer;
}
  </style>
</head>
<body>
<div class="container mt-4">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <div class="form-container">
       
             <form action=" " method="post" enctype="multipart/form-data">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
              </div>
              <div class="form-group col-md-6">
                <label for="author">Author</label>
                <input type="text" class="form-control" id="author" name="author" required>
              </div>
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="category">Category</label>
                <input type="text" class="form-control" id="category" name="category">
              </div>
              <div class="form-group col-md-6">
                <label for="publication_year">Publication Year</label>
                <input type="number" class="form-control" id="publication_year" name="publication_year">
              </div>
            </div>
            <div class="form-group">
              <label for="isbn">ISBN</label>
              <input type="text" class="form-control" id="isbn" name="isbn">
            </div>
			  <div class="form-row">
            <div class="form-group">
              <label for="url">URL</label>
              <input type="url" class="form-control" id="url" name="url">
            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="form-group">
              <label for="image_url">Book Image</label>
              <div class="form-outline mb-4">
					<label class="custom-file-upload"><input type="file" name="image" id="image"/>Upload</label>
	          </div> 
            </div>
			</div>
            <div class="form-group">
              <label for="featured_book">Featured Book</label>
              <select class="form-control" id="featured_book" name="featured_book">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div><center>
            <button type="submit" value="Upload Image" name="submit" class="btn btn-primary">Submit</button>
          </form>
       
   <?php
if (isset($_POST['submit'])) {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "ebook";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $targetDirectory = "ebkimg/"; // Change this to the path of your desired upload folder.
    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // ... (the image validation code remains the same)

    // If all checks pass, try to upload the file.
    if ($uploadOk == 0) {
        echo "Error: Your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Image uploaded successfully. Now, insert the form data into the database.

            // Sanitize the form inputs to prevent SQL injection
            $title = $_POST['title'];
            $author = $_POST['author'];
            $description = $_POST['description'];
            $category = $_POST['category'];
            $publication_year = $_POST['publication_year'];
            $isbn = $_POST['isbn'];
            $url = $_POST['url'];
            $featured_book = $_POST['featured_book'];

            $sql = "INSERT INTO ebooks (`title`, `author`, `description`, `category`, `publication_year`, `isbn`, `url`, `image_url`, `featured_book`)
                    VALUES ('$title', '$author', '$description', '$category', '$publication_year', '$isbn', '$url', '$targetFile', '$featured_book')";

            if ($conn->query($sql) === TRUE) {
                echo "<br><br><h4><em>E-Book recorded successfully!</em></h4></center>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: There was an error uploading your file.";
        }
    }

    $conn->close(); 
}
?>
 </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
  
</body>
</html>








