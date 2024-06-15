<?php
require_once '../functions/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    if (isset($_FILES["csv_file"]) && $_FILES["csv_file"]["error"] == UPLOAD_ERR_OK) {
        $csvFile = $_FILES["csv_file"]["tmp_name"];

        // Process the uploaded CSV file (example function)
        processCSVFile($csvFile);
    } else {
        echo "Error uploading CSV file.";
    }
} else {
    echo "Invalid request.";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV Data Import</title>
</head>
<body>
    <h2>CSV Data Import</h2>
    <form  method="post" enctype="multipart/form-data">
        <label for="csv_file">Select CSV file to import:</label><br>
        <input type="file" id="csv_file" name="csv_file" accept=".csv"><br><br>
        <input type="submit" value="Import CSV" name="submit">
    </form>
</body>
</html>
