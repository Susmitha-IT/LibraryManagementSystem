<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booklandia Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="icon" href="booklandis.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        #dashboardContainer {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .card {
            height: 100%;
            text-align: center;
        }

        #bookCategoriesChart,
        #borrowingStatusChart,
        #usersStatusChart {
            max-height: 250px;
        }

        .card-title {
            font-size: 18px;
        }

        .card-text {
            font-size: 24px;
        }

        @media screen and (max-width: 600px) {
            .card {
                height: auto;
            }

            #dashboardContainer {
                grid-template-columns: repeat(auto-fill, minmax(100%, 1fr));
            }
        }
    </style>
</head>
<body>
    <?php
     $servername = "localhost";
         $username = "root";
         $password = "root";
    $conn = new mysqli($servername, $username, $password,"bookdb");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SHOW TABLES";
    $result = $conn->query($sql);
    $total_books=0;
    if ($result->num_rows > 0) {
        $i=0;
        while ($row = $result->fetch_row()) {
            $table = $row[0];
            $sql = "SELECT COUNT(*) AS row_count FROM $table";
            $countResult = $conn->query($sql);

            if ($countResult->num_rows > 0) {
                $countRow = $countResult->fetch_assoc();
                $bkrowCount = $countRow["row_count"];
				$total_books+=$bkrowCount;
				$label[$i]=$table;$bk[$i]=$bkrowCount;
				$i++;
            }
        }
    } else {
    }
    $sql = "SHOW TABLES";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $quan=0;
        while ($row = $result->fetch_row()) {
            $table = $row[0];
            $sql = "SELECT SUM(Total_Quantity) AS total FROM $table";
            $sumResult = $conn->query($sql);

            if ($sumResult) {
                $sumRow = $sumResult->fetch_assoc();
                $totalQuantity = $sumRow["total"];
                $quan+=$totalQuantity;
            }else {
        // Handle the case where no rows were returned
    }
        }
		
    } else {
        
    }
    $conn->close();
	
	
	$conn = new mysqli($servername, $username, $password,"ebook");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
       
            $sql = "SELECT COUNT(*) AS row_count FROM ebooks";
            $countResult = $conn->query($sql);

            if ($countResult->num_rows > 0) {
                $countRow = $countResult->fetch_assoc();
                $erowCount = $countRow["row_count"];
            }
        else {
        $erowCount=0;
    }
	$conn->close();
	
	
	$conn = new mysqli($servername, $username, $password,"borrow_return");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

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
    } else {
    echo "Error in the SQL query: " . $conn->error;
    }
    

   
    $sql = "SELECT SUM(fine) AS total FROM borrowings";
    $finesum = $conn->query($sql);
                $sumRow = $finesum->fetch_assoc();
                $totalfine = $sumRow["total"];
    $conn->close();
	
	
    $conn = new mysqli($servername, $username, $password,"userdb");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
  
            $sql = "SELECT COUNT(*) AS row_count FROM users";
            $countResult = $conn->query($sql);

            if ($countResult->num_rows > 0) {
                $countRow = $countResult->fetch_assoc();
                $urowCount = $countRow["row_count"];
            }
        else {
        $urowCount=0;
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
            }
        else {
        echo "0";
    }
	$conn->close();
	?>
    <div class="container-fluid" id="dashboardContainer">
          <div class="card">
        <div class="card-body">
            <h5 class="card-title">Total Books</h5>
            <p class="card-text" id="totalBooks">Loading...</p>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Books to be Returned Today</h5>
            <p class="card-text" id="booksToBeReturned">Loading...</p>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">E-books</h5>
            <p class="card-text" id="eBooks">Loading...</p>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Book Categories</h5>
            <canvas id="bookCategoriesChart"></canvas>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Borrowing Status</h5>
            <canvas id="borrowingStatusChart"></canvas>
        </div>
    </div>
    <div class="card">
        <div class="card-body" id="usersStatusChartContainer">
            <h5 class="card-title">Users Status</h5>
            <canvas id="usersStatusChart"></canvas>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Total Quantity</h5>
            <p class="card-text" id="totalQuantity">Loading...</p>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Total Fine Collected</h5>
            <p class="card-text" id="totalFineCollected">Loading...</p>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Users Count</h5>
            <p class="card-text" id="usersCount">Loading...</p>
        </div>
    </div>
    </div>
    <!-- ... (Script tags and other HTML content remain unchanged) ... -->
	<br><br>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    const totalBooksCount = <?php echo $total_books; ?>;
    const booksToBeReturnedToday = <?php echo $count; ?>; 
    const eBooksCount = <?php echo $erowCount; ?>;
    const totalQuantityCount = <?php echo $quan; ?>;
    const totalFineCollected = <?php echo $totalfine; ?>; 
    const usersCount = <?php echo  $urowCount; ?>; 
	const appUsers = <?php echo $app; ?>;
    const penUsers = <?php echo $pen; ?>;
    const rejUsers = <?php echo $rej; ?>;
	const returned = <?php echo $returnedCount; ?>;
    const finecollected = <?php echo $fineCollectedCount; ?>;
    const borrowed = <?php echo $borrowedCount; ?>;
    const overdue = <?php echo $overdueCount; ?>;
    const borrowingStatusData = {
        labels: ["Returned", "Fine Collected", "Borrowed", "Overdue"],
        datasets: [{
            label: "Borrowing Status",
            data: [returned, finecollected, borrowed, overdue],
            borderColor: "rgba(75, 192, 192, 1)",
            borderWidth: 2,
            fill: false
        }]
    };

    const usersStatusData = {
        labels: ["Approved", "Pending", "Rejected"],
        datasets: [{
            label: "Users Status",
            data: [appUsers, penUsers, rejUsers], 
            backgroundColor: ["rgba(75, 192, 192, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(255, 99, 132, 0.2)"],
            borderColor: ["rgba(75, 192, 192, 1)", "rgba(255, 205, 86, 1)", "rgba(255, 99, 132, 1)"],
            borderWidth: 1
        }]
    };

    const bookCategoriesData = {
        labels: <?php echo json_encode($label); ?>,
        datasets: [{
            label: "Book Categories",
            data: <?php echo json_encode($bk); ?>,
            backgroundColor: ["rgba(75, 192, 192, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)"],
            borderColor: ["rgba(75, 192, 192, 1)", "rgba(255, 205, 86, 1)", "rgba(255, 99, 132, 1)", "rgba(255, 159, 64, 1)"],
            borderWidth: 1
        }]
    };

    animateNumber("totalBooks", totalBooksCount);
    animateNumber("booksToBeReturned", booksToBeReturnedToday);
    animateNumber("eBooks", eBooksCount);
    animateNumber("totalQuantity", totalQuantityCount);
    animateNumber("totalFineCollected", totalFineCollected);
    animateNumber("usersCount", usersCount);

    // Create borrowing status line chart
    const borrowingStatusCtx = document.getElementById('borrowingStatusChart').getContext('2d');
    const borrowingStatusChart = new Chart(borrowingStatusCtx, {
        type: 'line',
        data: borrowingStatusData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Create users status chart (Pie chart)
    const usersStatusCtx = document.getElementById('usersStatusChart').getContext('2d');
    const usersStatusChart = new Chart(usersStatusCtx, {
        type: 'pie',
        data: usersStatusData,
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Create book categories bar chart
    const bookCategoriesCtx = document.getElementById('bookCategoriesChart').getContext('2d');
    const bookCategoriesChart = new Chart(bookCategoriesCtx, {
        type: 'bar',
        data: bookCategoriesData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Function to animate numbers
    function animateNumber(elementId, targetValue) {
        const element = document.getElementById(elementId);
        let currentValue = 0;
        const animationDuration = 2000; // in milliseconds
        const startTime = performance.now();

        function updateValue() {
            const elapsedTime = performance.now() - startTime;
            const progress = Math.min(elapsedTime / animationDuration, 1);
            currentValue = Math.ceil(progress * targetValue);

            element.innerText = `${currentValue}`;

            if (progress < 1) {
                requestAnimationFrame(updateValue);
            }
        }

        updateValue();
    }
</script>
</body>
</html>
