<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "bookdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $search_isbn = $_POST['isbn'];
    $search_author = $_POST['author'];
    $search_title = $_POST['title'];

    $search_query = "";
    $table_query = "SHOW TABLES FROM " . $dbname;
    $table_result = $conn->query($table_query);

    if ($table_result->num_rows > 0) {
        $found_results = 0;
        echo "<div class='card-container'>";
        while ($table_row = $table_result->fetch_row()) {
            $table_name = $table_row[0];
            $search_query = "SELECT Book_Number, ISBN, Title, Author, Edition, Date_arrived, Price,Available_Quantity 
                             FROM " . $table_name . " 
                             WHERE 1=1";

            // Prepare an array to store the parameters and types for binding
            $params = array();
            $types = "";

            // Add individual search terms to the query and bind the corresponding parameters
            if (!empty($search_isbn)) {
                $search_query .= " AND ISBN LIKE ?";
                $params[] = "%" . $search_isbn . "%";
                $types .= "s";
            }

            if (!empty($search_author)) {
                $search_query .= " AND Author LIKE ?";
                $params[] = "%" . $search_author . "%";
                $types .= "s";
            }

            if (!empty($search_title)) {
                $search_query .= " AND Title LIKE ?";
                $params[] = "%" . $search_title . "%";
                $types .= "s";
            }

            // Prepare and execute the query with the dynamic conditions
            $stmt = $conn->prepare($search_query);
            if (!empty($params)) {
                $stmt->bind_param($types, ...$params);
            }
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Display the table name as a title category
               

                while ($row = $result->fetch_assoc()) {
                    // Display the results in card format
                    echo "<div class='card'>";
					 echo "<em><h4>" . ucfirst($table_name) . "</h4></em>";
                    echo "<p>Book Number: " . $row["Book_Number"] . "</p>";
                    echo "<p>ISBN: " . $row["ISBN"] . "</p>";
                    echo "<p>Title: " . $row["Title"] . "</p>";
                    echo "<p>Author: " . $row["Author"] . "</p>";
                    echo "<p>Edition: " . $row["Edition"] . "</p>";
                    echo "<p>Date Arrived: " . $row["Date_arrived"] . "</p>";
                    echo "<p>Price: " . $row["Price"] . "</p>";
					 echo "<p>Available Quantity: " . $row["Available_Quantity"] . "</p>";
                    echo "</div>";

                    $found_results++;
                }
            }
        }
        echo "</div>";
        echo "<p>Found " . $found_results . " results.</p>";
    } else {
        echo "No tables found in the database.";
    }

    $conn->close();
}


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "bookdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $selectedCategory = $_GET['category'];
    $search_isbn = $_GET['isbn'];
    $search_author = $_GET['author'];
    $search_title = $_GET['title'];

    // Construct a dynamic SQL query to search across all tables
  
            $search_query = "SELECT Book_Number, ISBN, Title, Author, Edition, Date_arrived, Price ,Available_Quantity
                             FROM " .  $selectedCategory . " 
                             WHERE 1=1";

            // Prepare an array to store the parameters and types for binding
            $params = array();
            $types = "";

            // Add individual search terms to the query and bind the corresponding parameters
            if (!empty($search_isbn)) {
                $search_query .= " AND ISBN LIKE ?";
                $params[] = "%" . $search_isbn . "%";
                $types .= "s";
            }

            if (!empty($search_author)) {
                $search_query .= " AND Author LIKE ?";
                $params[] = "%" . $search_author . "%";
                $types .= "s";
            }

            if (!empty($search_title)) {
                $search_query .= " AND Title LIKE ?";
                $params[] = "%" . $search_title . "%";
                $types .= "s";
            }

            // Prepare and execute the query with the dynamic conditions
            $stmt = $conn->prepare($search_query);
            if (!empty($params)) {
                $stmt->bind_param($types, ...$params);
            }
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Display the table name as a title category
               $found_results=0;

                while ($row = $result->fetch_assoc()) {
                    // Display the results in card format
                    echo "<div class='card'>";
					 echo "<em><h4>" . ucfirst($selectedCategory) . "</h4></em>";
                    echo "<p>Book Number: " . $row["Book_Number"] . "</p>";
                    echo "<p>ISBN: " . $row["ISBN"] . "</p>";
                    echo "<p>Title: " . $row["Title"] . "</p>";
                    echo "<p>Author: " . $row["Author"] . "</p>";
                    echo "<p>Edition: " . $row["Edition"] . "</p>";
                    echo "<p>Date Arrived: " . $row["Date_arrived"] . "</p>";
                    echo "<p>Price: " . $row["Price"] . "</p>";
					 echo "<p>Available Quantity: " . $row["Available_Quantity"] . "</p>";
                    echo "</div>";

                    $found_results++;
                }
            }
        
        echo "</div>";
        echo "<p>Found " . $found_results . " results.</p>";
     

    $conn->close();
}





?>