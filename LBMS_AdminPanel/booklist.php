<!DOCTYPE html>
<html>
<head>
    <title>Library Categories</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="icon" href="booklandis.png" type="image/x-icon">
    <style>
        .category-list {
            list-style: none;
            padding: 0;
        }
        .category-list li {
            margin-bottom: 10px;
        }
        .category-list li button {
            width: 60%;
            transition: background-color 0.3s ease;
        }
        .category-list li button:hover {
            background-color:#d8bbff;
        }
        .category-list li button:focus {
            outline: none;
            box-shadow: none;
        }
        .category-table {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
      <br><center> <h3>Categories in the library</h3><br>
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
                    echo "<li>";
                    echo "<form action='' method='POST'>";
                    echo "<input type='hidden' name='tableName' value='$tableName'>";
                    echo "<button type='submit' class='btn btn-link'>$tableName</button>";
                    echo "</form>";
                    echo "</li>";
                }
                echo "</ul>";
            }
            mysqli_free_result($result);
        } else {
            echo "ERROR: Could not execute $sql. " . mysqli_error($link);
        }
        mysqli_close($link);
        ?></center><br>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tableName = $_POST["tableName"];
            $link = mysqli_connect("localhost", "root", "root", "bookdb");
            if ($link === false) {
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }
            $sql = "SELECT * FROM $tableName";
            if ($result = mysqli_query($link, $sql)) {
                if (mysqli_num_rows($result) <= 0) {
                    echo "<center><h5>No book available in this category !</h5></center>";
                } else {
                    echo "<h3>$tableName</h3>";
                   ?>   
	<div class="table-responsive">
      <table class="table table-bordered">
	  <?php
                    echo "<thead><tr>";
                    while ($fieldInfo = mysqli_fetch_field($result)) {
                        echo "<th>" . $fieldInfo->name . "</th>";
                    }
                    echo "</tr></thead>";
                    echo "<tbody>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        foreach ($row as $value) {
                            echo "<td>" . $value . "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table></div>";
                }
                mysqli_free_result($result);
            } else {
                echo "ERROR: Could not execute $sql. " . mysqli_error($link);
            }
            mysqli_close($link);
        }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
