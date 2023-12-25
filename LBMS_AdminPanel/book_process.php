<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['saveButton'])) {
    $editedCategory = $_POST['editCategory'];
    $editedBookNumber = $_POST['editBookNumber'];
    $editedISBN = $_POST['editISBN'];
    $editedTitle = $_POST['editTitle'];
    $editedAuthor = $_POST['editAuthor'];
    $editedEdition = $_POST['editEdition'];
    $editedDateArrived = $_POST['editDateArrived'];
    $editedQuantity = $_POST['editQuantity'];
    $editedPrice = $_POST['editPrice'];

    $link = mysqli_connect("localhost", "root", "root", "bookdb");
    if ($link === false) {
        die("ERROR: Could not connect" . mysqli_connect_error());
    }

    $sql = "UPDATE $editedCategory SET Title = '$editedTitle', Author = '$editedAuthor', Edition = $editedEdition, Date_arrived = '$editedDateArrived', Quantity = $editedQuantity, Price = $editedPrice, `Total_Quantity` = '$editedQuantity', `Available_Quantity` = `Available_Quantity` + '$editedQuantity' WHERE ISBN = '$editedISBN'";

    if (mysqli_query($link, $sql)) {
        echo "Book information updated successfully";
    } else {
        echo "Error updating book information: " . mysqli_error($link);
    }

    mysqli_close($link);
}


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['confirmButton'])) {
  $id = $_GET['delid'];
  $category=$_GET['category'];
	$conn=mysqli_connect("localhost", "root", "root", "bookdb");
    $query = "delete from $category WHERE ISBN = '$id'";
    mysqli_query($conn, $query);
	  if (mysqli_query($conn, $query)) {
        echo "Book information deleted successfully";
    } else {
        echo "Error updating book information: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}


?>