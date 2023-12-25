

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $conn = new mysqli($servername, $username, $password,"bookdb");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the list of tables in the database
    $sql = "SHOW TABLES";
    $result = $conn->query($sql);
    $total_books=0;
    if ($result->num_rows > 0) {
        // Loop through each table
        while ($row = $result->fetch_row()) {
            $table = $row[0];
            $sql = "SELECT COUNT(*) AS row_count FROM $table";
            $countResult = $conn->query($sql);

            if ($countResult->num_rows > 0) {
                $countRow = $countResult->fetch_assoc();
                $rowCount = $countRow["row_count"];
				$total_books+=$rowCount;
                echo "<p> $table, Books : $rowCount</p>";
            }
        }
		echo "<br><p>Total_Books: $total_books</p>";
    } else {
        echo "No tables found in the database.";
    }
    $sql = "SHOW TABLES";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $quan=0;
        while ($row = $result->fetch_row()) {
            $table = $row[0];
            $sql = "SELECT SUM(Total_Quantity) AS total FROM $table";
            $sumResult = $conn->query($sql);

            if ($sumResult->num_rows > 0) {
                $sumRow = $sumResult->fetch_assoc();
                $totalQuantity = $sumRow["total"];
                $quan+=$totalQuantity;
            }
        }
		echo "<p>Total Quantity: $quan</p>";
    } else {
        echo "No tables found in the database.";
    }
    $conn->close();
	
	
	$conn = new mysqli($servername, $username, $password,"ebook");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the list of tables in the databasee
       
            $sql = "SELECT COUNT(*) AS row_count FROM ebooks";
            $countResult = $conn->query($sql);

            if ($countResult->num_rows > 0) {
                $countRow = $countResult->fetch_assoc();
                $rowCount = $countRow["row_count"];
                echo "<p>E-books : $rowCount</p>";
            }
        else {
        echo "0";
    }
	$conn->close();
	
	
	$conn = new mysqli($servername, $username, $password,"borrow_return");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the list of tables in the databasee
            $sql="SELECT
    COUNT(CASE WHEN status = 'Returned' THEN 1 END) AS ReturnedCount,
    COUNT(CASE WHEN status = 'Returned and Fine collected' THEN 1 END) AS FineCollectedCount,
    COUNT(CASE WHEN status = 'Borrowed' THEN 1 END) AS BorrowedCount,
    COUNT(CASE WHEN status = 'Overdue' THEN 1 END) AS OverdueCount
FROM borrowings";
           
            $countResult = $conn->query($sql);

            if ($countResult->num_rows > 0) {
                $countRow = $countResult->fetch_assoc();
                $returnedCount = $countRow["ReturnedCount"];
				$fineCollectedCount = $countRow["FineCollectedCount"];
				$borrowedCount = $countRow["BorrowedCount"];
				$overdueCount = $countRow["OverdueCount"];
                echo "<p>Returned books : $returnedCount</p>";
				echo "<p>Returned and fine collected books : $fineCollectedCount</p>";
				echo "<p>Borrowed books: $borrowedCount</p>";
				echo "<p>Overdue books : $overdueCount</p>";
            }
        else {
        echo "0";
    }
	$today = date("Y-m-d");
    $sql = "SELECT COUNT(id) FROM borrowings WHERE due_date = '$today'";
    $result = $conn->query($sql);

    if ($result) {
    $row = $result->fetch_row();
    $count = $row[0];
    echo "<p>Books to be returned today: $count</p>";
    } else {
    echo "Error in the SQL query: " . $conn->error;
    }
    

   
    $sql = "SELECT SUM(fine) AS total FROM borrowings";
    $finesum = $conn->query($sql);
                $sumRow = $finesum->fetch_assoc();
                $totalQuantity = $sumRow["total"];
            
		echo "<p>Total Fine Collected : $totalQuantity</p>";
    $conn->close();
	
	
    $conn = new mysqli($servername, $username, $password,"userdb");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
  
            $sql = "SELECT COUNT(*) AS row_count FROM users";
            $countResult = $conn->query($sql);

            if ($countResult->num_rows > 0) {
                $countRow = $countResult->fetch_assoc();
                $rowCount = $countRow["row_count"];
                echo "<p>Users : $rowCount</p>";
            }
        else {
        echo "0";
    }
	 $sql="SELECT
    COUNT(CASE WHEN status = 'approved' THEN 1 END) AS approveduser,
    COUNT(CASE WHEN status = 'pending' THEN 1 END) AS pendinguser,
    COUNT(CASE WHEN status = 'rejected' THEN 1 END) AS rejecteduser
FROM users";
           
            $countResult = $conn->query($sql);

            if ($countResult->num_rows > 0) {
                $countRow = $countResult->fetch_assoc();
                $app = $countRow["approveduser"];
				$pen = $countRow["pendinguser"];
				$rej = $countRow["rejecteduser"];
                echo "<p>Approved users : $app</p>";
				echo "<p>Pending users : $pen</p>";
				echo "<p>Rejectd users: $rej</p>";
            }
        else {
        echo "0";
    }
	$conn->close();
	?>

