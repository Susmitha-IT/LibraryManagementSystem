
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$link = mysqli_connect("localhost", "root", "root", "userdb");
if ($link === false) {
    die("ERROR: Could not connect" . mysqli_connect_error());
}

$username = $_SESSION['username'];
$sql = "SELECT email FROM users WHERE username='$username'";
$result = mysqli_query($link, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $email = $row['email'];
    } else {
        echo "User not found or email is null.";
    }
    mysqli_free_result($result);
} else {
    echo "Error: " . mysqli_error($link);
}

mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User's Borrowed Books</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border-radius: 8px;
            margin-bottom: 20px;
            background-color: #ffffff;
            color: #495057;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        th {
            background-color: #343a40;
            color: #ffffff;
            font-weight: bold;
            text-transform: uppercase;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa;
        }

        .status-label {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
        }

        .status-available {
            background-color: #28a745;
            color: #ffffff;
        }

        .status-unavailable {
            background-color: #dc3545;
            color: #ffffff;
        }

        @media (max-width: 768px) {
            table {
                overflow-x: auto;
                display: block;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Return Date</h2>

        <?php
        $sql = "SELECT book_id, book_category, borrowed_at, due_date, status FROM borrowings WHERE borrowed_at IS NOT NULL AND returned_at IS NULL AND user_id='$email';";

        $link = mysqli_connect("localhost", "root", "root", "borrow_return");
        if ($link === false) {
            die("ERROR: Could not connect" . mysqli_connect_error());
        }

        $result = mysqli_query($link, $sql);
        mysqli_close($link);

        if (mysqli_num_rows($result) > 0) {
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered table-striped mt-4">';
            echo '<thead><tr>
                        <th>ISBN</th>
                        <th>Category</th>
                        <th>Borrowed Date</th>
                        <th>Due Date</th>
                        <th>Status</th>
                    </tr></thead>';
            echo '<tbody>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['book_id'] . '</td>';
                echo '<td>' . $row['book_category'] . '</td>';
                echo '<td>' . $row['borrowed_at'] . '</td>';
                echo '<td>' . $row['due_date'] . '</td>';
                echo '<td><span class="status-label ' . ($row['status'] == 'available' ? 'status-available' : 'status-unavailable') . '">' . ucfirst($row['status']) . '</span></td>';
                echo '</tr>';
            }

            echo '</tbody></table>';
            echo '</div>';
        } else {
            echo '<p>No results found.</p>';
        }
        ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
