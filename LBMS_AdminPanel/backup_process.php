<?php
$host = 'localhost';
$db_user = 'root';
$db_pass = 'root';
$db_name = $_POST['dbname'];

$conn = new mysqli($host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get all table names in the database
$tables_query = "SHOW TABLES";
$tables_result = $conn->query($tables_query);

// Create a CSV file
$filename = 'backup_'.$db_name.date('Ymd_His') . '.csv';
$csv_file = fopen($filename, 'w');

// Loop through each table and add data to the CSV file
while ($table_row = $tables_result->fetch_row()) {
    $table_name = $table_row[0];

    // Retrieve data from the table
    $data_query = "SELECT * FROM $table_name";
    $data_result = $conn->query($data_query);

    // Add table name as a separator
    fputcsv($csv_file, [$table_name], ',');

    // Add column headings
    $columns = [];
    for ($i = 0; $i < $data_result->field_count; $i++) {
        $columns[] = $data_result->fetch_field_direct($i)->name;
    }
    fputcsv($csv_file, $columns, ',');

    // Add data to the CSV file
    while ($data_row = $data_result->fetch_assoc()) {
        fputcsv($csv_file, $data_row, ',');
    }
}

fclose($csv_file);

// Provide the backup file for download
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=\"$filename\"");
readfile($filename);
unlink($filename); // Remove the backup file from the server
?>
