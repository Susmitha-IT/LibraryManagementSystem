<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Database Backup</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="icon" href="booklandis.png" type="image/x-icon">

    <style>

        .form-check-input[type="radio"] {
            margin-right: 10px; /* Add some space between the radio button and its text */
        }

        
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Data Backup</h3>
            </div>
            <div class="card-body">
                <form action="backup_process.php" method="post">
                    <div class="form-group">
                        <h5><label>Select Data to Backup:</label></h5><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="dbname" id="database1" value="bookdb">
                            <label class="form-check-label" for="database1">Books</label>
                        </div><br>
						 <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="dbname" id="database3" value="ebook">
                            <label class="form-check-label" for="database4">E-Books</label>
                        </div><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="dbname" id="database2" value="borrow_return">
                            <label class="form-check-label" for="database2">User's Borrowings and Return</label>
                        </div><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="dbname" id="database3" value="userdb">
                            <label class="form-check-label" for="database3">User</label>
                        </div><br>
                    </div>
                    <button type="submit" class="btn btn-primary">Backup Data</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
