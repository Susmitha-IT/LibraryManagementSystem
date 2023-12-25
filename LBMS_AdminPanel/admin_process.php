<?php 

if (isset($_POST['approve'])) {
    $user_id = $_POST['id'];
	$conn=mysqli_connect("localhost", "root", "root", "userdb");
    $query = "UPDATE users SET status = 'approved' WHERE id = $user_id";
    mysqli_query($conn, $query);
	header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

if (isset($_POST['reject'])) {
    $user_id = $_POST['id'];
	$conn=mysqli_connect("localhost", "root", "root", "userdb");
    $query = "UPDATE users SET status = 'rejected' WHERE id = $user_id";
    mysqli_query($conn, $query);
	header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['confirmButton'])){
  $id = $_GET['delid'];
	$conn=mysqli_connect("localhost", "root", "root", "userdb");
    $query = "delete from users WHERE id = $id";
    mysqli_query($conn, $query);
}


?>