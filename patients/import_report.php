<?php
require_once '../functions/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    if (isset($_FILES["csv_file"]) && $_FILES["csv_file"]["error"] == UPLOAD_ERR_OK) {
        $csvFile = $_FILES["csv_file"]["tmp_name"];

        // Process CSV file (example function call)
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff; /* Light blue background */
            padding: 20px;
        }
        h2 {
            color: #4663AC; /* Blue header text */
        }
        form {
            max-width: 400px;
            margin-top: 20px;
            padding: 15px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        form label {
            display: block;
            margin-bottom: 5px;
        }
        form input[type="file"], form input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        form input[type="submit"] {
            background-color: #4CAF50; /* Green submit button */
            color: white;
            border: none;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background-color: #45a049;
        }
        .message {
            margin-top: 10px;
            padding: 10px;
            background-color: #d4edda; /* Light green background for success message */
            border: 1px solid #c3e6cb;
            border-radius: 3px;
            color: #155724; /* Dark green text color */
        }
        .error {
            margin-top: 10px;
            padding: 10px;
            background-color: #f8d7da; /* Light red background for error message */
            border: 1px solid #f5c6cb;
            border-radius: 3px;
            color: #721c24; /* Dark red text color */
        }
    </style>
</head>
<body>
    <h2>CSV Data Import</h2>
    <form method="post" enctype="multipart/form-data">
        <label for="csv_file">Select CSV file to import:</label><br>
        <input type="file" id="csv_file" name="csv_file" accept=".csv"><br><br>
        <input type="submit" value="Import CSV" name="submit">
    </form>
</body>
</html>
